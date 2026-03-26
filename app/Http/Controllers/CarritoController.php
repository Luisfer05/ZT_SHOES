<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    /**
     * Clave de sesión única por usuario.
     * Autenticado  → carrito_123
     * Invitado     → carrito_guest
     */
    private function key(): string
    {
        return auth()->check()
            ? 'carrito_' . auth()->id()
            : 'carrito_guest';
    }

    private function getCarrito(): array
    {
        return session()->get($this->key(), []);
    }

    private function saveCarrito(array $carrito): void
    {
        session()->put($this->key(), $carrito);
    }

    public function agregar(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $cantidad = max(1, (int) $request->cantidad);

        $carrito = $this->getCarrito();

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $cantidad;
        } else {
            $carrito[$producto->id] = [
                'nombre'   => $producto->nombre,
                'precio'   => $producto->precio,
                'imagen'   => $producto->imagen,
                'cantidad' => $cantidad,
            ];
        }

        $this->saveCarrito($carrito);
        return redirect()->back()->with('mensaje', 'Producto agregado al carrito');
    }

    public function mostrar()
    {
        $carrito = $this->getCarrito();
        return view('web.pedido', compact('carrito'));
    }

    public function sumar(Request $request)
    {
        $carrito = $this->getCarrito();
        if (isset($carrito[$request->producto_id])) {
            $carrito[$request->producto_id]['cantidad'] += 1;
            $this->saveCarrito($carrito);
        }
        return redirect()->back();
    }

    public function restar(Request $request)
    {
        $carrito = $this->getCarrito();
        if (isset($carrito[$request->producto_id])) {
            if ($carrito[$request->producto_id]['cantidad'] > 1) {
                $carrito[$request->producto_id]['cantidad'] -= 1;
            } else {
                unset($carrito[$request->producto_id]);
            }
            $this->saveCarrito($carrito);
        }
        return redirect()->back();
    }

    public function eliminar($id)
    {
        $carrito = $this->getCarrito();
        unset($carrito[$id]);
        $this->saveCarrito($carrito);
        return redirect()->back();
    }

    public function vaciar()
    {
        session()->forget($this->key());
        return redirect()->back();
    }
}