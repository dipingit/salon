<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }} | Bill</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body onload="window.print();">
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <!-- <p style="text-align: center;">بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ</p> -->
          <h2 class="page-header" style="text-align: center;"> 
            {{ config('app.name', 'Laravel') }}
          </h2>
          <p style="text-align: center;">Dhaka, Bangladesh</p>
          <small class="float-right">Date: {{ $date }}</small>
        </div>
        <!-- /.col -->
      </div>
      <br>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-8 invoice-col">
          <h4><strong>Service Bill</strong></h4>
          <h6>Customer Name: {{ $bills[0]->customer->name }}</h6>
          <h6>Customer Address: {{ $bills[0]->customer->address }}</h6>
          <h6>Served By: {{ $bills[0]->employee->name }}</h6>
          <h6>Date: {{ $bills[0]->date->format("d-m-Y") }}</h6>
        </div>
        <!-- /.col -->
        <div class="col-sm-2 invoice-col">
        </div>
        <!-- /.col -->
        <div class="col-sm-2 invoice-col">
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Sl</th>
                <th>Service</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @forelse($bills as $bill)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bill->service->name }}</td>
                <td>{{ $bill->amount }}</td>
              </tr>
              @empty
              @endforelse
            </tbody>

            <tfoot>
              <tr>
                <th colspan="2" style="text-align:right">Total:</th>
                <th>{{ $total }}</th>
              </tr>
              <tr>
                <th colspan="2" style="text-align:right">Discount:</th>
                <th>{{ $discount }}</th>
              </tr>
              <tr>
                <th colspan="2" style="text-align:right">Vat:</th>
                <th>{{ $vat }}</th>
              </tr>
              <tr>
                <th colspan="2" style="text-align:right">Net Total:</th>
                <th>{{ $net_total }}</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
</body>
</html>
