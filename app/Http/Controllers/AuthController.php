<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(Request $request)
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
            'assurance' => 'required|string|min:4',
            'assurance_number' => 'required|numeric',
            'rol' => 'required|string|min:4'

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
            'cellphone' => $request->cellphone,
            'mail' => $request->mail,
            'password' => Hash::make($request->password),
            'password_date' => '2023-10-28',
            'logon_date' => '2023-10-28',
            // 'assurance_id' => $request->assurance_id,
            // 'rol_id'=> $request->rol_id
            'assurance' => $request->assurance,
            'assurance_number' => $request->assurance_number,
            'rol' => $request->rol
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Usuario creado correctamente',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);
    }

    public function login(Request $request)
    {
        $rules = [
            'user' => 'required|string|max:100',
            'password' => 'required|string',
        ];

        $messages = [
            'user.required' => 'El campo usuario es obligatorio.',
            'user.string' => 'El campo usuario debe ser una cadena de texto.',
            'user.max' => 'El campo usuario no debe exceder los 100 caracteres.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
        ];

        $validator = \Validator::make($request->input() , $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        if(!Auth::attempt($request->only('user','password'))){
            return response()->json([
                'status' => false,
                'errors' => ['Unauhthorized']
            ],401);
        }

        $user = User::where('user', $request->user)->first();

        return response()->json([
        'status' => true,
        'message' => 'Usuario logueado correctamente',
        'data' => $user,
        'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Usuario deslogueado correctamente',
        ],200);
    }

}
