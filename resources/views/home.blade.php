@extends('layouts.app')
@section('content')
<div class="container">
    <div ng-controller="myCtrl">
        <div class="col-xs-3">
            <form>
                <div class="form-group" class="col-sm-6">
                    <label for="usr">Productname:</label>
                    <input type="text" class="form-control" name="firstname" ng-model="firstname" required>
                </div>
                <div class="form-group" class="col-sm-6">
                    <label for="pwd">ProductSize:</label>
                    <input type="number" class="form-control" ng-model="lastname" required>
                </div>
                <div class="form-group" class="col-sm-6">
                    <label for="pwd">Price:</label>
                    <input type="number" class="form-control" ng-model="age" required>
                </div><br>
                <button type="submit" class="btn btn-primary" ng-click="addData(data)">Add Data</button><br/><br/>
            </form>
        </div>

        <div class="input-group" style="clear: both; float: right; margin-bottom: 15px;">
            <div class="form-group" class="col-sm-6">
                <input type="text" class="form-control" placeholder="Search" ng-model="search">
            </div>
        </div>
        <table class="table">
            <tr>
                <th>Productname</th>
                <th>Productsize</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <tr ng-repeat="data in tableData | filter:search" id="<%data.id%>">
                <td><%data.firstname%></td>
                <td><%data.lastname%></td>
                <td><%data.age%></td>
                <td><a href="#" ng-click="deleteData(data.id,$index)">Delete</a> | <a href="#" data-toggle="modal" data-target="#myModal" ng-click="update(data,$index)">Update</a></td>
            </tr>
        </table>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Data</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group" class="col-sm-6">
                                <label for="usr">Firstname:</label>
                                <input type="text" class="form-control" name="firstname" ng-model="uname">
                            </div>
                            <div class="form-group" class="col-sm-6">
                                <label for="pwd">Lastname:</label>
                                <input type="text" class="form-control" ng-model="lname">
                            </div>
                            <div class="form-group" class="col-sm-6">
                                <label for="pwd">age:</label>
                                <input type="number" class="form-control" ng-model="ages">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="updatedData(productid,data)">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
</div>
</div>
@endsection
