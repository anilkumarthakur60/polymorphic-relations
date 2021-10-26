@extends('layouts.app')
@section('content')
    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group my-3">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp">
        </div>
        <div class="form-group my-3">
            <label for="exampleInputPassword1">Video Url</label>
            <input type="text" name="url" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="form-group my-3">
            <label for="exampleInputPassword1">Images</label>
            <input type="file" name="fileimage[]" multiple class="form-control form-control-file" id="exampleInputPassword1">
        </div>


        {{-- <div class="input-group control-group increment">
            <input type="file" name="filename[]" class="form-control">
            <div class="input-group-btn">
                <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
            </div>
        </div>
        <div class="clone hide">
            <div class="control-group input-group" style="margin-top:10px">
                <input type="file" name="filename[]" class="form-control">
                <div class="input-group-btn">
                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                </div>
            </div>
        </div> --}}

        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $(".btn-success").click(function() {
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".control-group").remove();
            });

        });
    </script>
@endsection
