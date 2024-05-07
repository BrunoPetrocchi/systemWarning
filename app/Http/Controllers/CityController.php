<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {
        $city = City::all();
        if($city->count() > 0){
        return response()->json([
            'status' => 200 ,
            'city' => $city],200);
        }else{
            return response()->json([
                'status' => 404 ,
                'city' => 'City not found'],404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
                'name' => 'required',
                'zipcode_init' => 'required',
                'zipcode_end' => 'required',
                'email' => 'required|unique:cities,email',
                'status' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422 ,
                'error' => $validator->messages()
            ],422);
        }else{
            $city = City::create([
                'name' => $request->name,
                'zipcode_init' => $request->zipcode_init,
                'zipcode_end' => $request->zipcode_end,
                'email' => $request->email,
                'status' => $request->status,
            ]);

            if($city){
                return response()->json([
                    'status' => 200 ,
                    'message' => "Cidade criada com sucesso"],200);
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
    public function show(City $empresa, $id)
    {
       $city = City::find($id);
       if($city){
        return response()->json([
            'status' => 200 ,
            'message' => $city],200);
        }else{
            return response()->json([
                'status' => 500 ,
                'message' => 'OPS algo deu errado'],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city, $id)
    {
        $city = City::find($id);
        if($city){
         return response()->json([
             'status' => 200 ,
             'message' => $city],200);
         }else{
             return response()->json([
                 'status' => 500 ,
                 'message' => 'OPS algo deu errado'],500);
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city, int $id)
    {
        $validator = Validator::make($request->all(),
        [
                'name' => 'required',
                'zipcode_init' => 'required',
                'zipcode_end' => 'required',
                'email' => 'required|unique:cities,email',
                'status' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422 ,
                'error' => $validator->messages()
            ],422);
        }else{
            $city = City::find($id);
            if($city){
                $city->update([
                    'name' => $request->name,
                    'zipcode_init' => $request->zipcode_init,
                    'zipcode_end' => $request->zipcode_end,
                    'email' => $request->email,
                    'status' => $request->status,
                ]);
                return response()->json([
                    'status' => 200 ,
                    'message' => "Cidade alterada com sucesso"],200);
                }else{
                    return response()->json([
                        'status' => 404 ,
                        'message' => 'OPS algo deu errado'],404);
                }
            }
    }

    public function delete(City $city, int $id)
    {
        $city = City::find($id);
        if($city)
        {
           $city->delete();
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
