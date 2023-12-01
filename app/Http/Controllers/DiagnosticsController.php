<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;

class DiagnosticsController extends Controller
{
    public function index()
    {
        $diagnostics = Diagnostic::all();
        return response()->json($diagnostics);
    }

    public function store(Request $request)
    {
        $rules = [
            'treatment_date'=> 'required|date',
            'treatment_hour' => 'required|date_format:H:i',
            'diagnostic' => 'required|string|max:500',
            'observation' => 'required|string|max:1000',
         ];

        $validator = \Validator::make($request->input() , $rules);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $diagnostics = Diagnostic::create([
            'treatment_date' => $request->treatment_date,
            'treatment_hour' => $request->treatment_hour,
            'diagnostic' => $request->diagnostic,
            'observation' => $request->observation,
            'user_id' => $request->user_id,
            'medicament_id' => $request->medicament_id
            //'treatment_id' => $request->treatment_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Diagnostico creado correctamente'
        ],200);

    }

    public function show(Diagnostic $diagnostic)
    {
        return response()->json(['status' => true, 'data' => $diagnostic]);
    }

    public function update(Request $request, Diagnostic $diagnostic)
    {
        $rules = [
            'treatment_date'=> 'required|date',
            'treatment_hour' => 'required|date_format:H:i',
            'diagnostic' => 'required|string|max:500',
            'observation' => 'required|string|max:1000',
         ];

        $validator = \Validator::make($request->input() , $rules);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $diagnostic->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Diagnostico actualizado correctamente',
        ],200);
    }

    public function destroy(Diagnostic $diagnostic)
    {
        $diagnostic->delete();
        return response()->json([
            'status' => true,
            'message' => 'Diagnostico eliminado correctamente',
        ],200);
    }
}
