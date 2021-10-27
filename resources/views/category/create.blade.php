@extends('layouts.app')
@section('content')
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="file" class="form-control form-control-file" id="exampleInputEmail1" name="image"
                aria-describedby="emailHelp">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
