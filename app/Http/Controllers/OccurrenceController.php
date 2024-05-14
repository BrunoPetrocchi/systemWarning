<?php

namespace App\Http\Controllers;

use App\Models\Occurrence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OccurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ocorrencia = Occurrence::all();
        if($ocorrencia->count() > 0){
        return response()->json([
            'status' => 200 ,
            'ocorrencia' => $ocorrencia],200);
        }else{
            return response()->json([
                'status' => 404 ,
                'ocorrencia' => 'Ocurrence not found'],404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
                'idCity' => 'required',
                'idTrash' => 'required',
                'descricao' => 'required',
                'cep' => 'required',
                'logradouro' => 'required',
                'bairro' => 'required',
                'localidade' => 'required',
                'complemento' => 'required',
                'numero' => 'required',
                'status' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422 ,
                'error' => $validator->messages()
            ],422);
        }else{
            $ocorrencia = Occurrence::create([
                'idCity' => $request->idCity,
                'idTrash' => $request->idTrash,
                'descricao' => $request->descricao,
                'cep' => $request->cep,
                'logradouro' => $request->logradouro,
                'bairro' => $request->bairro,
                'localidade' => $request->localidade,
                'complemento' => $request->complemento,
                'numero' => $request->numero,
                'status' => $request->status,
            ]);

            if($ocorrencia){
                return response()->json([
                    'status' => 200 ,
                    'message' => "Ocorrencia criado com sucesso"],200);
                }else{
                    return response()->json([
                        'status' => 500 ,
                        'message' => 'OPS algo deu errado'],500);
                }
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Trash $ocorrencia, $id)
    {
       $ocorrencia = Trash::find($id);
       if($ocorrencia){
        return response()->json([
            'status' => 200 ,
            'message' => $ocorrencia],200);
        }else{
            return response()->json([
                'status' => 500 ,
                'message' => 'OPS algo deu errado'],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Occurrence $ocorrencia, $id)
    {
        $ocorrencia = Occurrence::find($id);
        if($ocorrencia){
         return response()->json([
             'status' => 200 ,
             'message' => $ocorrencia],200);
         }else{
             return response()->json([
                 'status' => 500 ,
                 'message' => 'OPS algo deu errado'],500);
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Occurrence $ocorrencia, int $id)
    {
        $validator = Occurrence::make($request->all(),
        [
            'idCity' => 'required',
            'idTrash' => 'required',
            'descricao' => 'required',
            'cep' => 'required',
            'logradouro' => 'required',
            'bairro' => 'required',
            'localidade' => 'required',
            'complemento' => 'required',
            'numero' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422 ,
                'error' => $validator->messages()
            ],422);
        }else{
            $ocorrencia = Occurrence::find($id);
            if($ocorrencia){
                $ocorrencia->update([
                    'idCity' => $request->idCity,
                    'idTrash' => $request->idTrash,
                    'descricao' => $request->descricao,
                    'cep' => $request->cep,
                    'logradouro' => $request->logradouro,
                    'bairro' => $request->bairro,
                    'localidade' => $request->localidade,
                    'complemento' => $request->complemento,
                    'numero' => $request->numero,
                    'status' => $request->status,
                ]);
                return response()->json([
                    'status' => 200 ,
                    'message' => "Ocorrencia alterada com sucesso"],200);
                }else{
                    return response()->json([
                        'status' => 404 ,
                        'message' => 'OPS algo deu errado'],404);
                }
            }
    }

    public function delete(Occurrence $ocorrencia, int $id)
    {
        $ocorrencia = Occurrence::find($id);
        if($ocorrencia)
        {
           $ocorrencia->delete();
           return response()->json([
            'status' => 200 ,
            'message' => 'Ocorrencia removida'],200);
                }else{
                return response()->json([
                    'status' => 404 ,
                    'message' => 'OPS algo deu errado'],404);
            }
        }
    }
