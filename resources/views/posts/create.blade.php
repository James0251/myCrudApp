@extends('app.layout')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @if ($message = Session::get('danger'))
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
                <form action="{{ action('PostController@store') }}" method="post">
                    @csrf
                    <div class="from-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="from-group">
                        <label for="detail">Detail</label>
                        <textarea class="form-control" type="text" name="detail"></textarea>
                    </div>
                    <div class="from-group">
                        <label for="author">Author</label>
                        <input class="form-control" type="text" name="author">
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
        </div>
    </div>

@endsection
