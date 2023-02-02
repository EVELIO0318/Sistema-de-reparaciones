@extends('layouts.principal')
@section('module')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Home</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
            <!-- cuadros de informacion -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="UserDashboard">{{$data[0]}}</h3>

                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="far fa-user-circle"></i>
                </div>
                <a href="/user" class="small-box-footer"> Ver Usuarios <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="customerDashboard">{{$data[1]}}</h3>

                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{route('customers.index')}}" class="small-box-footer"> Ver Clientes <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="pending">{{$data[2]}}</h3>

                    <p>Reparaciones Pendientes</p>
                </div>
                <div class="icon">
                    <i class="far fa-clock"></i>
                </div>
                <a href="{{route('orders.index')}}" class="small-box-footer"> Ver Reparaciones Pendientes <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="ready">{{$data[3]}}</h3>

                    <p>Reparaciones Listas</p>
                </div>
                <div class="icon">
                    <i class="far fa-check-circle"></i>
                </div>
                <a href="{{route('orders.ordersReady')}}" class="small-box-footer"> Ver Reparaciones Listas<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            </div>
        </div>
        <div class="card">
            <div class="card-header bg-gradient-danger">
                <h3 class="card-title">Reparaciones Listas y Pendientes</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="chart-responsive">
                    <canvas id="fixed" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
                <div class="card-footer p-0">
                <ul class="nav nav-pills flex-column porcentajes">
                </ul>
            </div>
            <!-- /.footer -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('js')
    <script>
        let pending=document.getElementById('pending').innerHTML;
        let ready=document.getElementById('ready').innerHTML;
        let DatosDelGrafico={
            labels: ['Pendientes', 'Listas'],
            datasets: [
                {
                    data: [pending,ready],
                    backgroundColor: ['#ffbf00','#28a745']
                }
            ]

        };

        var pieOptions = {
            plugins: {
                legend: {
                    display: true,
                    position: "right"
                }
            }   
        }

        let pieChartCanvas = document.getElementById('fixed').getContext('2d');
        let pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: DatosDelGrafico,
        options: pieOptions
    });
    </script>
    
@endsection