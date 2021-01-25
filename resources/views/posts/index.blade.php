@extends('app.layout')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div class="row">
        <div class="col-md-6">
            <h1>CRUD Laravel 6</h1>
        </div>

        {{-- Поиск данных --}}
        <div class="col-md-4">
            <form action="/search" method="get">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                </div>
            </form>
        </div>

        <div class="col-md-2 text-right">
            <a href="{{ action('PostController@create') }}" class="btn btn-primary">Add Post</a>
        </div>
    </div>

    <form method="post">
        @csrf
        @method('DELETE')
        <button formaction="/deleteall" type="submit" class="btn btn-danger">Delete All Selected</button>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><input type="checkbox" class="selectall"></th>
                <th>Name</th>
                <th>Detail</th>
                <th>Author</th>
                <th width="230">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $post->id }}"></td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->detail }}</td>
                    <td>{{ $post->author }}</td>
                    <td>
                        <a href="{{ action('PostController@show', $post->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ action('PostController@edit', $post->id) }}" class="btn btn-warning">Edit</a>
                        <button formaction="{{ action('PostController@destroy', $post->id) }}" type="submit" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
    {{-- Пагинация   --}}
    {{ $posts->links() }}

    <script>
        $('.selectall').click(function () {
            $('.selectbox').prop('checked', $(this).prop('checked'));
        })
        $('.selectbox').change(function () {
            var total = $('.selectbox').length;
            var number = $('selectbox:checked').length;
            if (total == number) {
                $('.selectall').prop('checked', true);
            }else {
                $('.selectall').prop('checked', false);
            }
        })
    </script>
@endsection
