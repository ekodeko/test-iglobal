@extends('layouts.main')
@section('pageTitle', 'Dashboard')
@section('title', 'Dashboard')

@section('content')
    <!-- Content Row -->
    <div class="row">
        @if ($user->sales->sum('quantity') <= 70)
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Peringatan!!!</h4>
                    <p>Halo <b>{{ $user->name }}</b> stok kamu hampir habis nih, segera lakukan restok agar akunmu tetap
                        aktif
                    </p>
                    <hr>
                    <a href="{{ url('order/add') }}" class="alert-link">Beli Produk</a>
                </div>
            </div>
        @endif
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan (Bulanan)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                {{ ($user_monthly->sell_price - $product->product_het) * $user_monthly->sales->sum('quantity') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan (Tahunan)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp.
                                {{ ($user_yearly->sell_price - $product->product_het) * $user_yearly->sales->sum('quantity') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Target Penjualan</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{ round(($user->sales->sum('quantity') / 70) * 100) }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ round(($user->sales->sum('quantity') / 70) * 100) }}%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Stok Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $user_data->orders->sum('quantity') * $product->product_per_box - $user_data->sales->sum('quantity') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Reseller Leaderboard</h6>
                    {{-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> --}}
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    {{-- <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div> --}}
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>Nama</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users_top as $key => $user_top)
                                @if ($loop->iteration == 1)
                                    <tr class="bg-success text-light">
                                        <td><strong>{{ $user_top->name }}</strong></td>
                                        <td><strong>{{ $user_top->total_pembelian }}</strong></td>
                                    </tr>
                                @elseif($loop->iteration == 2)
                                    <tr class="bg-primary text-light">
                                        <td>{{ $user_top->name }}</td>
                                        <td>{{ $user_top->total_pembelian }}</td>
                                    </tr>
                                @elseif($loop->iteration == 3)
                                    <tr class="bg-info text-light">
                                        <td>{{ $user_top->name }}</td>
                                        <td>{{ $user_top->total_pembelian }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ $user_top->name }}</td>
                                        <td>{{ $user_top->total_pembelian }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Lokasi Reseller Terbanyak</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="resellerLocationChart"></canvas>
                    </div>
                    {{-- <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div> --}}
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7"></div>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Lokasi Penjualan Terbanyak</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="highestSellChart"></canvas>
                    </div>
                    {{-- <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div> --}}
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    {{-- <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <!-- Color System -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Primary
                            <div class="text-white-50 small">#4e73df</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Success
                            <div class="text-white-50 small">#1cc88a</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Info
                            <div class="text-white-50 small">#36b9cc</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Warning
                            <div class="text-white-50 small">#f6c23e</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Danger
                            <div class="text-white-50 small">#e74a3b</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Secondary
                            <div class="text-white-50 small">#858796</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="img/undraw_posting_photo.svg" alt="">
                    </div>
                    <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow"
                            href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images
                        that you can use completely free and without attribution!</p>
                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
            </div>

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor
                        page performance. Custom CSS classes are used to create custom components and custom utility
                        classes.</p>
                    <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework,
                        especially the utility classes.</p>
                </div>
            </div>

        </div>
    </div> --}}
@endsection
@push('script')
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        let resellerData = JSON.parse('<?php echo $reseller_location_data; ?>');
        var ctx = document.getElementById("resellerLocationChart");
        var resellerLocationChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: resellerData.label,
                datasets: [{
                    data: resellerData.data,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#B9CC36', '#CC36B9', '#B08F4F',
                        '#6936C9', '#2DD2CA', '#649B7D', '#4e0af5'
                    ],
                    // backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#1ecbe1', '#21aade', '#0f93f0',
                    //     '#1267ed', '#0f38f0', '#0d19f2', '#280af5', '#4e0af5', '#750cf3', '#F3750C',
                    //     '#0CF375', '#CA2DD2', '#D2CA2D', '#2DD2CA', '#8F4FB0', '#B08F4F', '#4FB08F',
                    //     '#41DE21', '#DE2141', '#17B4E8', '#E817B4', '#B4E817', '#F38F0C', '#0CF38F',
                    //     '#8F0CF3', '#7D649B', '#9B7D64', '#649B7D', '#80857A', '#7A8085', '#857A80',
                    //     '#DF4E73', '#73DF4E', '#36B9CC', '#CC36B9', '#B9CC36', '#C96936', '#6936C9',
                    //     '#36C969', '#4e73df', '#1cc88a', '#36b9cc', '#1ecbe1', '#21aade', '#0f93f0',
                    //     '#1267ed', '#0f38f0', '#0d19f2', '#280af5', '#4e0af5', '#750cf3', '#F3750C',
                    //     '#0CF375', '#CA2DD2', '#D2CA2D', '#2DD2CA', '#8F4FB0', '#B08F4F', '#4FB08F',
                    //     '#41DE21', '#DE2141', '#17B4E8', '#E817B4', '#B4E817', '#F38F0C', '#0CF38F',
                    //     '#8F0CF3', '#7D649B', '#9B7D64', '#649B7D', '#80857A', '#7A8085', '#857A80',
                    //     '#DF4E73', '#73DF4E', '#36B9CC', '#CC36B9', '#B9CC36', '#C96936', '#6936C9',
                    //     '#36C969', '#4e73df', '#1cc88a', '#36b9cc', '#1ecbe1', '#21aade', '#0f93f0',
                    //     '#1267ed', '#0f38f0', '#0d19f2', '#280af5', '#4e0af5', '#750cf3', '#F3750C',
                    //     '#0CF375', '#CA2DD2', '#D2CA2D', '#2DD2CA', '#8F4FB0', '#B08F4F', '#4FB08F',
                    //     '#41DE21', '#DE2141', '#17B4E8', '#E817B4', '#B4E817', '#F38F0C', '#0CF38F',
                    //     '#8F0CF3', '#7D649B', '#9B7D64', '#649B7D', '#80857A', '#7A8085', '#857A80',
                    //     '#DF4E73', '#73DF4E', '#36B9CC', '#CC36B9', '#B9CC36', '#C96936', '#6936C9',
                    //     '#36C969', '#4e73df', '#1cc88a', '#36b9cc', '#1ecbe1', '#21aade', '#0f93f0',
                    //     '#1267ed', '#0f38f0', '#0d19f2', '#280af5', '#4e0af5', '#750cf3', '#F3750C',
                    //     '#0CF375', '#CA2DD2', '#D2CA2D', '#2DD2CA', '#8F4FB0', '#B08F4F', '#4FB08F',
                    //     '#41DE21', '#DE2141', '#17B4E8', '#E817B4', '#B4E817', '#F38F0C', '#0CF38F',
                    //     '#8F0CF3', '#7D649B', '#9B7D64', '#649B7D', '#80857A', '#7A8085', '#857A80',
                    //     '#DF4E73', '#73DF4E', '#36B9CC', '#CC36B9', '#B9CC36', '#C96936', '#6936C9',
                    //     '#36C969', '#0CF375', '#CA2DD2', '#D2CA2D', '#2DD2CA', '#8F4FB0', '#B08F4F',
                    //     '#B4E817', '#F38F0C', '#0CF38F', '#4e73df', '#1cc88a', '#36b9cc'
                    // ],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 2,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 50,
            },
        });

        // highest sell cart
        let highestSellData = JSON.parse('<?php echo $highest_sell_data; ?>');
        var ctx = document.getElementById("highestSellChart");
        var highestSellChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: highestSellData.label,
                datasets: [{
                    data: highestSellData.data,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#B9CC36', '#CC36B9', '#B08F4F',
                        '#6936C9', '#2DD2CA', '#649B7D', '#4e0af5'
                    ],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 50,
            },
        });

    </script>
@endpush
