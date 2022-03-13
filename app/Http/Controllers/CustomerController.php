<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json([
            'error' => false,
            'customers' => customer::all(),
        ] , 200);
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
        $validation = Validator::make($request->all() , [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'msg' => $validation->errors()
            ]);
        } else {
            customer::create($request->all());
            return response()->json([
                'error' => false,
                'customers' => customer::all(),
            ] , 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $customer = customer::find($id);
        if(is_null($customer)){
            return response()->json([
                'error'=>true,
                'msg'=> 'ไม่พบข้อมูล'
            ] , 404);
        }
        
        return response()->json([
            'error'=>'false',
            'customer'=>$customer
        ] , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validation = Validator::make($request->all() , [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => true,
                'msg' => $validation->errors()
            ],200);
        } else {
            $customer = customer::find($id);
            $customer->update($request->all());

            return response()->json([
                'error'=>'false',
                'customer'=>$customer
            ] , 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $customer = customer::find($id);

        if(is_null($customer)){
            return response()->json([
                'error' => true,
                'msg' => 'ไม่พบข้อมูล'
            ],404);
        }

        $customer->delete();

        return response()->json([
            'error'=>false,
            'msg' => 'ลบข้อมูลสำเร็จ'
        ],200);

    }
}
