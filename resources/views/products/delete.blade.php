<!-- resources/views/delete.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Delete Product</h1>
        <p>Are you sure you want to delete the post titled "<strong>{{ $post->title }}</strong>"?</p>
        
        <form action="{{ route('product.destroy', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
