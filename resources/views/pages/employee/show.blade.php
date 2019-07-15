@extends('layouts.master')
@section('title', 'Employee')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Employee Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employees</a></li>
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
                                <td>{{ $employee->name }}</td>        
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{ $employee->mobile }}</td>        
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>{{ $employee->email }}</td>        
                            </tr>
                            <tr>
                                <td>National ID</td>
                                <td>{{ $employee->nid }}</td>        
                            </tr>

                            <tr>
                                <td>Date of Birth</td>
                                <td>{{ date('F d, Y', strtotime($employee->dob)) }}</td>        
                            </tr>
                            <tr>
                                <td>Joining Date</td>
                                <td>{{ date('F d, Y', strtotime($employee->joining_date)) }}</td>        
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $employee->address }}</td>        
                            </tr>

                            <tr>
                                <td>Image</td>
                                <td><img src="{{ asset("images/employees/$employee->image") }}" style="width: 145px; height: 160px;" class="" alt="{{ $employee->name }}"></td>        
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
