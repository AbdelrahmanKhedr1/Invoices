@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@section('title')
Invoice Reports
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Reports /</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Invoices</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">


            <div class="card-header pb-0">

                <form action="{{ route('reports.search') }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


                    <div class="col-lg-3">
                        <label class="rdiobox">
                            <input checked name="radio" type="radio" value="1" id="type_div"> <span> Search by invoice Status</span></label>
                    </div>


                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                        <label class="rdiobox"><input name="radio" value="2" type="radio"><span>Search by invoice number
                            </span></label>
                    </div><br><br>

                    <div class="row">

                        <div class="col-lg-4 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">Select Invoice Status</p><select class="form-control select2" name="type"
                                required>
                                <option value="{{ $type ?? 'Select Invoice Status' }}" selected>
                                    {{ $type ?? 'Select Invoice Status' }}
                                </option>
                                @foreach ($status as $value)
                                    <option value="{{$value->id}}">{{$value->status}}</option>
                                @endforeach


                            </select>
                        </div><!-- col-4 -->


                        <div class="col-lg-4 mg-t-20 mg-lg-t-0" id="invoice_number">
                            <p class="mg-b-10">Search by invoice number</p>
                            <input type="text" class="form-control" id="invoice_number" name="invoice_number" placeholder="Enter the invoice number">

                        </div><!-- col-4 -->

                        <div class="col-lg-4" id="start_at">
                            <label for="exampleFormControlSelect1">From the date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                    name="start_at" placeholder="YYYY-MM-DD" type="text">
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-4" id="end_at">
                            <label for="exampleFormControlSelect1">To date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" name="end_at"
                                    value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="text">
                            </div><!-- input-group -->
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-1 col-md-2">
                            <button class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (isset($invoices))
                        <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">id</th>
                                    <th class="border-bottom-0">invoice number</th>
                                    <th class="border-bottom-0">product</th>
                                    <th class="border-bottom-0">section</th>
                                    <th class="border-bottom-0">status</th>
                                    <th class="border-bottom-0">total</th>
                                    <th class="border-bottom-0">updated at</th>
                                    <th class="border-bottom-0">Invoice date</th>
                                    <th class="border-bottom-0">Show Invoice</th>
                                    <th class="border-bottom-0">Print Invoice</th>
                                    <th class="border-bottom-0">control</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $value)
                                    <tr>
                                        <td> {{ $value->id }} </td>
                                        <td> {{ $value->invoice_number }} </td>
                                        <td> {{ $value->product }} </td>
                                        <td> {{ $value->section->section_name }} </td>
                                        <td>
                                            @if ($value->status->id == 1)
                                                <span class="text-danger">{{ $value->status->status }}</span>
                                            @elseif($value->status->id == 2)
                                                <span class="text-success">{{ $value->status->status }}</span>
                                            @else
                                                <span class="text-warning">{{ $value->status->status }}</span>
                                            @endif
                                        </td>
                                        <td> {{ number_format($value->total, 2) }} </td>
                                        <td>
                                            @if ($value->updated_at != $value->created_at)
                                                {{ $value->updated_at }}
                                            @endif
                                        </td>
                                        <td> {{ $value->created_at }} </td>
                                        <td><a class="btn btn-warning-gradient btn-block"
                                                href="{{ route('invoices.show', $value->id) }}"></i>Show</a>
                                        </td>
                                        <td><a class="btn btn-success-gradient btn-block"
                                                href="{{ route('invoices.print', $value->id) }}">Print</a>
                                        </td>
                                        <td style="display:inline-flex">
                                            <a class="btn btn-primary-gradient btn-block"
                                                href="{{ route('invoices.edit', $value->id) }}">Edit</a>
                                            <form action="{{ route('invoices.destroy', $value->id) }}" method="post"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')


                                                <button class="btn btn-danger-gradient btn-block"
                                                    type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

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
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function() {

        $('#invoice_number').hide();

        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#invoice_number').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();
            } else {
                $('#invoice_number').show();
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();
            }
        });
    });
</script>


@endsection
