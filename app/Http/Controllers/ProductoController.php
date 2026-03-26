<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Requests\ProductoRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;


class ProductoController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('producto-list');
        $texto = $request->input('texto');
        $registros = Producto::where('nombre', 'like', "%{$texto}%")
                    ->orWhere('codigo', 'like', "%{$texto}%")
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        return view('producto.index', compact('registros', 'texto'));
    }

    public function create()
    {
        $this->authorize('producto-create');
        return view('producto.action');
    }

    public function store(ProductoRequest $request)
    {
        $this->authorize('producto-create');
        $registro = new Producto();
        $registro->codigo      = $request->input('codigo');
        $registro->nombre      = $request->input('nombre');
        $registro->precio      = $request->input('precio');
        $registro->descripcion = $request->input('descripcion');
        $sufijo = strtolower(Str::random(2));
        $image  = $request->file('imagen');
        if (!is_null($image)) {
            $nombreImagen = $sufijo . '-' . $image->getClientOriginalName();
            $image->move('uploads/productos', $nombreImagen);
            $registro->imagen = $nombreImagen;
        }
        $registro->save();
        return redirect()->route('productos.index')->with('mensaje', 'Registro ' . $registro->nombre . ' agregado correctamente');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $this->authorize('producto-edit');
        $registro = Producto::findOrFail($id);
        return view('producto.action', compact('registro'));
    }

    public function update(ProductoRequest $request, $id)
    {
        $this->authorize('producto-edit');
        $registro              = Producto::findOrFail($id);
        $registro->codigo      = $request->input('codigo');
        $registro->nombre      = $request->input('nombre');
        $registro->precio      = $request->input('precio');
        $registro->descripcion = $request->input('descripcion');
        $sufijo = strtolower(Str::random(2));
        $image  = $request->file('imagen');
        if (!is_null($image)) {
            $nombreImagen = $sufijo . '-' . $image->getClientOriginalName();
            $image->move('uploads/productos', $nombreImagen);
            $old_image = 'uploads/productos/' . $registro->imagen;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $registro->imagen = $nombreImagen;
        }
        $registro->save();
        return redirect()->route('productos.index')->with('mensaje', 'Registro ' . $registro->nombre . ' actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $this->authorize('producto-delete');
        $registro  = Producto::findOrFail($id);
        $old_image = 'uploads/productos/' . $registro->imagen;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        $registro->delete();
        return redirect()->route('productos.index')->with('mensaje', $registro->nombre . ' eliminado correctamente.');
    }

    /**
     * Activa / desactiva un producto en la sección "Nueva Colección" del home.
     */
    public function toggleColeccion(string $id)
    {
        $this->authorize('producto-edit');
        $registro = Producto::findOrFail($id);
        $registro->en_coleccion = !$registro->en_coleccion;
        $registro->save();

        $estado = $registro->en_coleccion ? 'agregado a' : 'quitado de';
        return redirect()->route('productos.index')
            ->with('mensaje', "\"$registro->nombre\" $estado la colección del home.");
    }
}