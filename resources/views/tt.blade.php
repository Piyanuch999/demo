@extends('layouts.master')

@section('title')
    BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง
@endsection

@section('content')
    <div class="container" ng-app="app" ng-controller='ctrl'>
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item" ng-class="{'active' : category == null}" ng-click="getProductList()">ทั้งหมด</a>
                    <a 
                    href="#" 
                    class="list-group-item" 
                    ng-repeat="c in categories"
                    ng-click="getProductList(c)"
                    ng-class="{'active':category.id == c.id}"
                    >
                        @{c.name}
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-3" ng-repeat="product in products">
                        {{-- Product card --}}
                        <div class="panel panel-default bs-product-card">
                            <img ng-src="@{product.image_url}" class="img-responsive" alt="">
                            <div class="panel-body">
                                <h5><a href="#">@{product.name}</a></h5>
                                <div class="form-group">
                                    <div>คงเหลือ : @{product.stock_qty}</div>
                                    <div>ราคา : <strong>@{product.price|number:2}</strong> บาท</div>
                                </div>

                                <a href="" class="btn btn-success btn-block">
                                    <i class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า
                                </a>

                            </div>
                        </div>
                        {{-- end Product card --}}
                    </div>
                </div>
            </div>
            <h3 ng-if="!products.length">ไม่พบข้อมูลสินค้า</h3>
        </div>
        
        
    </div>

    <script type="text/javascript">
        var app = angular.module('app',[]).config(function ($interpolateProvider) {
            $interpolateProvider.startSymbol('@{').endSymbol('}');
        });

        app.service('productService' , function($http){
            this.getProductList =  (category_id) => {
                if(category_id)
                    return $http.get('/api/product/' + category_id);
                return $http.get('/api/product')
            }
            this.getCategoriesList = () => $http.get('/api/category')
        });

        app.controller('ctrl' , ($scope, productService) => {
            $scope.products = [];
            $scope.categories = [];

            $scope.getProductList = (category)=> {
                $scope.category = category
                category_id = category != null ? category.id : '';
                productService.getProductList(category_id)
                .then((res)=> {
                    if(!res.data.ok) return;
                    $scope.products = res.data.products;   
                });
            };
            $scope.getCategoriesList = () =>{
                productService.getCategoriesList()
                .then((res)=>{
                    if(!res.data.ok) return;
                    $scope.categories = res.data.categories
                })
            }

            $scope.getProductList(null)
            $scope.getCategoriesList()
           
        });
    </script>
@endsection