@extends('layouts.app')
@section('title', 'USER')

@push('my-styles')
    <style>
        .container {
            max-width: 960px;
            margin: 30px auto;
            padding: 20px;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin: 20px 0 20px;
        }

        h1 small {
            display: block;
            font-size: 15px;
            padding-top: 8px;
            color: gray;
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input+label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 5px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview>div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container2 .btn {
            position: absolute;
            top: 90%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);

            color: white;
            font-size: 16px;

            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }

        #image {
            display: block;
            /* This rule is very important, please don't ignore this */
            max-width: 100%;
        }

    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 mt-3 mb-3">
        @component('components.alert') @endcomponent
        {{-- <img src="{{ asset('uploads/pictures/user-') }}{{ $user->id }}/avatar/{{ $user->avatar }}" id="user_pic"> --}}
        {{-- <img src="{{ session()->get('pic') }}" id="user_pic"> --}}
        <form enctype="multipart/form-data" action="{{ route('imageupload') }}" method="POST" class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="imageUpload"
                    class=" imageUpload" />
                <input type="hidden" name="base64image" name="base64image" id="base64image">
                <label for="imageUpload"></label>
            </div>
            <div class="avatar-preview container2">
                <div id="imagePreview" style="background-image:url({{ Auth::user()->get_avatar() }});">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input style="margin-top: 60px;" type="submit" class="btn btn-danger">
                </div>
            </div>
        </form>
        
        <div class="modal fade bd-example-modal-lg imagecrop" id="model" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-11">
                                    <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary crop" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>E-mail:</strong> {{ $user->email }}</p>
        <p>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Pets</th>
                    <th scope="col">Bio</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user->pets as $pet)
                    <tr>
                        <td><a href="{{ route('pet.show', ['pet' => $pet->id]) }}">{{ $pet->name }}</a></td>
                        {{-- <td>{{ $pet->name }}</td> --}}
                        <td>{{ $pet->bio }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>Nenhum pet cadastrado. <a style="text-decoration:none;color:rgb(255, 174, 0)"
                                href="{{ route('pet.create') }}"><strong>Doe um pet</strong></a> agora mesmo! :)</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </p>
    </div>
    <div class="col-md-1"></div>
</div>
@endsection
@push('my-scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script>
        var $modal = $('.imagecrop');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".imageUpload", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $("body").on("click", "#crop", function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#base64image').val(base64data);
                    document.getElementById('imagePreview').style.backgroundImage = "url(" +
                        base64data + ")";
                    $modal.modal('hide');
                }
            });
        })
    </script>
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $("div.alert").remove();
            }, 2500);
        });
    </script>
@endpush