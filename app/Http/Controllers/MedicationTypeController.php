<?php

namespace App\Http\Controllers;

use App\Models\medication_type;
use Illuminate\Http\Request;

class MedicationTypeController extends Controller
{
    public function index()
    {
        $medication_types = Medication_type::all();
        return response()->json($medication_types);
    }

    public function store(Request $request)
    {
        $rules = [
            'pharmaceutical_name' => 'required|string|max:100',
            'instructions' => 'required|string|max:1000',
            'unit' => 'required|numeric',
            'drug_quantity' => 'required|numeric',
            'expiration_date' => 'required|date',
            'laboratory' => 'required|string|max:100',
         ];

         $messages = [
            'pharmaceutical_name.required' => 'El campo nombre del producto farmacéutico es obligatorio.',
            'pharmaceutical_name.string' => 'El campo nombre del producto farmacéutico debe ser una cadena de texto.',
            'pharmaceutical_name.max' => 'El campo nombre del producto farmacéutico no debe exceder los 100 caracteres.',
            'instruction.required' => 'El campo instrucciones es obligatorio.',
            'instruction.string' => 'El campo instrucciones debe ser una cadena de texto.',
            'instruction.max' => 'El campo instrucciones no debe exceder los 1000 caracteres.',
            'unit.required' => 'El campo unidad es obligatorio.',
            'unit.numeric' => 'El campo unidad debe ser un valor numérico.',
            'drug_quantity.required' => 'El campo cantidad de farmaco es obligatorio.',
            'drug_quantity.numeric' => 'El campo cantidad de farmaco debe ser un valor numérico.',
            'expiration_date.required' => 'El campo fecha de vencimiento es obligatorio.',
            'expiration_date.date' => 'El campo fecha de vencimiento debe ser una fecha válida.',
            'laboratory.required' => 'El campo laboratorio es obligatorio.',
            'laboratory.string' => 'El campo laboratorio debe ser una cadena de texto.',
            'laboratory.max' => 'El campo laboratorio no debe exceder los 100 caracteres.',
        ];

        $validator = \Validator::make($request->input() , $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $medication_type = Medication_type::create([
            'pharmaceutical_name' => $request->pharmaceutical_name,
            'instructions' => $request->instructions,
            'unit' => $request->unit,
            'drug_quantity' => $request->drug_quantity,
            'expiration_date' => $request->expiration_date,
            'laboratory' => $request->laboratory
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Tipo de medicación creado correctamente',
        ],200);
    }

    public function show(medication_type $medication_type)
    {
        return response()->json(['status' => true, 'data' => $medication_type]);
    }

    public function update(Request $request, medication_type $medication_type)
    {
        $rules = [
            'pharmaceutical_name' => 'required|string|max:100',
            'instructions' => 'required|string|max:1000',
            'unit' => 'required|numeric',
            'drug_quantity' => 'required|numeric',
            'expiration_date' => 'required|date',
            'laboratory' => 'required|string|max:100',
         ];

         $messages = [
            'pharmaceutical_name.required' => 'El campo nombre del producto farmacéutico es obligatorio.',
            'pharmaceutical_name.string' => 'El campo nombre del producto farmacéutico debe ser una cadena de texto.',
            'pharmaceutical_name.max' => 'El campo nombre del producto farmacéutico no debe exceder los 100 caracteres.',
            'instruction.required' => 'El campo instrucciones es obligatorio.',
            'instruction.string' => 'El campo instrucciones debe ser una cadena de texto.',
            'instruction.max' => 'El campo instrucciones no debe exceder los 1000 caracteres.',
            'unit.required' => 'El campo unidad es obligatorio.',
            'unit.numeric' => 'El campo unidad debe ser un valor numérico.',
            'drug_quantity.required' => 'El campo cantidad de farmaco es obligatorio.',
            'drug_quantity.numeric' => 'El campo cantidad de farmaco debe ser un valor numérico.',
            'expiration_date.required' => 'El campo fecha de vencimiento es obligatorio.',
            'expiration_date.date' => 'El campo fecha de vencimiento debe ser una fecha válida.',
            'laboratory.required' => 'El campo laboratorio es obligatorio.',
            'laboratory.string' => 'El campo laboratorio debe ser una cadena de texto.',
            'laboratory.max' => 'El campo laboratorio no debe exceder los 100 caracteres.',
        ];

        $validator = \Validator::make($request->input() , $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $medication_type->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Tipo de medicación actualizado correctamente',
        ],200);
    }

    public function destroy(medication_type $medication_type)
    {
        $medication_type->delete();
        return response()->json([
            'status' => true,
            'message' => 'Tipo de medicación eliminado correctamente',
        ],200);
    }
}
