@extends('layouts.app')
@section('content')

    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

    </style>
    <div class="formgroup" style="margin-left:200px" ng-controller="fileCtrl">
        <label class="col-md-4 control-label">Add Image</label>
        <span class="btn btn-default btn-file gnfile">
            <file enctype="multipart/form-data">
            <img src="/images/add.png" title="image"><input class="form-control" type="file" ng-model="file" onchange="angular.element(this).scope().Upload(event)" title="add new image"/>
            </file>
        </span>

    <div style="margin-top:25px;" ng-repeat="img in uploadimages">
        <img  ng-src="<%img.images%>"  width="200px" style="border-radius:10px">
    </div>
    </div>

@endsection