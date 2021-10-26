@extends('layouts.app')
@section('content')
    <a href="{{ route('videos.create') }}" class="btn btn-sm btn-success">Add Video</a>
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Link</th>
                <th>Video Images</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $video)
                <tr>
                    <td>{{ $video->id }}</td>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->url }}</td>
                    <td>
                        @foreach ($video->images as $image)
                            <img src="{{ asset('/storage/' . $image->imagefile) }}" height="200" width="200" alt="">
                        @endforeach
                    </td>
                </tr>
            @endforeach
            <tr>
                <td scope="row"></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>
@endsection
