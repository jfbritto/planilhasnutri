@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'PlanilhasNUTRI')

@section('content_header')
    <h1 class="d-none d-md-block"><i class="fas fa-house"></i> &nbsp;Home</h1>
    <h3 class="d-block d-sm-block d-md-none"><i class="fas fa-house"></i> &nbsp;Home</h3>
@stop

@section('content')

@if(!auth()->user()->id_unit)

<div class="row" id="listaPendencias">
    <div class="col-6">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Royal Tulip Brasília</span>
                <span class="info-box-text">Cadastrou <b>23</b> planilhas essa semana</span>
                <span class="info-box-number"><a href="/unidades" class="" style="color: black">Conferir <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Golden Tulip Gravatá</span>
                <span class="info-box-text">Cadastrou <b>18</b> planilhas essa semana</span>
                <span class="info-box-number"><a href="/unidades" class="" style="color: black">Conferir <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
</div>

@else

<div class="row mt-5 text-center">
    <div class="col-12">
        <i class="fa-solid fa-gear fa-bounce fa-2xl"></i>
        <p class="mt-4">Em construção</p>
    </div>
</div>

@endif

{{-- <div class="card">
    <div class="card-header">
        Gráfico
    </div>
    <div class="card-body">
        <canvas id="myChart" width="400" height="100"></canvas>
    </div>
</div> --}}

@stop

@section('js')
    <script src="/js/home.js"></script>
@stop
