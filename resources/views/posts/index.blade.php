@extends('layouts.app')
@section('content')
    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success">Add Post</a>
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Id</th>
                <th>title</th>
                <th>Body</th>
                <td>Photos</td>
            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>
                        @foreach ($post->images as $image)
                            <img src="{{ '/storage/' . $image->imagefile }}" height="200" width="200" alt="">
                            {{-- <img src="{{ $image->getFirstMediaUrl('fileimage', 'thumb') }}" width="120px"> --}}
                        @endforeach

                    </td>
                    {{-- <td><img src="{{ $post->getFirstMediaUrl('fileimage', 'thumb') }}" / width="120px"></td> --}}
                    {{-- <td>
                        @foreach ($post->getMedia('fileimage') as $image)

                            {{ $image->getMedia('fileimage')->getUrl('thumb') }} @endforeach
                    </td> --}}
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
