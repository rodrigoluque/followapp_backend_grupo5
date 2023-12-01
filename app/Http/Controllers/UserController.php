<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $rules = [
            'user' => 'required|string|max:30',
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'dni' => 'required|numeric',
            'born_date' => 'required|date',
            'mail' => 'required|string|email|max:100|unique:users',
            'cellphone' => 'required|numeric',
            'password' => 'required|string|min:8',
            'password_date' => 'required|date',
            'logon_date' => 'required|date',
            //'assurance_id' => 'required|numeric',
            //'rol_id' => 'required|numeric'
            'assurance' => 'required|string|min:4',
            'assurance_number' => 'required|numeric',
            'rol' => 'required|string|min:4',
         ];

         $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'max' => [
                'string' => 'El campo :attribute no debe tener más de :max caracteres.',
            ],
            'numeric' => 'El campo :attribute debe ser un número.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'unique' => 'El valor del campo :attribute ya está en uso.',
            'min' => [
                'string' => 'El campo :attribute debe tener al menos :min caracteres.',
            ],
        ];

        $validator = \Validator::make($request->input() , $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $user = User::create([
            'user' => $request->user,
            'name' => $request->name,
            'surname' => $request->surname,
            'dni' => $request->dni,
            'born_date' => $request->born_date,
            'mail' => $request->mail,
            'cellphone' => $request->cellphone,
            'password' => $request->password,
            'password_date' => $request->password_date,
            'logon_date' => $request->logon_date,
            //'assurance_id' => $request->assurance_id,
            //'rol_id' => $request->rol_id
            'assurance' => $request->assurance,
            'assurance_number' => $request->assurance_number,
            'rol' => $request->rol
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Usuario creado correctamente',
        ],200);
    }

    public function show(User $user)
    { dd($user);
        return response()->json(['status' => true, 'data' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'user' => 'required|string|max:30',
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'dni' => 'required|numeric',
            'born_date' => 'required|date',
            'mail' => 'required|string|email|max:100|unique:users',
            'cellphone' => 'required|numeric',
            'password' => 'required|string|min:8',
            'password_date' => 'required|date',
            'logon_date' => 'required|date',
            // 'assurance_id' => 'required|numeric',
            // 'rol_id' => 'required|numeric'
              'assurance' => $request->assurance,
            'assurance_number' => $request->assurance_number,
            'rol' => $request->rol
         ];

         $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'max' => [
                'string' => 'El campo :attribute no debe tener más de :max caracteres.',
            ],
            'numeric' => 'El campo :attribute debe ser un número.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'unique' => 'El valor del campo :attribute ya está en uso.',
            'min' => [
                'string' => 'El campo :attribute debe tener al menos :min caracteres.',
            ],
        ];


        $validator = \Validator::make($request->input() , $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $user->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Usuario actualizado correctamente',
        ],200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'Usuario eliminado correctamente',
        ],200);
    }


    public function getUserHistorials($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $historials = $user->historials;

        return response()->json(['historials' => $historials]);
    }

}
