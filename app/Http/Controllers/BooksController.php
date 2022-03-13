<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\TypeBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Books::all();
        return view('books/index' , compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $data = array(
            'title' => $request->title,
            'typebooks_id' => $request->typebooks_id,
            'price'=>$request->price
        );

        $rules = array(
            'title' => 'required',
            'typebooks_id' => 'required|numeric',
            'price'=>'numeric'
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข'
        );
        $id = $request->id;

        $validator = Validator::make($data , $rules , $messages);
        if($validator->fails()){
            return redirect('books/edit/')
            ->withErrors($validator)
            ->withInput();
        }

        $input = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');

            $upload_to = 'upload/images';

            $relative_path = $upload_to.'/'.$file->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;

            // upload
            $file->move($absolute_path , $file->getClientOriginalName());
            Image::make(public_path().'/'.$relative_path)->resize(250,250)->save();
            $input['image_url'] = "$relative_path";
        }
        else {
            unset($input['image_url']);
        }

        Books::create($input);
        
        return redirect('books')
        ->with('ok',true)
        ->with('msg','เพิ่มข้อมูลสำเร็จ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        //
        $typebooks = TypeBooks::pluck('name','id')->prepend('กรุณาเลือกประเภทหนังสือ','');
        if($id){
            $book = Books::find($id);
            return view('books/edit')
            ->with('book' , $book)
            ->with('typebooks' , $typebooks);
        }
        else {
            return view('books/add')
            ->with('typebooks' , $typebooks);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        
        $data = array(
            'title' => $request->title,
            'typebooks_id' => $request->typebooks_id,
            'price'=>$request->price
        );

        $rules = array(
            'title' => 'required',
            'typebooks_id' => 'required|numeric',
            'price'=>'numeric'
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข'
        );
        $id = $request->id;

        $validator = Validator::make($data , $rules , $messages);
        if($validator->fails()){
            return redirect('books/edit/' . $id)
            ->withErrors($validator)
            ->withInput();
        }

        $input = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');

            $upload_to = 'upload/images';

            $relative_path = $upload_to.'/'.$file->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;

            // upload
            $file->move($absolute_path , $file->getClientOriginalName());
            Image::make(public_path().'/'.$relative_path)->resize(250,250)->save();
            $input['image_url'] = "$relative_path";
        }
        else {
            unset($input['image_url']);
        }

        $book = Books::find($id);
        $book->update($input);
        
        return redirect('books')
        ->with('ok',true)
        ->with('msg','แก้ไขข้อมูลสำเร็จ');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if($search){
            $books = Books::where('id','like' , '%'.$search.'%')
            ->orWhere('title' , 'like' , '%'.$search.'%')
            ->get();
        }
        else {
            $books = Books::all();
        }

        return view('books/index' , compact('books'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Books::find($request->id)->delete();

        return redirect('books')
        ->with('ok',true)
        ->with('msg','ลบข้อมูลสำเร็จ');
    }
}
