@extends('layouts.master')
@section('css')
@section('title')
Invoice Invoice
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
            <h4 class="content-title mb-0 my-auto">Invoice /</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Invoice</span>
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
                <h4 class="card-title mb-1"> Invoice</h4>
                <p class="mb-2">Show Invoice {{$invoice->invoice_number}}.</p>
            </div>
            <div class="card-body pt-0">

                <div class="row row-sm">

                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">invoice number</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->invoice_number}} </p>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">invoice id</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->id}} </p>
                        </div><!-- input-group -->
                    </div>

                </div>
                <div class="row row-sm">

                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">product</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->product}} </p>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Section</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->section->section_name}} </p>
                        </div><!-- input-group -->
                    </div>

                </div>
                <div class="row row-sm">

                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">status</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">
                                @if ($invoice->status->id == 1)
                                <span class="text-danger">{{ $invoice->status->status }}</span>
                                @elseif($invoice->status->id == 2)
                                <span class="text-success">{{ $invoice->status->status }}</span>
                                @else
                                    <span class="text-warning">{{ $invoice->status->status }}</span>
                                @endif
                        </p>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">due_date</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->due_date}} </p>
                        </div><!-- input-group -->
                    </div>

                </div>
                <div class="row row-sm">

                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">rate_vat</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->rate_vat}} </p>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">invoice_date</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->invoice_date}} </p>
                        </div><!-- input-group -->
                    </div>

                </div>
                <div class="row row-sm">

                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">value_vat</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->value_vat}} </p>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">discount</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->discount}} </p>
                        </div><!-- input-group -->
                    </div>

                </div>
                <div class="row row-sm">

                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">total</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->total}} </p>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">user</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->user}} </p>
                        </div><!-- input-group -->
                    </div>

                </div>
                <div class="row row-sm">

                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">amount_collection</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->amount_collection}} </p>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">amount_commission</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->amount_commission}} </p>
                        </div><!-- input-group -->
                    </div>

                </div>
                <div class="row row-sm">

                    <div class="col-lg-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">note</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">{{$invoice->note}} </p>
                        </div><!-- input-group -->
                    </div>

                </div>
                <div class="row row-sm">

                    <div class="col-lg-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">file</span>
                            </div><p aria-describedby="basic-addon1" aria-label="Username" class="form-control"  type="text">@if (!empty($invoice->file)) <a href="{{Storage::url($invoice->file)}}">{{$invoice->file}}</a>   @else Empty file @endif </p>

                        </div><!-- input-group -->
                        @if (!empty($invoice->file))
                        <img src="{{Storage::url($invoice->file)}}" style="width: 400px"><br><br>

                        @endif
                    </div>

                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="input-group ">
                            @can('invoice edit')
                            <p><a class="btn btn-primary-gradient btn-block " href="{{ route('invoices.edit', $invoice->id) }}">Edit</a></p>
                            @endcan
                            @can('delete invoice')
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="post" >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger-gradient btn-block" type="submit">Delete</button>
                                </form>
                                @endcan
                        </div><!-- input-group -->
                    </div>
                </div>

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
