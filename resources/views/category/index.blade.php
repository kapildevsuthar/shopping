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
                    <th>Image</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
                <tbody>
                    @foreach ($data as $info)
                    @php 
                 $files=[];
                if(is_array($info)){
                 foreach($info as $sinfo){
                     $files[]=$sinfo['file_path'];
                 }
                }
                // print_r($files);
                @endphp

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$info['name']}}</td>

                            @if($info['image'])
                    <td>
                        <img src="{{asset('image/'.$info['image'])}}" style="width:70px ; height:70px" alt="Img">
                    </td>

                    @else
                    <td>
                        <img src="{{asset('image/imgnotavl.png')}}" style="width:70px ; height:70px" alt="Img">
                        
                    </td>
                    @endif

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