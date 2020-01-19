@extends('layouts.app')

@section('content')
<div class="container"> 
    <form action = "/post" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
                <div class="col-8 offset-2">

                    <div class="row">
                        <h1>Add New Post<h1>
                    </div>

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label " style="font-size:25px">Post text</label>
                        
                        <input id="caption" 
                                type="text"
                                class="form-control @error('caption') is-invalid @enderror" 
                                name="caption"
                                style="height:100px"
                                autocomplete="caption"   
                                autofocus>
        
                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('caption')}}</strong>
                            </span>
                        @enderror
                        
                    </div>

                    <div class="pt-4">
                        <label for="caption" class=" col-form-label pb-3" style="font-size:25px">Post Image</label>
                        <div class="row"> 
                            <input type="file" class="" id="image" name="image">

                            @error('caption')
                                <strong>{{$errors->first('image') }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="row pt-5">
                        <button class="btn btn-primary" style="background-color:grey; border-color:grey">Add New Post</button>
                    </div>

                </div>
            </div>
    </form>
</div>
@endsection