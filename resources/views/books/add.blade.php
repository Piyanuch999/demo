@extends('layouts.master')

@section('title')
    BookShop | เพิ่มหนังสือ
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>เพิ่มหนังสือ</h1>

                <ul class="breadcrumb">
                    <li><a href="{{URL::to('books')}}">หน้าแรก</a></li>
                    <li class="active"></li>
                </ul>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>เพิ่มข้อมูลหนังสือ</strong>
                        </div>
                    </div>
                    {{-- 'action' => 'App\Http\Controllers\BooksController@update', --}}
                    {!! Form::open(array('action' => 'App\Http\Controllers\BooksController@create','method'=>'post' , 'enctype'=>'multipart/form-data')) !!}
                   
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td width="25%">{{Form::label('title' , 'ชื่อหนังสือ')}}</td>
                            <td>{{Form::text('title' , Request::old('title') , ['class'=>'form-control'])}}</td>
                        </tr>
                        <tr>
                            <td width="25%">{{Form::label('typebooks_id' , 'ประเภทหนังสือ')}}</td>
                            <td>{{Form::select('typebooks_id' , $typebooks , Request::old('typebooks_id') , ['class'=>'form-control'])}}</td>
                        </tr>
                        <tr>
                            <td width="25%">{{Form::label('price' , 'ราคาหนังสือ')}}</td>
                            <td>{{Form::text('price' ,  Request::old('price') , ['class'=>'form-control'])}}</td>
                        </tr>

                        <tr>
                            <td width="25%">{{Form::label('image' , 'อัปโหลดรูปหนังสือ')}}</td>
                            <td>{{Form::file('image' , ['class'=>'form-control'])}}</td>
                        </tr>
                    </table>
                    <div class="panel-body">
                        <button type="reset" class="btn btn-danger">ยกเลิก</button>
                        <button type="submit" class="btn btn-success">บันทึก</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection