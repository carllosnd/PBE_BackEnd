<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function getAll()
    {
        $books = Book::query()->with('publisher')->get();
        return response()->json([
            'data' => $books
        ], 200);
    }

    public function getById($id)
    {
        $book = Book::query()
            ->with('publisher')
            ->where('id',$id)->first();
        if($book === null){
            return response()->json([], 404);
        }
        return response()->json([
            'data' => [
                'id' => $book->id,
                'code' => $book->code,
                'title' => $book->title,
                'publisher_year' => $book->publisher_year,
                'id_publisher' => $book->id_publisher,
                'name_publisher' => $book->publisher->name
            ]
        ], 200);
    }

    public function create(Request $request)
    {
        $validateData = $request->validate([
            'code'=> 'required',
            'title' => 'required',
            'published_year'=> 'required',
            'city'=> 'required',
            'id_publisher'=> 'required'
        ]);
        $book = Book::create([
            'code'=> $request->code,
            'title' => $request->title,
            'published_year'=> $request->published_year,
            'city'=> $request->city,
            'id_publisher'=> $request->id_publisher,
        ]);
        return response()->json([
            'data' => $book
        ], 201);
    }
}
