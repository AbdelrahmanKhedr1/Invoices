@extends('layouts.master')
@section('css')
@section('title')
    Create Section
@endsection
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
            <h4 class="content-title mb-0 my-auto">Section/</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Create</span>
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
                <h4 class="card-title mb-1">Create Section</h4>
                <p class="mb-2">It is Very Easy to Create a new Section.</p>
                @if (session()->has('Add'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: "The section has been added successfully",
                            type: "info"
                        })
                    }

                </script>
            @endif
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('sections.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputName" placeholder="Section Name"
                            name="section_name" value="{{ old('section_name') }}">
                        @error('section_name')
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" placeholder="description" rows="4" name="desc" value="{{ old('desc') }}"></textarea>
                        @error('desc')
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Create</button>
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
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
