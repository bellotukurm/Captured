@extends('layouts.app')

@section('content')
<div class="container">
    <form action = "/post/{{$post->id}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
                <div class="col-8 offset-2">

                    <div class="row">
                        <h1>Edit Post<h1>
                    </div>

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label " style="font-size:25px">Edit text</label>
                        
                        <input id="caption" 
                                type="text"
                                class="form-control @error('caption') is-invalid @enderror" 
                                name="caption"
                                value="{{old('title')?? $post->caption}}"
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
                        <label for="caption" class=" col-form-label pb-3" style="font-size:25px">Change Image</label>
                        <div class="row"> 
                            <input type="file" class="" id="image" name="image">

                            @error('caption')
                                <strong>{{$errors->first('image') }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="row pt-5">
                        <button class="btn btn-primary" style="background-color:grey; border-color:grey">Apply Changes</button>
                    </div>

                </div>
            </div>
    </form>
    
</div>
@endsection