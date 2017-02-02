@extends('layouts.app')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippet" ng-controller="chatCtrl">
    <div class="row">
        <div class="col-md-4 bg-white ">
            <div class=" row border-bottom padding-sm" style="height: 40px;">
                Member
                <input type="hidden" class="currentuser" id="{{Auth::User()->id}}">
            </div>

            <!-- =============================================================== -->
            <!-- member list -->
            <ul class="friend-list">

    @if(!empty($users))
    @foreach($users as $key=>$value)
                <li class="getmessage">
                    <a href="#" class="clearfix">
                        <div class="friend-name">
                            <strong>{{$value->name}}</strong>
                        </div>
                        <div class="last-message text-muted"><button type="button" class="btn btn-link" id="{{$value->id}}" user-name={{$value->name}}  ng-click="getmessages($event)">Send message</button></div>
                        <small class="time text-muted"></small>
                        <small class="chat-alert text-muted"><i class="fa fa-check"></i></small>
                    </a>
                </li>
    @endforeach
    @endif
            </ul>
        </div>

        <!--=========================================================-->
        <!-- selected chat -->
        <div class="col-md-8 bg-white " style="overflow: scroll; height: 500px; overflow-x: hidden;">
            <div class="chat-message" >
                <ul class="chat">

                </ul>
            </div>
            <div class="chat-box bg-white">
                <div class="input-group">
                    <span class="btn btn-default btn-file gnfile">
                        <file enctype="multipart/form-data">
                        <img src="/images/add.png" title="image"><input class="form-control myfileinput" type="file" ng-model="file" onchange="angular.element(this).scope().imageinchat(event)" title="add new image" disabled/>
                        </file>
                    </span>
                    <input class="form-control border no-shadow no-rounded" placeholder="Type your message here" ng-model="content">
                    <span class="input-group-btn">
            			<button class="btn btn-success no-rounded sendbtn" style="margin-top: 34px;" type="button" currentuserid="{{Auth::User()->id}}" currentusername="{{Auth::User()->name}}" disabled ng-click="sendmessage($event)">Send</button>
            		</span>
                </div><!-- /input-group -->
            </div>
        </div>
    </div>
</div>
    @endsection