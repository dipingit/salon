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
					<h1 class="m-0 text-dark">Add Bill</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('bill') }}">Bills</a></li>
						<li class="breadcrumb-item active">Create</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-warning">
				<div class="card-body">
					<form method="POST" action="{{ route('bill.store') }}">
						@csrf
						{{-- Date --}}
						<div class="form-group">
							<label for="date">
								Date
							</label>

							<input type="text" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" id="date" value="{{ old('date', optional($bill)->date) }}">

							@if ($errors->has('date'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('date') }}</strong>
							</span>
							@endif
						</div>

						{{-- Customer --}}
						<div class="form-group">
							<label for="customer_selection">Customer</label>
							<select name="customer_selection" class="form-control{{ $errors->has('customer_selection') ? ' is-invalid' : '' }}" id="customer_selection">
								<option value="">Select</option>
								<option value="1">Old Customer</option>
								<option value="2">New Customer</option>
							</select>
							@if ($errors->has('customer_selection'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('customer_selection') }}</strong>
							</span>
							@endif
						</div>
						<div id="customer_info"></div>

						{{-- challan_no --}}
						<div class="form-group">
							<label for="invoice">
								Invoice
							</label>

							<input type="text" class="form-control{{ $errors->has('invoice') ? ' is-invalid' : '' }}" name="invoice" id="invoice" value="{{ old('invoice', optional($bill)->invoice) }}">

							@if ($errors->has('invoice'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('invoice') }}</strong>
							</span>
							@endif
						</div>

						<div class="form-group">
							<label for="employee_id">Served By</label>
							<select name="employee_id" class="form-control{{ $errors->has('employee_id') ? ' is-invalid' : '' }}" id="employee_id">
								<option value="">Select Employee</option>
								@forelse($employees as $employee)
								<option value="{{ $employee->id }}" 
									@if( old('employee_id') == $employee->id )
									selected
									@endif
									>
									{{ $employee->name }}
								</option>
								@empty
								<option value="">No employee Found</option>
								@endforelse
							</select>
							@if ($errors->has('employee_id'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('employee_id') }}</strong>
							</span>
							@endif
						</div>

						<div class="row">
							<div class="col-md-1">
								<button id="add_more" class="btn btn-info mt-4"><i class="fa fa-plus" title="Add More"></i></button>
							</div>
							<div class="col-md-11">
								<div id="more_service">
									<div class="row">
										<div class="col-md-7">
											{{-- service --}}
											<div class="form-group">
												<label for="service_id">Select Service</label>
												<select name="service_id[]" class="form-control" id="service_id" required="required">
													<option value="">Select</option>
													@forelse($services as $service)
													<option value="{{ $service->id }}" >
														{{ $service->name }}
													</option>
													@empty
													<option value="">No Service Found</option>
													@endforelse
												</select>
											</div>
										</div>
										<div class="col-md-4">
											{{-- Rate --}}
											<div class="form-group">
												<label for="amount">
													Amount
												</label>
												<input type="number" min="0" step="any" class="form-control amount" name="amount[]" id="amount" required="required">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
	                        <div class="col-md-4 col-md-offset-8">
	                            <label for="total">Total</label>
	                            <div class="form-group">
	                                <input type="text" name="total" id="total" class="form-control" disabled>
	                            </div>
	                        </div>
	                        <!-- /.col -->
	                    </div>
	                    <!-- /.row -->

	                    <div class="row">
	                        <div class="col-md-4 col-md-offset-8">
	                            <label for="discount">Discount</label>
	                            <div class="form-group">
	                                <input type="number" name="discount" id="discount" class="form-control invoice" placeholder="Enter discount..">
	                            </div>
	                        </div>
	                        <!-- /.col -->
	                    </div>
	                    <!-- /.row -->

	                    <div class="row">
	                        <div class="col-md-4 col-md-offset-8">
	                            <label for="tax">Tax %</label>
	                            <div class="form-group">
	                                <input type="number" name="tax" id="tax" class="form-control invoice" placeholder="Enter tax..">
	                            </div>
	                        </div>
	                        <!-- /.col -->
	                    </div>
	                    <!-- /.row -->

	                    <div class="row">
	                        <div class="col-md-4 col-md-offset-8">
	                            <label for="tax_amount">Tax Amount</label>
	                            <div class="form-group">
	                                <input type="text" name="tax_amount" id="tax_amount" class="form-control" readonly="readonly">
	                            </div>
	                        </div>
	                        <!-- /.col -->
	                    </div>
	                    <!-- /.row -->

	                    <div class="row">
	                        <div class="col-md-4 col-md-offset-8">
	                            <label for="net_total">Net Total</label>
	                            <div class="form-group">
	                                <input type="text" name="net_total" value="" id="net_total" class="form-control" disabled>
	                            </div>
	                        </div>
	                        <!-- /.col -->
	                    </div>

						{{-- Details --}}
						<div class="form-group">
							<label for="details">
								Remarks
							</label>

							<textarea name="details" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" id="details" cols="30" rows="5">{{ old('details', optional($bill)->details) }}</textarea>

							@if( $errors->has('details'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('details') }}</strong>
							</span>
							@endif
						</div>

						{{-- Save --}}
						<div class="form-group row mb-0">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">
									{{ __('Save') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('script')
<script>
	{{-- jquery datepicker --}}
	$( function() {
		$( "#date" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
		});
	});

	$('#customer_selection').on('change', function(){
		var customer_selection = $('#customer_selection').val();
		if (customer_selection == 1) {
			$('#customer_info').html('');
			customer_info = '';
			customer_info += '<div class="form-group"><label for="customer_id">Select Customer</label><select name="customer_id" class="form-control{{ $errors->has('customer_id') ? ' is-invalid' : '' }}" id="customer_id"> <option value="">Select customer</option> @forelse($customers as $customer) <option value="{{ $customer->id }}" @if( old('customer_id', optional($bill)->customer_id) == $customer->id ) selected @endif> {{ $customer->name }} </option> @empty <option value="">No Customer Found</option> @endforelse </select> @if ($errors->has('customer_id')) <span class="invalid-feedback"> <strong>{{ $errors->first('customer_id') }}</strong> </span> @endif </div>';
			$('#customer_info').html(customer_info);
			$('#customer_id').select2({
				placeholder: 'Select Customer',

				ajax: {
					url: '{!!URL::route('customer-autocomplete-search')!!}',
					dataType: 'json',
					delay: 250,
					processResults: function (data) {
						return {
							results: data
						};
					},
					cache: true
				},
				theme: "bootstrap"
			});
		}

		else if (customer_selection == 2) {
			$('#customer_info').html('');
			customer_info = '';
			customer_info += '{{-- Name --}}<div class="form-group"><label for="name">Name</label><input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}" required="required">@if ($errors->has('name'))<span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>@endif</div>{{-- Mobile --}}<div class="form-group"><label for="mobile">Mobile</label><input type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" id="mobile" value="{{ old('mobile') }}" required="required">@if ($errors->has('mobile'))<span class="invalid-feedback"><strong>{{ $errors->first('mobile') }}</strong></span>@endif</div>{{-- age --}}<div class="form-group"><label for="age">Age</label><input type="text" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" id="age" value="{{ old('age') }}" required="required">@if ($errors->has('age'))<span class="invalid-feedback"><strong>{{ $errors->first('age') }}</strong></span>@endif</div>{{-- Address --}}<div class="form-group"><label for="address">Address</label><textarea name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" cols="30" rows="5">{{ old('address') }}</textarea>@if( $errors->has('address'))<span class="invalid-feedback"><strong>{{ $errors->first('address') }}</strong></span>@endif</div>';
			$('#customer_info').html(customer_info);
		}
		else{
			$('#customer_info').html('');
		}
	});

	$(document).on("change", "#service_id", function() {
		var id=$(this).val();
		if (id != '') {
			var url = '{{ url("/service/price", ":id") }}';
			url = url.replace('%3Aid', id);
			//console.log(url);
			$.ajax ({
				type: "GET",
				url: url,
				cache: false,
				success: function(data)
				{
					$("#amount").val(data);
					calculation();
				} 
			});
	        
	    }
    });


	$(document).ready(function() {
		var max_fields      = 150;
		var wrapper         = $("#more_service");
		var add_button      = $("#add_more");

		var x = 1;
		$(add_button).click(function(e){
			e.preventDefault();
			if(x < max_fields){
				x++;
				$(wrapper).append('<div class="row"><div class="col-md-7">{{-- service --}}<div class="form-group"><label for="service_id">Select</label><select name="service_id[]" class="form-control service_id" id="newID" required="required"><option value="">Select</option>@forelse($services as $service)<option value="{{ $service->id }}" >{{ $service->name }}</option>@empty<option value="">No Service Found</option>@endforelse </select></div></div><div class="col-md-4">{{-- Rate --}}<div class="form-group"><label for="amount">Amount</label><input type="number" min="0" step="any" class="form-control amount" name="amount[]" id="newAmount" required="required"></div></div><div class="col-sm-1"><a href="#" class="remove_field"><button style="margin-top: 30px;" class="btn btn-info"><i class="fa fa-minus" title="Remove Item"></i></button></a></div></div>');

				$('#newID').attr('id', "service_id"+x);
				$('#newAmount').attr('id', "amount"+x);
				$(document).on("change", "#service_id"+x, function() {
					var id=$(this).val();
					if (id != '') {
						var url = '{{ url("/service/price", ":id") }}';
						url = url.replace('%3Aid', id);
						//console.log(url);
						$.ajax ({
							type: "GET",
							url: url,
							cache: false,
							success: function(data)
							{
								$("#amount"+x).val(data);
								calculation();
							} 
						});
				        
				    }
			    });
			}
		});

		$(wrapper).on("click",".remove_field", function(e){
			e.preventDefault(); 
			$(this).parent().parent('div').remove(); 
			x--;
			calculation();
		})
	});

	$(document).on("keyup", ".invoice", function() {
        calculation();
    });

	function calculation() {
        var sum = 0;
        $(".amount").each(function(){
            sum += +$(this).val();
        });

        $("#total").val(sum);
        discount = $("#discount").val();
        tax = $("#tax").val();
        tax_amount = ((+sum - +discount) * +tax) / 100;
        $("#tax_amount").val(tax_amount);
        net_total = (+sum - +discount) + +tax_amount;
        $("#net_total").val(net_total);

        paid_amount = $("#paid_amount").val();

        $("#due_amount").val(+net_total - +paid_amount);
    }
</script>
@endsection