<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Producto;
use App\Mail\PedidoConfirmacion;
use App\Mail\PedidoEstadoActualizado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    private array $mensajesEstado = [
        'procesando' => '📦 Tu pedido está siendo procesado. Pronto lo prepararemos para envío.',
        'enviado'    => '🚚 ¡Tu pedido está en camino! Ya fue despachado.',
        'entregado'  => '✅ ¡Tu pedido fue entregado! Gracias por comprar en ZT|SHOES.',
        'anulado'    => '❌ Tu pedido ha sido anulado. Contáctanos si tienes dudas.',
        'cancelado'  => '🚫 Tu pedido fue cancelado.',
    ];

    public function index(Request $request)
    {
        $texto = $request->input('texto');
        $query = Pedido::with('user', 'detalles.producto')->orderBy('id', 'desc');

        if (auth()->user()->can('pedido-list')) {
            // Admin ve todos
        } elseif (auth()->user()->can('pedido-view')) {
            $query->where('user_id', auth()->id());
        } else {
            abort(403, 'No tienes permisos para ver pedidos.');
        }

        if (!empty($texto)) {
            $query->whereHas('user', function ($q) use ($texto) {
                $q->where('name', 'like', "%{$texto}%");
            });
        }

        $registros = $query->paginate(10);
        $vista = auth()->user()->can('pedido-list') ? 'pedido.index' : 'pedido.perfil_pedidos';
        return view($vista, compact('registros', 'texto'));
    }

    public function realizar(Request $request)
    {
        // Validar dirección de envío
        $request->validate([
            'direccion' => 'required|string|max:255',
            'ciudad'    => 'required|string|max:100',
            'telefono'  => 'nullable|string|max:20',
            'notas'     => 'nullable|string|max:500',
        ], [
            'direccion.required' => 'La dirección de envío es obligatoria.',
            'ciudad.required'    => 'La ciudad es obligatoria.',
        ]);

        $carritoKey = auth()->check() ? 'carrito_' . auth()->id() : 'carrito_guest';
        $carrito    = session()->get($carritoKey, []);

        if (empty($carrito)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        // Validar que todos los productos aún existen en la BD
        $idsCarrito     = array_keys($carrito);
        $productosExist = Producto::whereIn('id', $idsCarrito)->pluck('id')->toArray();
        $faltantes      = array_diff($idsCarrito, $productosExist);

        if (!empty($faltantes)) {
            foreach ($faltantes as $idFaltante) {
                unset($carrito[$idFaltante]);
            }
            session()->put($carritoKey, $carrito);

            if (empty($carrito)) {
                return redirect()->back()->with('error', 'Algunos productos ya no están disponibles y fueron eliminados del carrito.');
            }
            return redirect()->back()->with('error', 'Algunos productos ya no están disponibles y fueron eliminados. Revisa tu carrito antes de continuar.');
        }

        DB::beginTransaction();
        try {
            $subtotal = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito));
            $envio    = $subtotal >= 150 ? 0 : 10;
            $total    = $subtotal + $envio;

            $pedido = Pedido::create([
                'user_id'   => auth()->id(),
                'total'     => $total,
                'estado'    => 'pendiente',
                'direccion' => $request->direccion,
                'ciudad'    => $request->ciudad,
                'telefono'  => $request->telefono,
                'notas'     => $request->notas,
            ]);

            foreach ($carrito as $productoId => $item) {
                PedidoDetalle::create([
                    'pedido_id'   => $pedido->id,
                    'producto_id' => $productoId,
                    'cantidad'    => $item['cantidad'],
                    'precio'      => $item['precio'],
                ]);
            }

            session()->forget($carritoKey);
            DB::commit();

            // Enviar email de confirmación
            try {
                Mail::to($pedido->user->email)->send(new PedidoConfirmacion($pedido->load('detalles.producto', 'user')));
            } catch (\Exception $mailEx) {
                Log::warning('No se pudo enviar email de confirmación pedido #' . $pedido->id . ': ' . $mailEx->getMessage());
            }

            return redirect()->route('perfil.pedidos')
                ->with('mensaje', '🎉 ¡Pedido #' . $pedido->id . ' realizado correctamente! Revisa tu correo para la confirmación.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar pedido', [
                'user_id' => auth()->id(),
                'carrito' => $carrito,
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Hubo un error al procesar el pedido. Intenta de nuevo.');
        }
    }

    public function cambiarEstado(Request $request, $id)
    {
        $pedido       = Pedido::with('user')->findOrFail($id);
        $estadoNuevo  = $request->input('estado');
        $estadoActual = $pedido->estado;

        $estadosPermitidos = ['procesando', 'enviado', 'entregado', 'anulado', 'cancelado'];

        if (!in_array($estadoNuevo, $estadosPermitidos)) {
            abort(422, 'Estado no válido.');
        }

        $flujoValido = [
            'pendiente'  => ['procesando', 'anulado'],
            'procesando' => ['enviado', 'anulado'],
            'enviado'    => ['entregado', 'anulado'],
            'entregado'  => [],
            'anulado'    => [],
            'cancelado'  => [],
        ];

        if (!in_array($estadoNuevo, $flujoValido[$estadoActual] ?? [])) {
            return redirect()->back()->with('error',
                "No se puede cambiar de \"{$estadoActual}\" a \"{$estadoNuevo}\".");
        }

        if (!auth()->user()->can('pedido-anulate')) {
            return redirect()->back()->with('error', 'No tienes permiso para cambiar estados.');
        }

        $pedido->estado = $estadoNuevo;
        $pedido->save();

        // Notificación en sesión (para cuando el cliente entre)
        $msgCliente = $this->mensajesEstado[$estadoNuevo] ?? null;
        if ($msgCliente && $pedido->user) {
            $notis = session()->get('notificaciones_' . $pedido->user_id, []);
            $notis[] = [
                'mensaje'   => $msgCliente,
                'pedido_id' => $pedido->id,
                'estado'    => $estadoNuevo,
                'fecha'     => now()->format('d/m/Y H:i'),
            ];
            session()->put('notificaciones_' . $pedido->user_id, $notis);
        }

        // Enviar email al cliente con el nuevo estado
        try {
            Mail::to($pedido->user->email)
                ->send(new PedidoEstadoActualizado($pedido->load('detalles.producto', 'user'), $estadoActual));
        } catch (\Exception $mailEx) {
            Log::warning('No se pudo enviar email de estado pedido #' . $pedido->id . ': ' . $mailEx->getMessage());
        }

        return redirect()->back()->with('mensaje',
            'Estado del pedido #' . $pedido->id . ' actualizado a "' . ucfirst($estadoNuevo) . '".');
    }
}