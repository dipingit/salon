{{-- Name --}}
<div class="form-group">
	<label for="name">
		Name
	</label>

	<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name', optional($service)->name) }}" placeholder="Name">

	@if ($errors->has('name'))
	<span class="invalid-feedback">
		<strong>{{ $errors->first('name') }}</strong>
	</span>
	@endif
</div>

{{-- Code --}}
<div class="form-group">
	<label for="amount">
		Price
	</label>

	<input type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" id="amount" value="{{ old('amount', optional($service)->amount) }}" placeholder="Price">

	@if ($errors->has('amount'))
	<span class="invalid-feedback">
		<strong>{{ $errors->first('amount') }}</strong>
	</span>
	@endif
</div>

{{-- Details --}}
<div class="form-group">
	<label for="details">
		Details
	</label>

	<textarea name="details" class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" id="details" cols="30" rows="5" placeholder="Details about the Service">{{ old('details', optional($service)->details) }}</textarea>

	@if( $errors->has('details'))
	<span class="invalid-feedback">
		<strong>{{ $errors->first('details') }}</strong>
	</span>
	@endif
</div>

{{-- Show Image --}}
{{-- @if( optional($service)->image ) 
<div class="form-group" id="showImage">
	<img src="{{ asset("images/services/$service->image") }}" alt="" class="img-thumbnail" width="200">
	<input type="hidden" value="{{ $service->image }}" name="oldimage">
</div>	
@endif --}}

{{-- Upload Image --}}
{{-- <div class="form-group" style="display: none;" id="uploadImage">
	<img id="upload" class="img-thumbnail" width="200" src="#" alt="" />
</div>

Image
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
</div> --}}

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
@endsection