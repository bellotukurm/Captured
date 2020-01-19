<!-- Styles -->
<style>
.img {
  object-fit: cover;
  width:400px;
  height:400px;
}
</style>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10">
            <div>
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h2>{{ $user->username }}</h2>
                    <div id="app" >
                        <example-component user="{{$user->id}}" subs="{{$subs}}"></example-component>
                    </div>
                    <script type="text/javascript" src="/js/app.js"></script>
                </div>    
                @can('update', $user->profile)
                    <a href="/profile/{{$user->id}}/edit" style="color:#333;">Edit Profile</a>
                @endcan

                <div class="pr-5"><strong>{{$subscriptionCount}}</strong> subscriptions</div>
                <div class="pr-5"><strong>{{$subscribersCount}}</strong> subscribers</div>
                <div class="pr-5"><strong>{{$postCount}}</strong> posts</div>
            </div>
            <div class="font-weight-bold pt-3">
                {{ $user->profile->title }}
            </div>
            <div>
                {{ $user->profile->description }}
            </div>
        </div>
    </div>
   
    <div >
    <h4 class="pt-5 pb-3" style="border-bottom: 2px solid #333"> YOUR POSTS</h4>
        <div class="row" class="pt-5"> 
            @foreach($user->posts as $post) 
                @if($post->image == "")
                    <a href="/post/{{$post->id}}" class="pl-5 col-12 pt-4 pb-2" style="color:#333; text-decoration:none; border-bottom: 1px solid #333">
                        <p>{{$post->caption}}</p>
                    </a> 
                @else
                    <a href="/post/{{$post->id}}" class="col-5 pt-4 pb-1 " style=" color:#333; text-decoration:none; border-bottom: 1px solid #333">                    
                        <img align="right" src="/storage/{{$post->image}}" class="w-75 pt-1 pb-5 " >
                    </a> 
                    <a href="/post/{{$post->id}}" class="pl-4 col-7 pt-5 pb-1" style="color:#333; text-decoration:none; text-align:flex-start; border-bottom: 1px solid #333">
                        <p>{{$post->caption}}</p>
                    </a> 
                @endif       
            @endforeach
        </div> 
    </div>
    
</div>

@endsection