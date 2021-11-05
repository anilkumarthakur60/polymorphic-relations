@extends('layouts.app')
@section('content')

    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success">Add Category</a>

    <form action="{{ route('categories.store') }}" id="imageform" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="profile-container">
            <img id="profileImage" class="rounded-pill" height="100" width="100" src="http://lorempixel.com/100/100"
                alt="">
        </div>
        <input id="imageUpload" type="file" hidden name="image" placeholder="Photo" required="" capture>
        <input type="text" class=" form-control-sm" name="name">
        <button type="submit" class=" btn btn-sm btn-primary"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
    </form>
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
                        <img src="{{ asset('/' . $category->image->imagefile) }}" class="rounded-pill img-fluid"
                            height="100" width="100" alt="">
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
    <!-- Example of a form that Dropzone can take over -->
    <form action="/target" class="dropzone"></form>
@endsection


@section('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection


@section('script')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        $("#profileImage").click(function(e) {
            $("#imageUpload").click();
        });

        function fasterPreview(uploader) {
            if (uploader.files && uploader.files[0]) {
                $('#profileImage').attr('src',
                    window.URL.createObjectURL(uploader.files[0]));


            }
        }

        $("#imageUpload").change(function() {
            fasterPreview(this);
            $(document).ready(function() {
                $("imageform").submit();
            });
        });
        // If you are using JavaScript/ECMAScript modules:
        import Dropzone from "dropzone";

        // If you are using CommonJS modules:
        const {
            Dropzone
        } = require("dropzone");

        // If you are using an older version than Dropzone 6.0.0,
        // then you need to disabled the autoDiscover behaviour here:
        Dropzone.autoDiscover = false;

        let myDropzone = new Dropzone("#my-form");
        myDropzone.on("addedfile", file => {
            console.log(`File added: ${file.name}`);
        });
    </script>
@endsection
