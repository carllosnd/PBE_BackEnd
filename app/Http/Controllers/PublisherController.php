<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use http\Env\Response;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function getAll(){
        $publisher = Publisher::all();
        return response()->json([
            'data' => $publisher
        ], 200);
    }

    public function getById($id){
        $publisher = Publisher::find($id);
        if($publisher == null){
            return response()->json([], 404);
        }
        return response()->json([
            'data' => $publisher
        ], 200);
    }

    public function create(Request $request){
        $publisher = Publisher::create([
            'name' => $request->name
        ]);
        return response()->json([
            'data' => $publisher
        ], 201);
    }

    public function update(Request $request)
    {
        $publisher = Publisher::find($request->id);
        if ($publisher === null) {
            return response()->json([], 404);
        }
        $publisher->name = $request->name;
        $publisher->save();
        return response()->json([
            'data' => $publisher
        ], 200);
    }
    public function delete(Request $request)
    {
        $publisher = Publisher::find($request->id);
        if ($publisher === null) {
            return response()->json([], 404);
        }
        $publisher->delete();
        return response()->json([], 200);
    }

}
