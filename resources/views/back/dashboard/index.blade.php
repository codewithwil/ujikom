@extends('back.layout.template')
@section('title', 'dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>Rp{{ number_format($saldo->value, 2, ',', '.') }}<sup style="font-size: 20px"></sup></h3>
            <p>Sakdo koperasi saat ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{route('saldo.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$pegawai->value}}</h3>

            <p>Pegawai koperasi</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$member->value}}</h3>

            <p>Anggota koperasi saat ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Function to update chart with data fetched from server
    function updateChart(chart, canvasId, endpoint) {
        fetch(endpoint)
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.label);
                const values = data.map(item => item.value);
                
                chart.data.labels = labels;
                chart.data.datasets[0].data = values;
                chart.update();
            })
            .catch(error => console.error('Error:', error));
    }

    // Initialize revenue chart
    const revenueChartCanvas = document.getElementById('revenue-chart-canvas');
    const revenueChartCtx = revenueChartCanvas.getContext('2d');
    const revenueChart = new Chart(revenueChartCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Revenue',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Initialize sales chart
    const salesChartCanvas = document.getElementById('sales-chart-canvas');
    const salesChartCtx = salesChartCanvas.getContext('2d');
    const salesChart = new Chart(salesChartCtx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Sales',
                data: [],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function initializeSimpananChart() {
    updateChart(revenueChart, 'revenue-chart-canvas', '{{ route('daily.simpanan.transactions') }}');
    setInterval(() => {
        updateChart(revenueChart, 'revenue-chart-canvas', '{{ route('daily.simpanan.transactions') }}');
    }, 5000); // Update chart every 5 seconds
    }

    // Initial data retrieval and periodic updates for pinjaman chart
    function initializePinjamanChart() {
        updateChart(salesChart, 'sales-chart-canvas', '{{ route('daily.pinjaman.transactions') }}');
        setInterval(() => {
            updateChart(salesChart, 'sales-chart-canvas', '{{ route('daily.pinjaman.transactions') }}');
        }, 5000); // Update chart every 5 seconds
    }

    // Initialize both charts
    function initializeCharts() {
        initializeSimpananChart();
        initializePinjamanChart();
    }

    initializeCharts();
</script>
</body>
</html>

@endsection