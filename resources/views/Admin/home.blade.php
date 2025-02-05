@extends('adminlte::page')
@section('plugins.Chartjs', true)

@section('title', 'Painel')

@section('content_header')
    <form action="{{ route('painel.home') }}" method="GET">
        <div class="row  mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                    <label for="select" class=" col-12 col-sm-6 col-form-label text-right">Selecione uma data:</label>
                    <div class="col-12 col-sm-6">
                        <select class="form-control" id="selectData" name="selectDate" class="form-control"
                            onchange="this.form.submit()">
                            <option value="7" {{ $days == 7 ? 'selected' : '' }}>Últimos 7 dias
                            </option>
                            <option value="30" {{ $days == 30 ? 'selected' : '' }}>Últimos 30 dias
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $visitCount }}</h3>
                    <p>Acessos</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-eye"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $onlineCount }}</h3>
                    <p>Usuários Online</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-heart"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pageCount }}</h3>
                    <p>Páginas</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-sticky-note"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $usersCount }}</h3>
                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Paginas mais visitadas</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="pagePie"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sobre o sistema</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.onload = function() {
                let ctx = document.getElementById("pagePie").getContext("2d");
                window.pagePie = new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: {!! $pageLabels !!},
                        datasets: [{
                            // label: "Painel",
                            backgroundColor: ["#3c8dbc", "#f56954", "#00a65a"],
                            data: {!! $pageValues !!}
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        }
                    }
                })
            }
        </script>
    @endsection
