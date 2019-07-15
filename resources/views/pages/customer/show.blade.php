@extends('layouts.master')
@section('title', 'Customer')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Customer Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Customers</a></li>
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
            <div class="card card-warning">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $customer->name }}</td>        
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{ $customer->mobile }}</td>        
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>{{ $customer->email }}</td>        
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td>{{ $customer->age }}</td>        
                            </tr>

                            <tr>
                                <td>Gender</td>
                                <td>{{ $customer->gender }}</td>        
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $customer->address }}</td>        
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
