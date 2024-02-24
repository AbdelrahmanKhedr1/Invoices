@extends('layouts.master')
@section('css')
@section('title')
    Invoices
@endsection
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoices /</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ List
                of invoices</span>
        </div>
    </div>

</div>


<div class="col-xl-12">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">List of invoices</h4>
                {{-- <i class="mdi mdi-dots-horizontal text-gray"></i> --}}
@can('EXCEL EXPORT')
<div class="col-sm-3 col-md-2 mg-t-10 mg-md-t-0">
    <a href="{{route('invoices.export')}}" class="btn btn-success btn-with-icon btn-block">
        <i class="typcn typcn-edit"></i>
        Excel
    </a>
</div>
@endcan

            </div>
            <p class="tx-12 tx-gray-500 mb-2">Show All Invoices</p>
            @if (session()->has('Edit'))
            <script>
                window.onload = function() {
                    notif({
                        msg: "Invoice has been successfully amended",
                        type: "primary"
                    })
                }

            </script>
        @endif
        @if (session()->has('Delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "Invoice deleted successfully",
                    type: "warning"
                })
            }

        </script>
    @endif



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-md-nowrap" id="example1">
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
                            @can('show invoice')
                            <th class="border-bottom-0">Show Invoice</th>
                            @endcan
                            @can('print invoice')
                            <th class="border-bottom-0">Print Invoice</th>
                            @endcan
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
                                <td> {{ number_format($value->total,2)  }} </td>
                                <td>
                                    @if ($value->updated_at != $value->created_at)

                                    {{ $value->updated_at }}
                                    @endif
                                </td>
                                <td> {{ $value->created_at }} </td>
                                @can('show invoice')
                                <td><a class="btn btn-warning-gradient btn-block"
                                    href="{{ route('invoices.show', $value->id) }}">Show</a>
                                </td>
                                @endcan
                                @can('print invoice')
                                <td><a class="btn btn-success-gradient btn-block"
                                        href="{{ route('invoices.print', $value->id) }}">Print</a>
                                </td>
                                @endcan

                                <td style="display:inline-flex">
                                    @can('invoice edit')
                                    <a class="btn btn-primary-gradient btn-block"
                                        href="{{ route('invoices.edit', $value->id) }}">Edit</a>
                                    @endcan
                                    @can('delete invoice')
                                    <form action="{{ route('invoices.destroy', $value->id) }}" method="post" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger-gradient btn-block" type="submit">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

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


<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
