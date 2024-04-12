<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Medicine::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $inputs = $request->input();
        $m = Medicine::create($inputs);
        return response()->json([
            'data'=>$m,
            'mensaje'=>"Medicamento registrado correctamente"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $m = Medicine::find($id);
        if(isset($m)){

            return response()->json([
                'data'=>$m,
                'mensaje'=>"Medicamento encontrado"
            ]);

        }else{

            return response()->json([
                'error'=>true,
                'mensaje'=>"Medicamento inexistente"
            ]);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $m = Medicine::find($id);
        if(isset($m)){

            $m->name = $request -> name;
            $m->quantity = $request -> quantity;
            $m->presentation = $request -> presentation;
            $m->description = $request -> description;
            if( $m-> save()){
                return response()->json([
                    'data'=>$m,
                    'mensaje'=>"Info. del medicamento actualizada."
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No se actualizó correctamente"
                ]);
            }

        }else{

            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el medicamento"
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $m = Medicine::find($id);
        if(isset($m)){
            $res=Medicine::destroy($id);
            if($res){

                return response()->json([
                    'data'=>[],
                    'mensaje'=>"Medicamento eliminado"
                ]);

            }

        }else{

            return response()->json([
                'error'=>true,
                'mensaje'=>"Medicamento inexistente"
            ]);

        }
    }
}
