@extends('layouts.master')

@section('title')
    BookShop | แก้ไขหนังสือ
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>แก้ไขข้อมูลหนังสือ</h1>
                <ul class="breadcrumb">
                    <li><a href="{{URL::to('books')}}">หน้าแรก</a></li>
                    <li class="active">แก้ไขข้อมูลหนังสือ</li>
                </ul>

                @if ($errors -> any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <div>{{$error}}</div>
                        </div>
                    @endforeach
                @endif


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>แก้ไขข้อมูลหนังสือ</strong>
                        </div>
                    </div>
                    {!! Form::model($book , array('action' => 'App\Http\Controllers\BooksController@update','method'=>'post' , 'enctype'=>'multipart/form-data')) !!}
                    <input type="hidden" name="id" value="{{$book->id}}">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td width="25%">{{Form::label('title' , 'ชื่อหนังสือ')}}</td>
                            <td>{{Form::text('title' , $book->title , ['class'=>'form-control'])}}</td>
                        </tr>
                        <tr>
                            <td width="25%">{{Form::label('title' , 'ประเภทหนังสือ')}}</td>
                            <td>{{Form::select('typebooks_id' , $typebooks , Request::old('typebooks_id') , ['class'=>'form-control'])}}</td>
                        </tr>
                        <tr>
                            <td width="25%">{{Form::label('title' , 'ราคาหนังสือ')}}</td>
                            <td>{{Form::text('price' , $book->price , ['class'=>'form-control'])}}</td>
                        </tr>
                        <tr>
                            <td width="25%">รูปตัวอย่างสินค้า</td>
                            <td>
                                <img src="{{URL::to($book->image_url)}}" width="150px" alt="">    
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">{{Form::label('title' , 'อัปโหลดรูปหนังสือ')}}</td>
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