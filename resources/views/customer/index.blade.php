@extends('layouts.master')

@section('title')
    BookShop | รายการสมาชิก
@endsection

@section('content')
    <div class="container" ng-app="app" ng-controller="customerController">
        <div class="row">
            <div class="col-md-12">
                <h2>รายชื่อสมาชิก</h2>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th class="text-right">
                                <button 
                                id="btn-add" 
                                class="btn btn-primary "
                                ng-click="toggle('add', 0)">
                                เพิ่มสมาชิกใหม่
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="customer in customers">
                            <td> @{customer.id}</td>
                            <td> @{customer.name}</td>
                            <td> @{customer.username}</td>
                            <td align="center"> 
                                <button class="btn btn-default btn-detail" ng-click="toggle('edit',customer.id)">
                                    แก้ไข
                                </button>
                                <button class="btn btn-danger btn-delete" ng-click="confirmDelete(customer.id)">ลบข้อมูล</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class=" modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="Modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="padding:10 20px">
                            <div class="model-header">
                                <h5 class="modal-title">@{form_title}</h5>
                                <button type="button" class="close" data-dismis="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="frmcustomer" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                        <label for="name" class="col-sm-12 control-label" >ชื่อจริง-นามสกุล</label>
                                        <input 
                                        type="text" 
                                        class="form-control has-error" 
                                        id="name" 
                                        name="name" 
                                        placeholder="ชื่อจริง-นามสกุล" 
                                        value="@{name}" 
                                        ng-model="customer.name"
                                        ng-required="true"
                                        >
                                        <span class="help-inline" ng-show="frmcustomer.name.$invalid && frmcustomer.name.$touched">กรุณากรอกชื่อเต็มให้ครบถ้วน</span>
                                    </div>
                                    <div class="form-group error">
                                        <label for="username" class="col-sm-12 control-label" >ชื่อผู้ใช้</label>
                                        <input 
                                        type="text" 
                                        class="form-control has-error" 
                                        id="username" 
                                        username="username" 
                                        placeholder="ชื่อผู้ใช้" 
                                        value="@{username}" 
                                        ng-model="customer.username"
                                        ng-required="true"
                                        >
                                        <span class="help-inline" ng-show="frmcustomer.username.$invalid && frmcustomer.username.$touched">กรุณากรอกชื่อผู้ใช้ให้ครบถ้วน</span>
                                    </div>
                                    <div class="form-group error">
                                        <label for="password" class="col-sm-12 control-label" >รหัสผ่าน</label>
                                        <input 
                                        type="password" 
                                        class="form-control has-error" 
                                        id="password" 
                                        password="password" 
                                        placeholder="รหัสผ่าน" 
                                        value="@{password}" 
                                        ng-model="customer.password"
                                        ng-required="true"
                                        >
                                        <span class="help-inline" ng-show="frmcustomer.password.$invalid && frmcustomer.password.$touched">กรุณากรอกรหัสผ่านให้ครบถ้วน</span>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismis="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(state,id)" ng-disabled="frmcustomer.$invalid">บันทึกข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        var app = angular.module('app',[]).config(function($interpolateProvider){
            $interpolateProvider.startSymbol('@{').endSymbol('}');
        }).constant('API_URL' , 'http://localhost:8000/api/')

        app.controller('customerController', ($scope , $http , API_URL) =>{
            //SHOW DATA
            $http({
                method:'GET',
                url:API_URL+"customers"
            }).then(res =>{
                $scope.customers = res.data.customers;
                console.log(res)
            }),(error) =>{
                console.log(error)
                alert('ไม่สามารถโหลดข้อมูลได้')
            }
            
            $scope.toggle = (state , id) => {
                $scope.state = state;
                $scope.customer = null;

                switch(state){
                    case 'add':
                        $scope.form_title = 'เพิ่มผู้ใช้ใหม่'
                    break;
                    case 'edit': 
                        $scope.form_title = 'แก้ไขข้อมูลสมาชิก';
                        $scope.id = id;
                        $http.get(API_URL + 'customers/' + id)
                        .then(res=>{
                            $scope.customer = res.data.customer;
                        });
                        break;
                    default: break;
                }

                console.log(id);
                $('#modal').modal('show');
            }

            $scope.save = (state,id)=>{
                let url = API_URL + 'customers';
                let method = 'POST';

                let errorMessage = 'ไม่สามารถเพิ่มข้อมูลได้';
                // เพิ่มตัว / ถ้าเกิดว่า stateเป็นแก้ไข และเปลี่ยน method เป็น PUT แทน
                if(state === 'edit'){
                    url += '/' + id;
                    method = "PUT";
                    errorMessage = 'ไม่สามารถแก้ไขข้อมูลได้'
                }

                $http({
                    method:method,
                    url:url,
                    data:$.param($scope.customer),
                    headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
                }).then(res=>{
                    console.log(res)
                    location.reload()
                }) , error=>{
                    console.log(error)
                    alert(errorMessage)
                }
            }

            $scope.confirmDelete = (id) =>{
                let isConfirmDelete = confirm('คุณต้องการลบข้อมูลใช่หรือไม่');
                if(isConfirmDelete){
                    $http({
                        method:'DELETE',
                        url:API_URL + 'customers/'+id,
                    }).then(res=>{
                        console.log(res);
                        location.reload();
                    }),error =>{
                        console.log(error)
                        alert('ไม่สามารถลบข้อมูลได้')
                    }
                }
            }
        });
    </script>
@endsection