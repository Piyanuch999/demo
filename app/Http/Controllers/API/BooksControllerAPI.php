<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;

class BooksControllerAPI extends Controller
{
    //
    public function books_list($id = null)
    {
        if($id){
            $books = Books::Where('typebooks_id' , $id)->get();
        } else {
            $books = Books::all();
        }
        return response()->json([
            'ok' => true,
            'books' => $books
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if($search){
            $books = Books::where('title' , 'like' , '%'.$search.'%')->get();
        } else {
            $books = Books::all();
        }

        return response()->json([
            'ok'=>true,
            'books'=>$books
        ]);
    }
}
