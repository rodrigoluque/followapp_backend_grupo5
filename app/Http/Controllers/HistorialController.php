<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index()
    {
        $historiales = Historial::all();
        return response()->json($historiales);
    }

    public function store(Request $request)
    {
        $rules = [
            'afeccion' => 'required|string|max:30',
        'medicamento' => 'required|string|max:30',
        'forma_farmaceutica' => 'required|string|max:30',
        'composicion' => 'required|string|max:30',
        'tratamiento' => 'required|string|max:30',
        'fecha_inicio' =>'required|date',
        'hora_inicio' => 'required',
        'fecha_fin' => 'required|date',
        'hora_fin' => 'required',
        'cada_24' => 'required',
        'cada_12' => 'required',
        'cada_8' => 'required',
        'cada_6' => 'required',
        'antes_almuerzo_cena' => 'required',
        'despues_almuerzo_cena' => 'required',
        'cuando_sea_necesario' => 'required',
        'user_id' => 'required'
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

        $historial = Historial::create([
            'afeccion' => $request->afeccion,
            'medicamento' => $request->medicamento,
            'forma_farmaceutica' => $request->forma_farmaceutica,
            'composicion' => $request->composicion,
            'tratamiento' => $request->tratamiento,
            'fecha_inicio' => $request->fecha_inicio,
            'hora_inicio' => $request->hora_inicio,
            'fecha_fin' => $request->fecha_fin,
            'hora_fin' => $request->hora_fin,
            'cada_24' => $request->cada_24,
            'cada_12' => $request->cada_12,
            'cada_8' => $request->cada_8,
            'cada_6' => $request->cada_6,
            'antes_almuerzo_cena' => $request->antes_almuerzo_cena,
            'despues_almuerzo_cena' => $request->despues_almuerzo_cena,
            'cuando_sea_necesario' => $request->cuando_sea_necesario,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Historial creado correctamente',
        ],200);
    }

    public function show(Historial $historial)
    {
        return response()->json(['status' => true, 'data' => $historial]);
    }

    public function update(Request $request, Historial $historial)
    {
        //
    }

    public function destroy(Historial $historial)
    {
        //
    }
}
