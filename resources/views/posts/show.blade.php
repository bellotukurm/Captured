@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if($post->image == "")
        <div class="col-10">
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="font-weight-bold pr-3" style="font-size:30px;">
                        <a href="/profile/{{$post->user->id}}" style="text-decoration:none;">
                            <span class="text-dark">{{$post->user->ustext}}
                        </a>
                    </div>
                    <hr>
                    @can('update',$post)
                    <form action="/post/{{$post->id}}/edit">
                        <button type="submit" class="btn btn-primary" style="background-color:black; border-color:grey; margin-right:15px">Edit</button>
                    </form>
                    <form method="POST" action="/post/{{$post->id}}">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-primary " style="background-color:red; border-color:grey;">Delete</button>
                    </form>  
                    @endcan        
                    
                </div>
                <hr>
                <div style="font-size:22px;">{{$post->caption}}</div>
            </div>
        </div>
        @else
        <div class="col-7">
            <img src="/storage/{{$post->image}}" class="w-100">
        </div>
        <div class="col-5 ">
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="font-weight-bold pr-3" style="font-size:30px;">
                        <a href="/profile/{{$post->user->id}}" style="text-decoration:none;">
                            <span class="text-dark">{{$post->user->username}}
                        </a>
                    </div>
                    <hr>
                    @can('update',$post)
                    <form action="/post/{{$post->id}}/edit">
                        <button type="submit" class="btn btn-primary" style="background-color:black; border-color:grey; margin-right:15px">Edit</button>
                    </form>
                    <form method="POST" action="/post/{{$post->id}}">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-primary " style="background-color:red; border-color:grey;">Delete</button>
                    </form>  
                    @endcan
                </div>
                <hr>
                <div style="font-size:22px;">{{$post->caption}}</div>
            </div>
        @endif
        </div>


    </div>

    <div class="container">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/app.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <h4 class="pt-5 pb-3" style="border-bottom: 2px solid #333">COMMENTS</h4>
    <div id="root">
        <div class="d-flex justify-content-between align-items-center">
            <div class="form-group row w-100 pl-4 pt-3 pr-4 " >
                <input id="input" 
                type="text"
                class="form-control @error('title') is-invalid @enderror " 
                name="title"
                autocomplete="title"
                v-model="newCommentText"   
                autofocus>
            </div>
            <button @click="createComment" class="btn btn-primary h-75 " style="background-color:black; border-color:grey">COMMENT</button>
        </div>

        {{-- @if($post->image == "")
        {{$post->comments->pluck('user_id');}} 
        @foreach($comment as @{{comments}})
            $comment
        @endforeach--}}

        <ul style="list-style:none; display:flex; flex-direction:column-reverse; ">
            <li v-for="comment in comments" style="border:2px solid #333; padding:20px; margin:10px; margin-right:20px;">
                <div class="">
                    <strong>@{{comment.username}}</strong>: 
                    @{{comment.text}} 
                </div>
            </li>              
        </ul>

    </div>

    <script>
        var app = new Vue({
            el: "#root",
            data: {
                comments: [],
                newCommentText: '',
            }, 

            props: ['post'],

            mounted() {
                axios.get('/api/comments/'+"{{$post->id}}")
                .then(response => {
                    this.comments = response.data;
                })
                .catch(response =>{
                    console.log(response);
                })
            },

            methods: { 
                createComment: function() {
                    axios.post('/api/comments/'+"{{$post->id}}"+'/'+"{{Auth::user()->id}}",{
                        text: this.newCommentText
                    })
                    .then(response => {
                        this.comments.push(response.data);
                        this.newCommentText = '';
                    })
                    .catch(response =>{
                        console.log(response);
                    })
                },
            },

        });    
    </script>

</div>
@endsection
