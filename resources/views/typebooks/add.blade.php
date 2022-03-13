@extends('layouts.master')

@section('title')
    BookShop | เพิ่มประเภทหนังสือ
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>เพิ่มประเภทหนังสือ</h1>
            <ul class="breadcrumb">
                <li><a href="{{URL::to('typebooks')}}">หน้าแรก</a></li>
                <li class="active">เพิ่มประเภทหนังสือ</li>
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
                        <strong>เพิ่มประเภทหนังสือ</strong>
                    </div>
                </div>
                {{-- 'action' => 'App\Http\Controllers\TypeBooksController@update', --}}
                {!! Form::open(array('action' => 'App\Http\Controllers\TypeBooksController@create','method'=>'post')) !!}
                <table class="table table-bordered table-striped">
                    <tr>
                        <td width="25%">{{Form::label('name' , 'ชื่อประเภทหนังสือ')}}</td>
                        <td>{{Form::text('name' ,Request::old('name'), ['class'=>'form-control'])}}</td>
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