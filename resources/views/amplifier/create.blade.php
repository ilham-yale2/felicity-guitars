@extends('layout.admin')
{{-- @dd($types) --}}
@section('title', 'Admin Amplifier')

@section('page', 'Data Master > Amplifiers > Create')

@section('content')
<style>
    .mt-input{
        margin-top: 31px;
    }
</style>
    <div class="col-lg-12 col-12 layout-spacing">
        <h3 calss="mb-2">Create Amplifier</h3>
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('amplifier.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Product Name (Single Item)</label>
                                <input type="text" class="form-control " id="name" name="name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Product Name (Multi Item)</label>
                                <input type="text" class="form-control " id="name" name="name_2" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control  select2" >
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="price">Price (IDR)</label>
                                <input type="tel" class="form-control money text-right" id="price" name="price"
                                    placeholder=""  onkeyup="getSellPrice()" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="meta_text">Meta Text</label>
                                <input type="text" class="form-control" name="meta_text" required id="meta_text">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="alt_text">Alt Text</label>
                                <input type="text" class="form-control" name="alt_text" required id="alt_text">
                            </div>
                        </div>
                        
                       
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="thumbnail">Thumbnail (Single View)</label>
                                <input required type="file" name="thumbnail_2" class="form-control-file" id="thumbnail-2" >
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="form-group mb-4">
                                <label for="thumbnail">Thumbnail (Multi View)</label>
                                <input required type="file" name="thumbnail" class="form-control-file" id="thumbnail" >
                            </div>
                        </div>
                       
                        <div class="col-md-6 text-center">
                            <img class="w-100"src="" id="preview-photo2" alt="">
                        </div>
                        <div class="col-md-6 text-center preview">
                            <img class="w-100" src="" id="preview-photo" alt="">
                        </div>
                        <div class="col-md-12">
                            <div class="input-field">
                                <label class="active">Photos</label>
                                <p class="w-100 text-italic text-danger">*For better experience, maximum upload 10 files.</p>
                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3"> 
                            <div class="form-group mb-4">
                                <label for="exampleFormControlTextarea1">Text</label>
                                <textarea class="form-control summernote-color" rows="3" name="text"
                                 id="text"></textarea>
                            </div>
                        </div>
                        <h4 class="col-12 mt-5 mb-2 text-center">Description Product</h4>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="description">Description</label>
                                <textarea class="form-control summernote" rows="3" name="description"
                                 id="description"></textarea>
                            </div>
                        </div>
                        

                        <h4 class="mt-5 text-center w-100">Filter Needs</h4>
                        <p class="col-12"><i class="text-danger w-100 ">*The column below is for filter needs only</i></p>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control   select2" required>
                                    <option selected disabled>Select Type</option>
                                    <option value="1">Solid Body</option>
                                    <option value="2">Semi-hollowbody</option>
                                    <option value="3">Offset</option>
                                    <option value="4">Hollowbody</option>
                                    <option value="5">Acoustic</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country of Origin</label>
                                <select name="country" id="country" class="form-control   select2" required>
                                    <option selected disabled>Select Country</option>
                                    <option value="1">Custom</option>
                                    <option value="2">Memphis</option>
                                    <option value="3">Montana</option>
                                    <option value="4">U.S.A</option>
                                    <option value="5">Mexico</option>
                                    <option value="6">China</option>
                                    <option value="7">Custom Historic</option>
                                    <option value="8">Japan</option>
                                    <option value="9">Korea</option>
                                    <option value="10">Indonesia</option>
                                   <option value="11"> Asi</option>
                                   <option value="12"> U.K.</option>
                                   <option value="13"> Denmark</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <select name="condition" id="condition" class="form-control  select2" required>
                                    <option selected disabled>Select Condition</option>
                                    <option value="1">New</option>
                                    <option value="2">Used</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="year"> Year </label>
                                <input name="year" id="year" class=" year form-control" />   
                            </div>
                        </div>
                        {{-- PRODUCT SPECIFICATION --}}
                        <h4 class="col-12 mt-5 mb-2 text-center">Specification Product</h4>
                        <div class="col-12 mt-4 d-flex align-items-end mb-4">
                            <h5 class="mb-0">General</h5>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="general-title">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group mb-4">
                                        <label for="value">Value</label>
                                        <input type="text" class="form-control " id="general-value">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary ml-3 py-1 px-2" type="button" onclick="addColumn('general')">
                                        <span class="iconify" data-icon="fluent:add-12-filled"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row" id="general">

                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <textarea name="general" class="form-control summernote"  id=""rows="10"></textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Body</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="body" class="form-control summernote"  id=""rows="10"></textarea>

                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Neck</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="neck" class="form-control summernote"  id=""rows="10"></textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Hardware</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="hardware" class="form-control summernote"  id=""rows="10"></textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Electronic</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="electronic" class="form-control summernote"  id=""rows="10"></textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Miscellaneous</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="miscellaneous" class="form-control summernote"  id=""rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-danger mt-3" href="{{ route('product.index') }}"><i
                                    class="flaticon-cancel-12"></i> Back</a>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection



@section('script')
    @if (\Session::has('images'))
    <script>
        
        setTimeout(() => {
            Swal.fire({
                icon: 'error',
                title: 'Oops ...!',
                text: "{!! \Session::get('images') !!}",
            })
        }, 1000);
    </script>    
    @endif
    <script src="{{ asset('js/amplifier.js') }}"></script>
    <script type="text/javascript">
       
        $('.input-images-1').imageUploader();
        $("div#Image").dropzone({
            url: "null"
        });
        $(".yearpicker").datetimepicker({
            format: "YYYY",
        });
        
        var loadFile = function(event, no) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    
    </script>
@endsection
