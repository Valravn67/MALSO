@extends('layout')
@section('title', 'Beranda')

@section('css')

@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Rekap Harian</h3>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">820</span>
                  <span>Visitors Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success"> <i class="fas fa-arrow-up"></i> 12.5% </span>
                  <span class="text-muted">Since last week</span>
                </p>
              </div>
        
              <div class="position-relative mb-4">
                <canvas id="visitors-chart" height="200"></canvas>
              </div>
              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2"> <i class="fas fa-square text-primary"></i> Stock Material's </span>
                <span> <i class="fas fa-square text-gray"></i> Out Material's </span>
              </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Rekap Bulanan</h3>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">$18,230.00</span>
                  <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success"> <i class="fas fa-arrow-up"></i> 33.1% </span>
                  <span class="text-muted">Since last month</span>
                </p>
              </div>

              <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
              </div>
              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2"> <i class="fas fa-square text-primary"></i> Stock Material's </span>
                <span> <i class="fas fa-square text-gray"></i> Out Material's </span>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

@section('js')
<script src="/plugins/chart.js/Chart.min.js"></script>
<script src="/dist/js/adminlte.js?v=3.2.0"></script>
<script src="/dist/js/pages/dashboard3.js"></script>
@endsection