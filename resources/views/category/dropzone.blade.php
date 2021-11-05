@extends('layouts.app')

@section('content')




    <style>
        .dropzone {

            margin-left: auto;
            margin-right: auto;
            background: #e3e6ff;
            border: 1px dotted #4e4e4e;
            height: 100px;
            width: 150px;
            border-radius: 100%
        }

    </style>
    </head>

    <body>
        <div id="dropzone">
            <form action="{{ route('categories.dropzonestore') }}" method="POST" class="dropzone " id="uploadFile"
                enctype="multipart/form-data">
                @csrf
                <div class="dz-message ">
                    <i class="fa fa-camera fa-3x text-danger" aria-hidden="true"></i>
                </div>
                <input type="text" value="2" hidden name="user_id">
            </form>
        </div>
    </body>

    </html>
@endsection
@section('css')

@endsection


@section('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>

    <script>
        var dropzone = new Dropzone('#uploadFile', {
            previewTemplate: document.querySelector('#preview-template').innerHTML,
            parallelUploads: 5,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 6,
            filesizeBase: 1500,
            uploadMultiple: true,

            thumbnail: function(file, dataUrl) {
                if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                    for (var i = 0; i < images.length; i++) {
                        var thumbnailElement = images[i];
                        thumbnailElement.alt = file.name;
                        thumbnailElement.src = dataUrl;
                    }
                    setTimeout(function() {
                        file.previewElement.classList.add("dz-image-preview");
                    }, 1);
                }
            }
        });

        var minSteps = 6,
            maxSteps = 60,
            timeBetweenSteps = 100,
            bytesPerStep = 100000;

        dropzone.uploadFiles = function(files) {
            var self = this;

            for (var i = 0; i < files.length; i++) {

                var file = files[i];
                totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

                for (var step = 0; step < totalSteps; step++) {
                    var duration = timeBetweenSteps * (step + 1);
                    setTimeout(function(file, totalSteps, step) {
                        return function() {
                            file.upload = {
                                progress: 100 * (step + 1) / totalSteps,
                                total: file.size,
                                bytesSent: (step + 1) * file.size / totalSteps
                            };

                            self.emit('uploadprogress', file, file.upload.progress, file.upload
                                .bytesSent);
                            if (file.upload.progress == 100) {
                                file.status = Dropzone.SUCCESS;
                                self.emit("success", file, 'success', null);
                                self.emit("complete", file);
                                self.processQueue();
                            }
                        };
                    }(file, totalSteps, step), duration);
                }
            }
        }
    </script>

@endsection
