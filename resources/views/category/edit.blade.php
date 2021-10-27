@extends('layouts.app')
@section('content')
    <a href="{{ route('categories.create') }}" class=" btn btn-sm btn-info">Add Category</a>
    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="file" name="image" value="{{ $category->image }}" class="form-control form-control-file" id="">
        <button type="submit" class=" btn btn-sm btn-danger">Update</button>
    </form>
@endsection
