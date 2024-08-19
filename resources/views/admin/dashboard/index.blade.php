@extends('admin.layouts.app')

@section('breadcrumb', 'Dashboard')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row col mb-3">
            <div class="row col d-flex justify-content-between">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-grow-1 flex-column">
                                    <h5 class="card-title">Total Users</h5>
                                    <h3 class="card-text">{{ $totalUsers }}</h3>
                                </div>
                                <div class="d-flex justify-content-end align-items-end mt-auto">
                                    <i class="fas fa-users fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-grow-1 flex-column">
                                    <h5 class="card-title">Active Tests</h5>
                                    <h3 class="card-text">{{ $activeTests }}</h3>
                                </div>
                                <div class="d-flex justify-content-end align-items-end mt-auto">
                                    <i class="fas fa-file-alt fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-grow-1 flex-column">
                                    <h5 class="card-title">Universities</h5>
                                    <h3 class="card-text">{{ $totalUniversities }}</h3>
                                </div>
                                <div class="d-flex justify-content-end align-items-end mt-auto">
                                    <i class="fas fa-university fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-grow-1 flex-column">
                                    <h5 class="card-title">Majors</h5>
                                    <h3 class="card-text">{{ $totalMajors }}</h3>
                                </div>
                                <div class="d-flex justify-content-end align-items-end mt-auto">
                                    <i class="fas fa-book fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area mr-1"></i>
                        User Visits
                    </div>
                    <div class="card-body"><canvas id="userVisitsChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie mr-1"></i>
                        User Types
                    </div>
                    <div class="card-body"><canvas id="userTypesChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById("userVisitsChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($visitData['labels']),
                datasets: [{
                    label: "User Visits",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: @json($visitData['values']),
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 100,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });

        var ctx = document.getElementById("userTypesChart");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($userTypeData['labels']),
                datasets: [{
                    data: @json($userTypeData['values']),
                    backgroundColor: ['#007bff', '#dc3545', '#ffc107'],
                }],
            },
        });
    </script>
@endsection
