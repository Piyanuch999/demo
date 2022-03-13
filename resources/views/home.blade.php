@extends('layouts.master')

@section('title')
    BookShop | ร้านขายหนังสือ
@endsection

@section('content')
    <div class="container" ng-app="joe" ng-controller="joeController">
        <div class="row">
            <div class="col-md-3">
                <h1>สินค้าในร้าน</h1>
                <div class="list-group">
                    <a href="#" class="list-group-item" ng-class="{'active' : typebook==null}" ng-click="getBooksList()">
                        ทั้งหมด
                    </a>
                    <a href="#" class="list-group-item" ng-repeat="t in typesbook" ng-click="getBooksList(t)" ng-class="{'active':typebook.id == t.id}">
                        @{t.name}
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="pull-right" style="margin-top:10px">
                        <input type="text" class="form-control pull-right" ng-model="search" ng-keyup="searchBooks($event)" style="width:190px" placeholder="พิมพ์ชื่อหนังสือที่ต้องการค้นหา">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" ng-repeat="b in books">
                        <div class="panel panel-default bs-product-card">
                            <img src="@{b.image_url}" class="img-responsive">
                            <div class="panel-body">
                                <h4><a href="#">@{b.title}</a></h4>
                                <div class="form-group">
                                    <div>ราคา : <strong>@{b.price|number:2}</strong> บาท</div>
                                </div>

                                <a href="#" class="btn btn-success btn-block">
                                    <i class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <h3 ng-if="!books.length">ไม่พบข้อมูล</h3>
            </div>
        </div>
    </div>
    <script>
        var app = angular.module('joe', []).config(($interpolateProvider) => {
            $interpolateProvider.startSymbol('@{').endSymbol('}');
        });

        app.controller('joeController', ($scope, $http) => {
            $scope.getBooksList = (typebook) => {
                $scope.typebook = typebook;
                typebook_id = typebook != null ? typebook.id : '';
                $http.get('/api/books/' + typebook_id)
                .then(res => {
                    if (!res.data.ok) return;
                    $scope.books = res.data.books
                })
            }

            $http.get('/api/typebook')
            .then(res => {
                if (!res.data.ok) return;
                $scope.typesbook = res.data.typesbook
            })

            $scope.searchBooks = (e) => {
                $http({
                    url:'/api/books/search',
                    method:'post',
                    data:{search:$scope.search}
                }).then(res => {
                    if(!res.data.ok) return;
                    $scope.books = res.data.books
                })
            }
            $scope.getBooksList()

        });
    </script>
@endsection
