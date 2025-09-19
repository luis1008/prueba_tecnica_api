<?php

namespace App\Http\Controllers;

use App\Models\Productos; // Importa tu modelo de productos
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Muestra una lista de todos los productos.
     */
    public function index()
    {
        $productos = Productos::all();
        return response()->json($productos);
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'codigo_producto' => 'required|string|max:255',
            'nombre_producto' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'fecha_creacion' => 'required|string|max:255',
        ]);

        $producto = new Productos([
            'codigo_producto' => $request->codigo_producto,
            'nombre_producto' => $request->nombre_producto,
            'precio' => $request->precio,
            'fecha_creacion' => $request->fecha_creacion,
        ]);

        $producto->save();

        return response()->json($producto, 201);
    }

    /**
     * Muestra un producto específico.
     */
    public function show($id)
    {
        $producto = Productos::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    /**
     * Actualiza un producto existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $producto = Productos::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Validación de datos para la actualización
        $request->validate([
            'codigo_producto' => 'required|string|max:255',
            'nombre_producto' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'fecha_creacion' => 'required|string|max:255',
        ]);

        $producto->update($request->all());

        return response()->json($producto);
    }

    /**
     * Elimina un producto de la base de datos.
     */
    public function destroy($id)
    {
        $producto = Productos::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado con éxito']);
    }
}
