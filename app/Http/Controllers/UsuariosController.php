<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
{
    /**
     * Muestra una lista de usuarios.
     */
    public function index()
    {
        // Obtiene todos los usuarios de la base de datos de MongoDB
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'usuario' => 'required|string|max:255|unique:users', // Asegura que el usuario sea único
            'password' => 'required|string|min:8',
        ]);

        $user = new User([
            'nombre' => $request->nombre,
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password), // Hashea la contraseña antes de guardarla
        ]);

        $user->save();
        return response()->json($user, 201);
    }

    /**
     * Muestra un usuario específico.
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user);
    }

    /**
     * Actualiza un usuario existente.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'usuario' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)], // Evita el conflicto de unicidad al actualizar
        ]);
        
        $user->nombre = $request->nombre;
        $user->usuario = $request->usuario;
        $user->save();

        return response()->json($user);
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuario eliminado con éxito']);
    }
}
