<?php

namespace App\Http\Controllers;

use App\Models\Trash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrashController extends Controller
{
    public function index()
    {
        $trash = Trash::all();
        if($trash->count() > 0){
        return response()->json([
            'status' => 200 ,
            'trash' => $trash],200);
        }else{
            return response()->json([
                'status' => 404 ,
                'trash' => 'Trash not found'],404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
                'idCity' => 'required',
                'description' => 'required',
                'name' => 'required',
                'type' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422 ,
                'error' => $validator->messages()
            ],422);
        }else{
            $trash = Trash::create([
                'idCity' => $request->idCity,
                'description' => $request->description,
                'name' => $request->name,
                'type' => $request->type,
            ]);

            if($trash){
                return response()->json([
                    'status' => 200 ,
                    'message' => "Produto irregular criado com sucesso"],200);
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
    public function show(Trash $trash, $id)
    {
       $trash = Trash::find($id);
       if($trash){
        return response()->json([
            'status' => 200 ,
            'message' => $trash],200);
        }else{
            return response()->json([
                'status' => 500 ,
                'message' => 'OPS algo deu errado'],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trash $trash, $id)
    {
        $trash = Trash::find($id);
        if($trash){
         return response()->json([
             'status' => 200 ,
             'message' => $trash],200);
         }else{
             return response()->json([
                 'status' => 500 ,
                 'message' => 'OPS algo deu errado'],500);
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trash $trash, int $id)
    {
        $validator = Validator::make($request->all(),
        [
                'idCity' => 'required',
                'description' => 'required',
                'name' => 'required',
                'type' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422 ,
                'error' => $validator->messages()
            ],422);
        }else{
            $trash = Trash::find($id);
            if($trash){
                $trash->update([
                    'idCity' => $request->idCity,
                    'description' => $request->description,
                    'name' => $request->name,
                    'type' => $request->type,
                ]);
                return response()->json([
                    'status' => 200 ,
                    'message' => "Produto irregular alterada com sucesso"],200);
                }else{
                    return response()->json([
                        'status' => 404 ,
                        'message' => 'OPS algo deu errado'],404);
                }
            }
    }

    public function delete(Trash $trash, int $id)
    {
        $trash = Trash::find($id);
        if($trash)
        {
           $trash->delete();
           return response()->json([
            'status' => 200 ,
            'message' => 'Cidade removida'],200);
                }else{
                return response()->json([
                    'status' => 404 ,
                    'message' => 'OPS algo deu errado'],404);
            }
        }
    }
