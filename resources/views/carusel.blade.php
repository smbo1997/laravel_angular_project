@extends('layouts.app')
@section('content')
<div style="margin-left: 20px">
    <a class="btn btn-success" href="#mycarusel">My Carusel</a>
    <a class="btn btn-success" href="#bootstrapcarusel">Bootstrap Carusel</a>
</div>


    <div ng-view="">

    </div>

@endsection