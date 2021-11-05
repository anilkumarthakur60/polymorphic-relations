@extends('layouts.app')
@section('content')
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" class="form-control" id="">
        <input type="file" class="form-control-file" name="image">

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
