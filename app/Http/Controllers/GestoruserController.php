<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipoUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class GestoruserController extends Controller
{
    public function index(Request $request)
    {
        $tipoUsuarios = TipoUsuario::all();

        $query = User::query();

        if ($request->has('ID_Tipo') && !empty($request->ID_Tipo)) {
            $query->where('ID_Tipo', $request->ID_Tipo);
        }

        $users = $query->with('tipoUsuario')->get();

        return view('admin.gestorUsers.index', compact('users', 'tipoUsuarios'));
    }

    // Mostrar el formulario de creación de usuario
    public function create()
    {
        $tipoUsuarios = TipoUsuario::all();
        return view('admin.gestorUsers.create', compact('tipoUsuarios'));
    }

    // Guardar el nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'apellido' => 'required|string|max:255',
            'nombreusuario' => 'required|string|max:255|unique:users',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:45',
            'ID_Tipo' => 'required|exists:tipo_usuarios,ID_Tipo',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'apellido' => $request->apellido,
            'nombreusuario' => $request->nombreusuario,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'estado' => 'activo', 
            'ID_Tipo' => $request->ID_Tipo,
        ]);

        $user->save();

        return redirect()->route('admin.gestorUsers.index')->with('success', 'Usuario creado con éxito.');
    }

    // Mostrar el formulario de edición de usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $tipoUsuarios = TipoUsuario::all();
        return view('admin.gestorUsers.edit', compact('user', 'tipoUsuarios'));
    }

    // Actualizar los datos del usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'apellido' => 'required|string|max:255',
            'nombreusuario' => 'required|string|max:255|unique:users,nombreusuario,' . $user->id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:45',
            'ID_Tipo' => 'required|exists:tipo_usuarios,ID_Tipo',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->apellido = $request->apellido;
        $user->nombreusuario = $request->nombreusuario;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->ID_Tipo = $request->ID_Tipo;

        $user->save();

        return redirect()->route('admin.gestorUsers.index')->with('success', 'Usuario actualizado con éxito.');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.gestorUsers.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
