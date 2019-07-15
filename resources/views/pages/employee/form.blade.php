{{-- Name --}}
<div class="form-group">
	<label for="name">
		Name
	</label>

	<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name', optional($employee)->name) }}" placeholder="Name">

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

	<input type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" id="mobile" value="{{ old('mobile', optional($employee)->mobile) }}" placeholder="Mobile">

	@if ($errors->has('mobile'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('mobile') }}</strong>
		</span>
	@endif
</div>

{{-- Mobile --}}
<div class="form-group">
	<label for="email">
		Email
	</label>

	<input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email', optional($employee)->email) }}" placeholder="Email">

	@if ($errors->has('email'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
	@endif
</div>

{{-- employee Type --}}
<div class="form-group">
	<label for="gender">Gender</label>
	<select name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" id="gender">
		<option value="">Select</option>
		<option value="Male" 
			@if( old('gender', optional($employee)->gender) == 'Male' )
				selected
			@endif
			>
			Male
		</option>
		<option value="Female" 
			@if( old('gender', optional($employee)->gender) == 'Female' )
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

<div class="form-group">
	<label for="dob">
		Date of  Birth
	</label>

	<input type="text" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" id="dob" value="{{ old('dob', optional($employee)->dob) }}" placeholder="Date of Birth">

	@if ($errors->has('dob'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('dob') }}</strong>
		</span>
	@endif
</div>

<div class="form-group">
	<label for="joining_date">
		Joining Date
	</label>

	<input type="text" class="form-control{{ $errors->has('joining_date') ? ' is-invalid' : '' }}" name="joining_date" id="joining_date" value="{{ old('joining_date', optional($employee)->joining_date) }}" placeholder="Joining Date">

	@if ($errors->has('joining_date'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('joining_date') }}</strong>
		</span>
	@endif
</div>

<div class="form-group">
	<label for="nid">
		National ID
	</label>

	<input type="text" class="form-control{{ $errors->has('nid') ? ' is-invalid' : '' }}" name="nid" id="nid" value="{{ old('nid', optional($employee)->nid) }}" placeholder="National ID">

	@if ($errors->has('nid'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('nid') }}</strong>
		</span>
	@endif
</div>

{{-- Address --}}
<div class="form-group">
	<label for="address">
		Address
	</label>

	<textarea name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" cols="30" rows="5" placeholder="Address">{{ old('address', optional($employee)->address) }}</textarea>

	@if( $errors->has('address'))
		<span class="invalid-feedback">
			<strong>{{ $errors->first('address') }}</strong>
		</span>
	@endif
</div>

{{-- Show Image --}}
@if( optional($employee)->image ) 
<div class="form-group" id="showImage">
	<img src="{{ asset("images/employees/$employee->image") }}" alt="" class="img-thumbnail" width="200">
	<input type="hidden" value="{{ $employee->image }}" name="oldimage">
</div>	
@endif

{{-- Upload Image --}}
<div class="form-group" style="display: none;" id="uploadImage">
	<img id="upload" class="img-thumbnail" width="200" src="#" alt="" />
</div>

{{-- Image --}}
<div class="form-group">
	<label for="image">
		Image
	</label>

	<input type="file" class="form-control-file" name="image" id="image" accept="image/*" onchange="handleFiles(this.files)">
	<small id="fileHelp" class="form-text text-muted">(JPEG or PNG Format)</small>

	@if ($errors->has('image'))
	<span class="invalid-feedback" style="display: block;">
		<strong>{{ $errors->first('image') }}</strong>
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

@section('script')
<script src="{{ asset('js/library/image-upload.js') }}"></script>
<script>
	{{-- jquery datepicker --}}
	$( function() {
		$( "#dob" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
		});
		$( "#joining_date" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
		});
	});
</script>
@endsection