@extends('layouts.master')
@section('title', 'SMS')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">SMS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">SMS</li>
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
                <div class="box box-default">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-flat" id="btn_individual"><i class="icon fa fa-user"></i> Individual</button>
                                <button type="submit" class="btn btn-primary btn-flat" id="btn_group"><i class="icon fa fa-users"></i>All</button>
                                <hr>
                            </div>
                        </div>
                        <!-- end button -->

                        <div class="row">
                            <!-- Notification Box -->
                            <div class="col-md-12">
                                @if (!empty(Session::get('message')))
                                <div class="alert alert-success alert-dismissible" id="notification_box">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> {{ Session::get('message') }}
                                </div>
                                @elseif (!empty(Session::get('exception')))
                                <div class="alert alert-warning alert-dismissible" id="notification_box">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-warning"></i> {{ Session::get('exception') }}
                                </div>
                                @else
                                @endif
                            </div>
                            <!-- /.Notification Box -->
                        </div>
                        <!-- end notification -->


                        <form action="{{ url('send/sms/individual') }}" method="POST" name="file_name_add_form" enctype="multipart/form-data">
                            @csrf
                            <div id="individual">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Customer --}}
                                        <div class="form-group">
                                            <label for="customer_id">Select Customer</label>
                                            <select name="customer_id[]" class="form-control{{ $errors->has('customer_id') ? ' is-invalid' : '' }}" id="customer_id" multiple="multiple">
                                                <option value="">Select</option>
                                                @forelse($customers as $customer)
                                                <option value="{{ $customer->id }}" 
                                                    @if( old('customer_id') == $customer->id )
                                                    selected
                                                    @endif
                                                    >
                                                    {{ $customer->name }}
                                                </option>
                                                @empty
                                                <option value="">No Customer Found</option>
                                                @endforelse
                                            </select>
                                            @if ($errors->has('customer_id'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customer_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="publication_status">Message <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('publication_status') ? ' has-error' : '' }} has-feedback">
                                            <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                            @if ($errors->has('publication_status'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('publication_status') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-arrow-right"></i> Send</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end individual sms -->
                        </form>


                        <form action="{{ url('/send/sms/all') }}" method="post" name="file_name_add_form" enctype="multipart/form-data">
                            @csrf

                            <div id="group">
                                <!-- end row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="publication_status">Message <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('publication_status') ? ' has-error' : '' }} has-feedback">
                                            <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                            @if ($errors->has('publication_status'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('publication_status') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-arrow-right"></i> Send</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end group sms -->
                        </form>

                    </div>

                    <!-- /.content -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#individual").hide();
    $("#group").hide();

    $("#btn_individual").click(function () {
        $("#group").hide();
        $("#individual").show(500);
    });

    $("#btn_group").click(function () {
        $("#individual").hide();
        $("#group").show(500);
    });

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
</script>
@endsection
