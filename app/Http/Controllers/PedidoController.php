<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    // Mensajes de notificación simulada por estado
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
        // Admin ve pedido.index, cliente ve pedido.perfil
        $vista = auth()->user()->can('pedido-list') ? 'pedido.index' : 'pedido.perfil';
        return view($vista, compact('registros', 'texto'));
    }

    public function realizar(Request $request)
    {
        $carritoKey = auth()->check() ? 'carrito_' . auth()->id() : 'carrito_guest';
        $carrito    = session()->get($carritoKey, []);

        if (empty($carrito)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();
        try {
            $total = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito));

            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'total'   => $total,
                'estado'  => 'pendiente',
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

            return redirect()->route('perfil.pedidos')
                ->with('mensaje', '🎉 ¡Pedido #' . $pedido->id . ' realizado correctamente! Te notificaremos cuando sea procesado.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un error al procesar el pedido. Intenta de nuevo.');
        }
    }

    public function cambiarEstado(Request $request, $id)
    {
        $pedido      = Pedido::with('user')->findOrFail($id);
        $estadoNuevo = $request->input('estado');

        $estadosPermitidos = ['procesando', 'enviado', 'entregado', 'anulado', 'cancelado'];

        if (!in_array($estadoNuevo, $estadosPermitidos)) {
            abort(422, 'Estado no válido.');
        }

        // Validar que el flujo sea lógico
        $flujoValido = [
            'pendiente'  => ['procesando', 'anulado'],
            'procesando' => ['enviado', 'anulado'],
            'enviado'    => ['entregado', 'anulado'],
            'entregado'  => [],
            'anulado'    => [],
            'cancelado'  => [],
        ];

        $estadoActual = $pedido->estado;
        if (!in_array($estadoNuevo, $flujoValido[$estadoActual] ?? [])) {
            return redirect()->back()->with('error',
                "No se puede cambiar de \"{$estadoActual}\" a \"{$estadoNuevo}\".");
        }

        // Verificar permisos
        if (!auth()->user()->can('pedido-anulate')) {
            return redirect()->back()->with('error', 'No tienes permiso para cambiar estados.');
        }

        $pedido->estado = $estadoNuevo;
        $pedido->save();

        // Notificación simulada — guardar en sesión del CLIENTE
        $msgCliente = $this->mensajesEstado[$estadoNuevo] ?? null;
        if ($msgCliente && $pedido->user) {
            // Guardamos la notificación en una clave de sesión que el cliente verá al entrar
            $notis = session()->get('notificaciones_' . $pedido->user_id, []);
            $notis[] = [
                'mensaje'    => $msgCliente,
                'pedido_id'  => $pedido->id,
                'estado'     => $estadoNuevo,
                'fecha'      => now()->format('d/m/Y H:i'),
            ];
            session()->put('notificaciones_' . $pedido->user_id, $notis);
        }

        return redirect()->back()->with('mensaje',
            'Estado del pedido #' . $pedido->id . ' actualizado a "' . ucfirst($estadoNuevo) . '".');
    }
}