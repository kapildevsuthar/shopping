@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::get('success'))
    <div class="alert alert-success text-center">
        {{Session::get('success')}}
        
    </div>
@endif
    <div class="mb-3">
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
                            <td><input type="checkbox" name="product_ids[]" value="{{ $info['id'] }}"></td>
                        </tr>   
                        @endforeach
                        <button type="button" id="deleteButton" class="btn btn-danger float-end">Delete</button>   
                </tbody>
            </thead>
        </table>
    </div>
</div>
<script>
document.getElementById('deleteButton').onclick = function () {
    var checkboxes = document.querySelectorAll('input[name="product_ids[]"]:checked');
    if (checkboxes.length > 0) {
        var confirmationMessage = checkboxes.length === 1 ?
            'Are you sure you want to delete the selected product?' :
            'Are you sure you want to delete the selected products?';
            

        var confirmation = confirm(confirmationMessage);
        if (confirmation) {
            document.getElementById('deleteForm').submit();
        }
    } else {
        alert('Please select at least one product to delete.');
    }
};
</script>
@endsection