@extends('layouts.master')

@section('title')
    BookShop | รายการประเภทหนังสือ
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>รายการหนังสือ</strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{URL::to('typebooks/search')}}" method="post" class="form-inline">
                        {{ csrf_field() }}
                        <input type="text" name="search" placeholder="พิมพ์คำค้นหา" class="form-control">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                        <a href="{{asset(URL::to('typebooks/edit'))}}" class="btn btn-success pull-right">เพิ่มประเภทหนังสือ</a>
                    </form>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="active">
                            <th>ลำดับ</th>
                            <th>ชื่อประเภทหนังสือ</th>
                            <th>การทำงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($typebooks as $item)
                            <tr >
                                <td >{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td align="center">
                                    <a href="{{URL::to('typebooks/edit/' . $item->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> แก้ไข</a>
                                    <a href="{{URL::to('typebooks/destroy/' . $item->id)}}" onclick="return confirm('คุณต้องการลบประเภทหนังสือใช่หรือไม่ ?')" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  
                </table>
                <div class="panel-footer">
                    รวมรายการสินค้า {{count($typebooks)}} รายการ
                </div>
            </div>
        </div>
    </div>
</div>
@endsection