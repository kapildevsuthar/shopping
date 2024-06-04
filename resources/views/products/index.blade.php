@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::get('success'))
    <div class="alert alert-success text-center">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="mb-3">
        <a href="{{route('products.create')}}" class="btn btn-primary mb-3" > Add Product </a>
        
          <table class="table table-striped border">
            <thead class="table-primary">
                <tr>
                    <th>S.no.</th>                    
                    <th>Product Name</th>
                    {{-- <th>Image</th> --}}
                    <th>Description</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>CGST</th>
                    <th>SGST</th>
                    <th>NetPrice</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $info)
             
                {{-- @php 
                 $files=[];
                if(is_array($info)){
                 foreach($info as $sinfo){
                     $files[]=$sinfo['file_path'];
                 }
                }
                // print_r($files);
                @endphp --}}

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $info['name'] }}</td>

                    {{-- @if(isset($info->media[0]->file_path))
                    <td>
                        
                        @for($a=0 ;$a<count($info->media);$a++)
                        <img src="{{asset('image/'.$info->media[$a]['file_path'])}}" style="width:70px ; height:70px" alt="Img">
                        @endfor

                    </td>   

                    @else
                    <td>
                        <img src="{{asset('image/imgnotavl.png')}}" style="width:70px ; height:70px" alt="Img">
                        
                    </td>
                    @endif --}}

                    <td>{{ $info['description'] }}</td>
                    <td>{{ $info['price'] }}</td>
                    <td>{{ $info['discount'] }}</td>
                    <td>{{ $info['cgst'] }}</td>
                    <td>{{ $info['sgst'] }}</td>
                    <td>{{ $info['net_price'] }}</td>
                    <td><a href="/products/{{ $info["id"] }}/edit">Edit</a></td>

                    <td> <form action="/products/{{$info["id"]}}" method="post" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button id="deleteButton" class="btn btn-danger ">Delete</button>   
                    </form>
                   </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
