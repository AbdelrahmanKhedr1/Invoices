@extends('layouts.master')
@section('css')
@section('title')
    Create Invoices
@endsection
<!-- Internal Select2 css -->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{ URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">

<!--Internal  Font Awesome -->
<link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
<!--Internal  treeview -->
<link href="{{ URL::asset('assets/plugins/treeview/treeview.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoices /</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Create</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <!--div-->

    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Invoice
                </div>
                <p class="mg-b-20">It is Very Easy to Create a new Invoice.</p>
                @if (session()->has('Add'))
                    <script>
                        window.onload = function() {
                            notif({
                                msg: "The invoice has been added successfully",
                                type: "info"
                            })
                        }
                    </script>
                @endif

                <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Invoice number</label>
                            <input type="text" class="form-control" placeholder="Invoice number"
                                name="invoice_number" value="{{ old('invoice_number') }}">
                            @error('invoice_number')
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label>due_date</label>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                    </div>
                                </div>
                                <input class="form-control fc-datepicker" id="datetimepicker" type="text"
                                    value="{{ now() }}" name="due_date" value="{{ old('due_date') }}">
                                @error('due_date')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row row-sm  ">



                        <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                            <p class="mg-b-10">Section </p>
                            <select name="section_id" class="form-control select2" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">
                                <option label="Choose one">

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
                        </div>
                        <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                            <p class="mg-b-10">product</p>
                            <select name="product" class="form-control select2">
                                <option value="">
                                </option>



                            </select>
                        </div>

                        <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                            <p class="mg-b-10"> Status</p>
                            <select class="form-control select2"  name="status_id">
                                <option label="Choose one">
                                </option>
                                @foreach ($status as $value)
                                <option value="{{$value->id}}">
                                    {{$value->status}}
                                </option>

                                @endforeach


                            </select>
                            @error('status_id')
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>



                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Commission amount</label>
                            <input type="text" class="form-control" placeholder="Invoice number"
                                id="Amount_Commission" name="amount_commission" value="{{ old('amount_commission') }}">
                            @error('amount_commission')
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Collection amount</label>
                            <input type="text" class="form-control" placeholder="Invoice number"
                                name="amount_collection" value="{{ old('amount_collection') }}">
                            @error('amount_collection')
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">discount</label>
                            <input type="text" class="form-control" placeholder="Invoice number" id="Discount"
                                name="discount" value="{{ old('discount') }}">
                            @error('discount')
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="row row-sm">
                        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                            <p class="mg-b-10">Rate Vat</p>
                            <select class="form-control select2" id="Rate_VAT" name="rate_vat"
                                onchange="myFunction()">
                                <option label="Choose one">
                                </option>
                                <option value="5%">
                                    5%
                                </option>
                                <option value="10%">
                                    10%
                                </option>

                            </select>
                            @error('rate_vat')
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label>Value VAT</label>
                            <input class="form-control" placeholder="Value_VAT" readonly type="text"
                                id="Value_VAT" name="value_vat" value="{{ old('value_vat') }}">
                            @error('value_vat')
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label>Total</label>
                            <input class="form-control" placeholder="Total" readonly type="text" id="Total"
                                name="total" value="{{ old('total') }}">
                            @error('total')
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <textarea class="form-control" placeholder="Textarea" rows="3" name="note"></textarea>
                        </div>
                    </div>
                    <br>
                    @can('add file')
                    <div class="row row-sm">
                        <div class="col-sm-12 ">
                            <input type="file" class="dropify" data-height="200" name="file">
                        </div>
                    </div>
                    @endcan
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--/div-->
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

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!-- Internal TelephoneInput js-->
<script src="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js') }}"></script>


<!-- Internal Treeview js -->
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>


<script>
    $(document).ready(function() {
        $('select[name="section_id"]').on('change', function() {
            var SectionId = $(this).val();
            if (SectionId) {
                $.ajax({
                    url: "{{ URL::to('sectionxx') }}/" + SectionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="product"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="product"]').append('<option value="' +
                                value + '">' + value + '</option>');
                        });
                    },
                });

            } else {
                console.log('AJAX load did not work');
            }
        });

    });
</script>
<script>
    function myFunction() {

        var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
        var Discount = parseFloat(document.getElementById("Discount").value);
        var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
        var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

        var Amount_Commission2 = Amount_Commission - Discount;


        if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

            alert('Please enter the commission amount');

        } else {
            var intResults = Amount_Commission2 * Rate_VAT / 100;

            var intResults2 = parseFloat(intResults + Amount_Commission2);

            sumq = parseFloat(intResults).toFixed(2);

            sumt = parseFloat(intResults2).toFixed(2);

            document.getElementById("Value_VAT").value = sumq;

            document.getElementById("Total").value = sumt;

        }

    }
</script>
@endsection
