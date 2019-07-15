@extends('layouts.master')
@section('title', 'Bill')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Bill</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('bill') }}">Bill</a></li>
						<li class="breadcrumb-item active">View</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				{{-- <div class="card-header">
					<a href="{{ url('order/print',$orders[0]->workOrder_id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Print" target="_blank">
						<i class="fa fa-print" aria-hidden="true" title="Print"></i> Print
					</a>

					<a href="{{ url('order/pdf',$orders[0]->workOrder_id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="PDF" target="_blank">
						<i class="fa fa-file-pdf-o" aria-hidden="true" title="PDF"></i> PDF
					</a>

					<a href="{{ url('order/excel',$orders[0]->workOrder_id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Excel" target="_blank">
						<i class="fa fa-file-excel-o" aria-hidden="true" title="Excel"></i> Excel
					</a>
				</div> --}}
				<div class="card-body">
					<div class="row">
						<div class="col-sm-8">
							<h6>Customer Name: {{ $bills[0]->customer->name }}</h6>
							<h6>Customer Address: {{ $bills[0]->customer->address }}</h6>
							<h6>Served By: {{ $bills[0]->employee->name }}</h6>
							<h6>Date: {{ $bills[0]->date->format("d-m-Y") }}</h6>
						</div>
						<div class="col-sm-4">
							
						</div>
					</div>
					<br>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Sl</th>
									<th>Service</th>
									<th>Amount</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($bills as $bill)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $bill->service->name }}</td>
									<td>{{ $bill->amount }}</td>
									<td>
										<div class="btn-group">
											<form action="{{ route('bill.destroy', $bill->id) }}" method="POST">
												@csrf
												@method('DELETE')
												<button class="btn btn-danger btn-sm">Delete</button>
											</form>
										</div>
									</td>
								</tr>
								@empty
								@component('partials.warning')
								No Information Found
								@endcomponent
								@endforelse
							</tbody>

							<tfoot>
								<tr>
									<th colspan="2" style="text-align:right">Total:</th>
									<th>{{ $total }}</th>
									<th></th>
								</tr>
								<tr>
									<th colspan="2" style="text-align:right">Discount:</th>
									<th>{{ $discount }}</th>
									<th></th>
								</tr>
								<tr>
									<th colspan="2" style="text-align:right">Vat:</th>
									<th>{{ $vat }}</th>
									<th></th>
								</tr>
								<tr>
									<th colspan="2" style="text-align:right">Net Total:</th>
									<th>{{ $net_total }}</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('script')
<script>
	$(function () {
		$("#dataTable").DataTable({
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;
				
			    // Remove the formatting to get integer data for summation
			    var intVal = function ( i ) {
			    	return typeof i === 'string' ?
			    	i.replace(/[\$,]/g, '')*1 :
			    	typeof i === 'number' ?
			    	i : 0;
			    };
			    
			    // Total over all pages
			    total = api
			    .column( 6 )
			    .data()
			    .reduce( function (a, b) {
			    	return intVal(a) + intVal(b);
			    }, 0);
			    
			    // Total over this page
			    pageTotal = api
			    .column( 6, { page: 'current'} )
			    .data()
			    .reduce( function (a, b) {
			    	return intVal(a) + intVal(b);
			    }, 0);
			    
			    // Update footer
			    $( api.column( 6 ).footer() ).html(
			    	''+pageTotal +' ( '+ total +' total)'
			    );

			    // Total over all pages
			    vat = api
			    .column( 4 )
			    .data()
			    .reduce( function (a, b) {
			    	return intVal(a) + intVal(b);
			    }, 0);
			    
			    // vat over this page
			    pagevat = api
			    .column( 4, { page: 'current'} )
			    .data()
			    .reduce( function (a, b) {
			    	return intVal(a) + intVal(b);
			    }, 0);
			    
			    // Update footer
			    $( api.column( 4 ).footer() ).html(
			    	''+pagevat +' ( '+ vat +' total)'
			    );

			    // Total over all pages
			    amount = api
			    .column( 5 )
			    .data()
			    .reduce( function (a, b) {
			    	return intVal(a) + intVal(b);
			    }, 0);
			    
			    // amount over this page
			    pageamount = api
			    .column( 5, { page: 'current'} )
			    .data()
			    .reduce( function (a, b) {
			    	return intVal(a) + intVal(b);
			    }, 0);
			    
			    // Update footer
			    $( api.column( 5 ).footer() ).html(
			    	''+pageamount +' ( '+ amount +' total)'
			    );
			}
		});
	});
</script>
@endsection