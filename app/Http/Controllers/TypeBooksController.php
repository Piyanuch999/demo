<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\TypeBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $typebooks = TypeBooks::all();
        return view('typebooks/index' , compact('typebooks'));
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
            'name' => $request->name
        );

        $rules = array(
            'name' => 'required'
        );

        $message = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน'
        );

        $validator = Validator::make($data , $rules , $message);
        if($validator->fails()){
            return redirect('typebooks/edit/')
            ->withErrors($validator)
            ->withInput();
        }

        TypeBooks::create($request->all());

        return redirect('typebooks')
        ->with('ok',true)
        ->with('msg','แก้ไขข้อมูลสำเร็จ');
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
     * @param  \App\Models\TypeBooks  $typeBooks
     * @return \Illuminate\Http\Response
     */
    public function show(TypeBooks $typeBooks)
    {
        //
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if($search){
            $typebooks = TypeBooks::where('id','like' , '%'.$search.'%')
            ->orWhere('name' , 'like' , '%'.$search.'%')
            ->get();
        }
        else {
            $typebooks = TypeBooks::all();
        }

        return view('typebooks/index' , compact('typebooks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeBooks  $typeBooks
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
         //
         if($id){
             $typebook = TypeBooks::find($id);
             return view('typebooks/edit' , compact('typebook'));
         }
         else {
             return view('typebooks/add');
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeBooks  $typeBooks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        //
        $data = array(
            'name' => $request->name
        );

        $rules = array(
            'name' => 'required'
        );

        $message = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน'
        );

        $validator = Validator::make($data , $rules , $message);
        if($validator->fails()){
            return redirect('typebooks/edit/' . $id)
            ->withErrors($validator)
            ->withInput();
        }

        $typebook = TypeBooks::find($id);
        $typebook->update($request->all());

        return redirect('typebooks')
        ->with('ok',true)
        ->with('msg','แก้ไขข้อมูลสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeBooks  $typeBooks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        TypeBooks::find($request->id)->delete();
        return redirect('typebooks')
        ->with('ok',true)
        ->with('msg','ลบข้อมูลสำเร็จ');
    }
}
