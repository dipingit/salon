@extends('layouts.master')
@section('title', 'Customer')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">{{ $customer->name }}'s Report</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('customer') }}">Customers</a></li>
						<li class="breadcrumb-item active">Report</li>
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
	        		<a href="{{ url('customer/report/print', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Print" target="_blank">
	        			<i class="fa fa-print" aria-hidden="true" title="Print"></i> Print
	        		</a>

	        		<a href="{{ url('customer/report/pdf', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="PDF" target="_blank">
	        			<i class="fa fa-file-pdf-o" aria-hidden="true" title="PDF"></i> PDF
	        		</a>

	        		<a href="{{ url('customer/report/excel', $id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Excel" target="_blank">
	        			<i class="fa fa-file-excel-o" aria-hidden="true" title="Excel"></i> Excel
	        		</a>
	        	</div> --}}
	            <div class="card-body">
	                <div class="table-responsive">
	                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                        <thead>
	                            <tr>
	                                <th>Sl</th>
	                                <th>Date</th>
	                                <th>Customer</th>
	                                <th>Employee</th>
	                                <th>Total</th>
	                                <th>Discount</th>
	                                <th>Vat</th>
	                                <th>Net Total</th>
	                                <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	@foreach($bills as $bill)
	                        	<tr>
	                        		<td>{{ $loop->iteration }}</td>
	                        		<td>{{ $bill->date->format("d-m-Y") }}</td>
	                        		<td>{{ $bill->customer->name }}</td>
	                        		<td>{{ $bill->employee->name }}</td>
	                        		<td>{{ $bill->amount }}</td>
	                        		<td>{{ $bill->discount }}</td>
	                        		<td>{{ $bill->vat }}</td>
	                        		<td>{{ ($bill->amount + $bill->vat) - $bill->discount }}</td>
	                        		<td>
	                        			<div class="btn-group">
		                                    <a href="{{ route('bill.show',$bill->token) }}" class="btn btn-primary btn-sm" title="Show">
		                                        Show
		                                    </a>
		                                    <a href="{{ url('bill/print',$bill->token) }}" class="btn btn-success btn-sm" title="Print" target="_blank">
		                                        Print
		                                    </a>
											<form action="{{ route('bill.destroy', $bill->token) }}" method="POST">
												@csrf
												@method('DELETE')
												<button class="btn btn-danger btn-sm">Delete</button>
											</form>
		                                </div>
		                            </td>
	                        	</tr>
	                        	@endforeach
	                        </tbody>
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
		$("#dataTable").DataTable();
	});
</script>
@endsection
