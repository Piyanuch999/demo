@extends('layouts.master')

@section('title')
    BookShop | รายการหนังสือ
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
                        <form action="{{URL::to('books/search')}}" method="post" class="form-inline">
                            {{ csrf_field() }}
                            <input type="text" name="search" placeholder="พิมพ์คำค้นหา" class="form-control">
                            <button type="submit" class="btn btn-primary">ค้นหา</button>
                            <a href="{{asset(URL::to('books/edit'))}}" class="btn btn-success pull-right">เพิ่มหนังสือ</a>
                        </form>
                    </div>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="active">
                                <th>รูปหนังสือ</th>
                                <th>ชื่อหนังสือ</th>
                                <th>ประเภทหนังสือ</th>
                                <th>ราคาหนังสือ</th>
                                <th>การทำงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr >
                                    <td>
                                        <img src="{{URL::to($book->image_url)}}" width="50px" alt="">
                                    </td>
                                    <td >{{$book->title}}</td>
                                    <td>{{$book->typebooks->name}}</td>
                                    <td align="right">{{number_format($book->price,2)}}</td>
                                    <td align="center">
                                        <a href="{{URL::to('books/edit/' . $book->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> แก้ไข</a>
                                        <a href="{{URL::to('books/destroy/' . $book->id)}}" onclick="return confirm('คุณต้องการลบหนังสือใช่หรือไม่ ?')" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th colspan="3">
                                รวมราคา
                            </th>
                            <th class="text-right">
                                {{number_format($books->sum('price'),2)}}
                            </th>
                            <th></th>
                        </tfoot>
                    </table>
                    <div class="panel-footer">
                        รวมรายการสินค้า {{count($books)}} รายการ
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection