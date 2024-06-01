@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Category') }}</div>

                <div class="card-body">
                    <form action="/category/{{$category['id']}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">Category Name:</label>
                            <input type="text" id="name" name="name" class="form-control" value = "{{$category['name']}}" required autofocus placeholder="Enter category">
                        </div>
                        <div class="form-group">     
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control" rows="3"    placeholder="Enter description">{{$category['description']}}</textarea>
                        </div>
                        <div class="form-grop">
                            <label>Uploaded Image</label>
                                <div class="form-control">
                        <img src="{{asset('image/'.$category['image'])}}" style="width:70px ; height:70px" alt="Img">

                                </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Category Image:</label>
                            <input type="file" accept="image/*" id="image" name="image">
        
                        </div>
                        
                        
                        <button type="submit" class="btn btn-success btn-block mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
