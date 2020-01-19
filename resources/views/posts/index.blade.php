@extends('layouts.app')

<!-- Styles -->
<style>
    .title {
        font-size: 84px;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
    .content {
        text-align: center;
    }
</style>
@section('content')
<div class="container ">
    <a  href="/" class="content pt-5" style="text-decoration:none;">
        <div class><img src="/svg/shutter.svg" style="height: 100px;" class="pr-2" ></div>
        <div class="title m-b-md pt-3 align" style="color:black">
            CAPTURED
        </div>
    </a>

    <div class="pt-3 pb-3 col-12 " style="border: 2px solid #333; text-align:center; background-color:#ddd">
        <h4 > SUBSCRIPTIONS</h4>
    </div>
    <div class="row pt-2 pb-4" class="pt-5">
    @foreach($posts as $post)
        @if($post->image == "")
            <div class="pl-4 col-12 pt-4 pb-2" style="color:#333; text-decoration:none; border-bottom: 1px solid #333">
                <a href="/profile/{{$post->user->id}}" style="text-decoration:none;">
                    <span class="text-dark"><strong>{{$post->user->username}}</strong>
                </a>
                <a style="color:#333; text-decoration:none;" href="/post/{{$post->id}}" >
                    <p>{{$post->caption}}</p>
                </a> 
            </div>
        @else
            <a href="/post/{{$post->id}}" class="p-1 col-4 pl-4 pt-4 pb-2 " style="color:#333; text-decoration:none; border-bottom: 1px solid #333">                    
                <span class="text-dark"><strong>{{$post->user->username}}</strong>
                <img align="right" src="/storage/{{$post->image}}" class="w-100 pt-1 pb-5" >
            </a> 
            <a href="/post/{{$post->id}}" class="pl-4 col-8 pt-5 pb-2" style="color:#333; text-decoration:none; text-align:flex-start; border-bottom: 1px solid #333">
                <p>{{$post->caption}}</p>
            </a> 
        @endif  
    @endforeach
    </div>

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection