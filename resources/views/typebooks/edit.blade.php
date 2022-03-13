@extends('layouts.master')

@section('title')
    BookShop | แก้ไขประเภทหนังสือ
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>แก้ไขประเภทหนังสือ</h1>
                <ul class="breadcrumb">
                    <li><a href="{{URL::to('typebooks')}}">หน้าแรก</a></li>
                    <li class="active">แก้ไขประเภทหนังสือ</li>
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
                            <strong>แก้ไขประเภทหนังสือ</strong>
                        </div>
                    </div>
                    {!! Form::model($typebook , array('action' => 'App\Http\Controllers\TypeBooksController@update','method'=>'post')) !!}
                    <input type="hidden" name="id" value="{{$typebook->id}}">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td width="25%">{{Form::label('name' , 'ชื่อประเภทหนังสือ')}}</td>
                            <td>{{Form::text('name' , $typebook->name , ['class'=>'form-control'])}}</td>
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