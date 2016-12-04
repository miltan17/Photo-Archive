@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-8" >
                <img src="/img/{!! $photo->imageName !!}" style="height: 100%; width: 100%;">
        </div>
        <div class="col-md-4">
            <a href="/user/{!! $photo->user->id !!}">
                <h2 class="glyphicon glyphicon-user">&nbsp;{!! $photo->user->name !!}</h2><br/>
            </a>
            <text class="glyphicon glyphicon-time">&nbsp; {!! $photo->created_at !!}</text><br/>
            <text class="glyphicon glyphicon-arrow-right">&nbsp;{!! $photo->title !!}</text>
        </div>
    </div>
</div>
@endsection
