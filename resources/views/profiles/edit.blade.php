@extends('layouts.app')

@section('content')
<div class="container">
<form action = "/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')
    
        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Edit Profile<h1>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label " style="font-size:25px">Title</label>
                    
                    <input id="title" 
                            type="text"
                            class="form-control @error('title') is-invalid @enderror" 
                            name="title"
                            value="{{old('title') ?? $user->profile->title}}"
                            autocomplete="title"   
                            autofocus>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('title')}}</strong>
                        </span>
                    @enderror    
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label " style="font-size:25px">Description</label>
                    
                    <input id="description" 
                            type="text"
                            class="form-control @error('description') is-invalid @enderror" 
                            name="description"
                            value="{{old('description') ?? $user->profile->description}}"
                            style="height:75px"
                            autocomplete="description"   
                            autofocus>    
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('description')}}</strong>
                        </span>
                    @enderror                   
                </div>

                <div class="row pt-5">
                    <button class="btn btn-primary" style="background-color:grey; border-color:grey">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
    
</div>
@endsection