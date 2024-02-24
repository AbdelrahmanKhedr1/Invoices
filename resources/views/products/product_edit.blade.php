@extends('layouts.master')
@section('css')
@section('title')
    Edit Product
@endsection
<!-- Internal Select2 css -->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{ URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Porodyct /</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Edit</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <!-- row -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Edit Product</h4>
                <p class="mb-2">It is Very Easy to Edit Product.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('products.update', $product_id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Section</label>
                        <select class="form-control select2" name="section_id">
                            <option value="{{ $product_id->section->id }}" selected>
                                {{ $product_id->section->section_name }}
                            </option>
                            @foreach ($sections as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->section_name }}
                                </option>
                            @endforeach

                        </select>
                        @error('section_id')
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div><!-- col-4 -->
                    <div class="form-group">
                        <label>Product Name </label>
                        <input type="text" class="form-control" id="inputName" placeholder="product Name"
                            name="product_name" value="{{ $product_id->product_name }}">
                        @error('product_name')
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description </label>
                        <textarea class="form-control" placeholder="description" rows="4" name="desc">{{ $product_id->desc }}</textarea>
                        @error('desc')
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                            {{-- <button type="submit" onclick="not6()" class="btn btn-primary mg-t-5">Edit</button> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- row -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
@endsection
