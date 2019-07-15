{{-- Name --}}
<div class="form-group">
	<label for="name">
		Name
	</label>

	<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name', optional($customer)->name) }}" placeholder="Name">

	@if ($errors->has('name'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
	@endif
</div>

{{-- Mobile --}}
<div class="form-group">
	<label for="mobile">
		Mobile
	</label>

	<input type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" id="mobile" value="{{ old('mobile', optional($customer)->mobile) }}" placeholder="Mobile">

	@if ($errors->has('mobile'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('mobile') }}</strong>
		</span>
	@endif
</div>

{{-- Email --}}
<div class="form-group">
	<label for="email">
		Email
	</label>

	<input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email', optional($customer)->email) }}" placeholder="Email">

	@if ($errors->has('email'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
	@endif
</div>

{{-- Email --}}
<div class="form-group">
	<label for="age">
		Age
	</label>

	<input type="text" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" id="age" value="{{ old('age', optional($customer)->age) }}" placeholder="Age">

	@if ($errors->has('age'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('age') }}</strong>
		</span>
	@endif
</div>

<div class="form-group">
	<label for="gender">Gender</label>
	<select name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" id="gender">
		<option value="">Select</option>
		<option value="Male" 
			@if( old('gender', optional($customer)->gender) == 'Male' )
				selected
			@endif
			>
			Male
		</option>
		<option value="Female" 
			@if( old('gender', optional($customer)->gender) == 'Female' )
				selected
			@endif
			>
			Female
		</option>
	</select>
	@if ($errors->has('gender'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('gender') }}</strong>
		</span>
	@endif
</div>

{{-- Address --}}
<div class="form-group">
	<label for="address">
		Address
	</label>

	<textarea name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" cols="30" rows="5" placeholder="Address">{{ old('address', optional($customer)->address) }}</textarea>

	@if( $errors->has('address'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('address') }}</strong>
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