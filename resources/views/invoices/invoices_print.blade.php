@extends('layouts.master')
@section('css')
@section('title')
Print Invoice
@endsection
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }

</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Invoices /</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Print</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12" id="print">
						<div class=" main-content-body-invoice" >
							<div class="card card-invoice" >
								<div class="card-body" >
									<div class="invoice-header">
										<h1 class="invoice-title">Fatora</h1>
										<div class="billed-from">
											<h6>AbdElrahman Khedr</h6>
											<p>201 Something St., Something Town, YT 242, Country 6546<br>
											Tel No: 010942239871<br>
											Email: abdelrahmankhedr123@gamil.com</p>
										</div><!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										<div class="col-md">
											<label class="tx-gray-600">Billed To</label>
											<div class="billed-to">
												<h6>Omar Khedr</h6>
												<p>4033 Patterson Road, Staten Island, NY 10301<br>
												Tel No: 010942239871<br>
												Email: abdelrahmankhedr123@gamil.com</p>
											</div>
										</div>
										<div class="col-md">
											<label class="tx-gray-600">Invoice Information</label>
											<p class="invoice-info-row"><span>Invoice Number</span> <span>{{$invoice->invoice_number}}</span></p>
											<p class="invoice-info-row"><span>Invoice Date:</span> <span>{{$invoice->created_at}}</span></p>
											<p class="invoice-info-row"><span>Print Date</span> <span>{{now()}} </span></p>
											{{-- <p class="invoice-info-row"><span>Due Date:</span> <span>November 30, 2017</span></p> --}}
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
													<th class="wd-10p">#</th>
													<th class="wd-20p">Product</th>
													<th class="wd-30p">Section</th>
													<th class="tx-center">amount_collection</th>
													<th class="tx-right">amount_commission</th>
													<th class="tx-right">Sub_Total</th>
												</tr>
											</thead>
											<tbody>

                                                <tr>
													<td class="tx-6">1</td>
													<td class="tx-6">{{$invoice->product}} </td>
													<td class="tx-12">{{$invoice->section->section_name}}</td>
													<td class="tx-center">{{number_format($invoice->amount_collection)}} </td>
													<td class="tx-right">{{number_format($invoice->amount_commission)}}</td>
                                                    @php
                                                        $sum=$invoice->amount_collection+$invoice->amount_commission ;
                                                    @endphp
													<td class="tx-right">{{number_format($sum,2)}}</td>
												</tr>
												<tr>
													<td class="valign-middle" colspan="3" rowspan="4">
														<div class="invoice-notes">
															<label class="main-content-label tx-13">Notes</label>
														</div><!-- invoice-notes -->
													</td>
													<td class="tx-right">Sub-Total</td>
													<td class="tx-right" colspan="2">{{number_format($sum,2)}}</td>
												</tr>
												<tr>
													<td class="tx-right">Tax ({{$invoice->rate_vat}})</td>
													<td class="tx-right" colspan="2">{{$invoice->value_vat}}</td>
												</tr>
												<tr>
													<td class="tx-right">Discount</td>
													<td class="tx-right" colspan="2">-${{$invoice->discount}}</td>
												</tr>
												<tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse">Total Due</td>
													<td class="tx-right" colspan="2">
														<h4 class="tx-primary tx-bold">${{number_format($invoice->total ,2)}}</h4>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<hr class="mg-b-40">

									<a href="#" class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
										<i class="mdi mdi-printer ml-1"></i>Print
									</a>

								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

<script type="text/javascript">
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }

</script>
@endsection
