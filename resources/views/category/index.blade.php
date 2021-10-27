@extends('layouts.app')
@section('content')
    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success">Add Category</a>
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td scope="row">{{ $category->id }}</td>
                    <td>
                        <img src="{{ asset('/' . $category->image) }}" height="100" width="100" alt="">
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-info">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm"> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
@endsection
