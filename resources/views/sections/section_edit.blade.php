@extends('layouts.master')
@section('css')
@section('title')
    Edit Section
@endsection
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Section /</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Edit</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                        <div class="card  box-shadow-0">
                            <div class="card-header">
                                <h4 class="card-title mb-1">Edit Section</h4>
                                <p class="mb-2">It is Very Easy to Edit Section.</p>
                            </div>
                            <div class="card-body pt-0">
                                <form class="form-horizontal" action="{{ route('sections.update',$section_id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="inputName" placeholder="Section Name"
                                            name="section_name" value="{{ $section_id->section_name }}">
                                        @error('section_name')
                                            <div class="alert alert-danger">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="description" rows="4" name="desc" >{{ $section_id->desc }}</textarea>
                                        @error('desc')
                                            <div class="alert alert-danger">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                    </div>
                                </form>
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
@endsection
