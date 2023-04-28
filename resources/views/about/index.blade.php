@extends('layout.admin')

@section('title', 'Admin Dashboard')

@section('page', 'Data Master > Tentang')

@section('content')
    <div class="col-lg-12 col-12 layout-spacing">
        <h3 calss="mb-2">Tentang</h3>
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-4 mt-3">
                                <label for="exampleFormControlFile1">Upload Gambar</label>
                                <img src="{{ asset('storage/' . $about->image) }}" width="100%" class="mb-3" id="preview">
                                <input type="file" class="form-control-file" onchange="loadFile(event, 0)"
                                    id="exampleFormControlFile1" name="image">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="exampleFormControlTextarea1">Isi</label>
                                <textarea class="summernote form-control" id="summernote" rows="3" name="text"
                                    required="">{{ $about->text }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/about.js') }}"></script>
    <script type="text/javascript">
        var loadFile = function(event, no) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        $(document).ready(function() {
            $('.summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                callbacks: {
                    onImageUpload: function(image) {
                        attach(image[0]);
                    },
                    onMediaDelete: function(target) {
                        attachDestroy(target[0].src);
                    }
                }
            });

            function attach(image) {
                var data = new FormData();
                data.append("image", image);
                data.append("_token", "{{ csrf_token() }}");
                $.ajax({
                    url: '{{ route('about.attach.store') }}',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: "POST",
                    success: function(url) {
                        $('#summernote').summernote("insertImage", url);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            function attachDestroy(src) {
                $.ajax({
                    data: {
                        src: src,
                        _token: "{{ csrf_token() }}"
                    },
                    type: "POST",
                    url: '{{ route('about.attach.destroy') }}',
                    cache: false,
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });
    </script>
@endsection
