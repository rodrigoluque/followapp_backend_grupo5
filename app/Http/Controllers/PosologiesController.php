<?php

namespace App\Http\Controllers;

use App\Models\Posologies;
use Illuminate\Http\Request;

class PosologiesController extends Controller
{
    public function index()
    {
        $posologies = Posologies::all();
        return response()->json($posologies);
    }

    public function store(Request $request)
    {
        $rules = [
            'state' => 'required|string|max:10',
            'medical_order_date' => 'required|date',
            'frecuency' => 'required|numeric',
            'day_quantity' => 'required|numeric',
         ];

         $messages = [
            'state.required' => 'El campo estado es obligatorio.',
            'state.string' => 'El campo estado debe ser una cadena de texto.',
            'medical_order_date.required' => 'El campo fecha de la orden médica es obligatorio.',
            'medical_order_date.date' => 'El campo fecha de la orden médica debe ser una fecha válida.',
            'frecuency.required' => 'El campo frecuencia es obligatorio.',
            'frecuency.numeric' => 'El campo frecuencia debe ser un valor numérico.',
            'day_quantity.required' => 'El campo cantidad diaria es obligatorio.',
            'day_quantity.numeric' => 'El campo cantidad diaria debe ser un valor numérico.',
        ];

        $validator = \Validator::make($request->input() , $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $posologies = Posologies::create([
            'state' => $request->state,
            'medical_order_date' => $request->medical_order_date,
            'frecuency' => $request->frecuency,
            'day_quantity' => $request->day_quantity
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Posología creada correctamente',
        ],200);

    }

    public function show(Posologies $posologies)
    {
        return response()->json(['status' => true, 'data' => $posologies]);
    }

    public function update(Request $request, Posologies $posologies)
    {
        $rules = [
            'state' => 'required|string',
            'medical_order_date' => 'required|date',
            'frecuency' => 'required|numeric',
            'day_quantity' => 'required|numeric',
         ];

         $messages = [
            'state.required' => 'El campo estado es obligatorio.',
            'state.string' => 'El campo estado debe ser una cadena de texto.',
            'medical_order_date.required' => 'El campo fecha de la orden médica es obligatorio.',
            'medical_order_date.date' => 'El campo fecha de la orden médica debe ser una fecha válida.',
            'frecuency.required' => 'El campo frecuencia es obligatorio.',
            'frecuency.numeric' => 'El campo frecuencia debe ser un valor numérico.',
            'day_quantity.required' => 'El campo cantidad diaria es obligatorio.',
            'day_quantity.numeric' => 'El campo cantidad diaria debe ser un valor numérico.',
        ];

        $validator = \Validator::make($request->input() , $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $posologies->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Posología actualizada correctamente',
        ],200);
    }

    public function destroy(Posologies $posologies)
    {
        $posologies->delete();
        return response()->json([
            'status' => true,
            'message' => 'Posología eliminada correctamente',
        ],200);
    }
}
