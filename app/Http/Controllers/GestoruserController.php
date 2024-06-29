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

    public function create()
    {
        $tipoUsuarios = TipoUsuario::all();
        return view('admin.gestorUsers.create', compact('tipoUsuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'nombreusuario' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:45|unique:users',
            'ID_Tipo' => 'required|exists:tipo_usuarios,ID_Tipo',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'nombreusuario.required' => 'El nombre de usuario es obligatorio.',
            'nombreusuario.unique' => 'Este nombre de usuario ya está registrado.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.unique' => 'Este teléfono ya está registrado.',
            'ID_Tipo.required' => 'El tipo de usuario es obligatorio.',
            'ID_Tipo.exists' => 'El tipo de usuario no es válido.',
        ]);

        $user = new User([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'nombreusuario' => $request->nombreusuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'ID_Tipo' => $request->ID_Tipo,
            'estado' => 'activo', 
        ]);

        $user->save();

        return redirect()->route('admin.gestorUsers.index')->with('success', 'Usuario creado con éxito.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $tipoUsuarios = TipoUsuario::all();
        return view('admin.gestorUsers.edit', compact('user', 'tipoUsuarios'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'nombreusuario' => 'required|string|max:255|unique:users,nombreusuario,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:45|unique:users,telefono,' . $id,
            'ID_Tipo' => 'required|exists:tipo_usuarios,ID_Tipo',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'nombreusuario.required' => 'El nombre de usuario es obligatorio.',
            'nombreusuario.unique' => 'Este nombre de usuario ya está registrado.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.unique' => 'Este teléfono ya está registrado.',
            'ID_Tipo.required' => 'El tipo de usuario es obligatorio.',
            'ID_Tipo.exists' => 'El tipo de usuario no es válido.',
        ]);

        $user->update([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'nombreusuario' => $request->nombreusuario,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'ID_Tipo' => $request->ID_Tipo,
        ]);

        return redirect()->route('admin.gestorUsers.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.gestorUsers.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
