@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::get('success'))
    <div class="alert alert-success text-center">
        {{Session::get('success')}}
        
    </div>
@endif
    <div class="mb-3">
        <a href="{{route('category.create')}}" class="btn btn-primary mb-3" > Add category </a>
        <table class="table table-striped border">
            <thead class = "table-primary">
                <tr>
                    <th>S.no.</th>
                    <th>Name</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
                <tbody>
                    @foreach ($data as $info)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$info['name']}}</td>
                            <td><a href="/category/{{$info["id"]}}/edit">Edit</a>
                                
                            </td>
                            <td>
                                <form action="/category/{{$info["id"]}}" method="post" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button id="deleteButton" class="btn btn-danger ">Delete</button>   
                                </form>
                                </td>
                            {{-- <td><input type="checkbox" name="product_ids[]" value="{{ $info['id'] }}"></td> --}}
                        </tr>   
                        @endforeach
                </tbody>
            </thead>
        </table>
    
        
    </div>
</div>
@endsection