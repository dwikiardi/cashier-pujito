@extends('templates.master')
@section('pwd', 'Dashboard')
@section('pwd-title', 'Home')
@section('pwd-title-link', '/dashboard')
@section('pwd-subtitle', 'Dashboard')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h4 class="card-title">Informasi Umum</h4>
                    </div>
                </div>
            </div>
            <div class="earnings-month mt-1 text-center" style="min-height: 75px;">
                <img src="{{asset(auth()->user()->image)}}" class="rounded-3 img-fluid" width="90">
                <div class="mt-n2 border-bottom">
                    <span class="badge bg-danger">{{auth()->user()->role->name}}</span>
                    <h3 class="card-title mt-3">{{username()}}</h3>
                    <h6 class="card-subtitle">Sistem Informasi Eksekutif Desa Ceking</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row pb-3 border-bottom">
                    <div class="col-3 col-xl-2">
                        <div class="bg-light-primary text-primary text-center py-2 rounded-3">
                            <i class="mdi mdi-ticket display-8"></i>
                        </div>
                    </div>
                    <div class="col-9 col-xl-10 d-flex align-items-center">
                        <div>
                            <h5 class="card-title mb-1">Total Tiket Terjual</h5>
                            <p class="text-muted mb-0">
                                {{globalTicketSold()}} Tiket
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-3 col-xl-2">
                        <div class="bg-light-danger text-danger text-center py-2 rounded-3">
                            <i class="mdi mdi-percent display-8"></i>
                        </div>
                    </div>
                    <div class="col-9 col-xl-10 d-flex align-items-center">
                        <div>
                            <h5 class="card-title mb-1">Diskon</h5>
                            <p class="text-muted mb-0">
                                {{globalDiscount()}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-3 col-xl-2">
                        <div class="bg-light-info text-info text-center py-2 rounded-3">
                            <i class="mdi mdi-percent display-8"></i>
                        </div>
                    </div>
                    <div class="col-9 col-xl-10 d-flex align-items-center">
                        <div>
                            <h5 class="card-title mb-1">Pendapatan Sebelum Diskon</h5>
                            <p class="text-muted mb-0">{{globalBeforeDiscount()}}</p>
                        </div>
                    </div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-3 col-xl-2">
                        <div class="bg-light-success text-bg-light-success text-center py-2 rounded-3">
                            <i class="mdi mdi-cash-usd display-8"></i>
                        </div>
                    </div>
                    <div class="col-9 col-xl-10 d-flex align-items-center">
                        <div>
                            <h5 class="card-title mb-1">Pendapatan Bersih</h5>
                            <p class="text-muted mb-0">{{globalNetto()}}</p>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-3 col-xl-2">
                        <div class="bg-light-info text-bg-light-info text-center py-2 rounded-3">
                            <i class="mdi mdi-filter-outline display-8"></i>
                        </div>
                    </div>
                    <div class="col-9 col-xl-10">
                        <div class="row">
                            <h5 class="card-title mb-1">Filter Pencarian</h5>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="month">Bulan</label>
                                    <select name="month" id="month" class="form-control">
                                        @foreach ($month as $key => $month)
                                        <option value="{{$key+1}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="year">Tahun</label>
                                    <select name="year" id="year" class="form-control">
                                        @for ($i = 21; $i < 50; $i++) <option value="{{'20' . $i}}">20{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h4 class="card-title">Grafik Pembelian Tiket dan Pendapatan</h4>
                        {{-- <h6 class="card-subtitle">65,450 sales</h6> --}}
                    </div>
                    <div class="ms-auto export-menu">
                        <div class="dropdown">
                            <a href="#" class="link" id="new" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-more-horizontal feather-sm">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="new" style="">
                                <li class="export">
                                    {{-- <a class="dropdown-item" href="#">
                                        <span class="mdi mdi-printer-3d"></span> Export Table
                                    </a> --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body chart" style="position: relative;">
                {{-- cart --}}
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset('assets/function/print/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
<script>
    function getChart() {
        $.ajax({
            type: "GET",
            url: "{{route('chart')}}",
            success: function (response) {
                $('.chart').html(response.data)
            },
            error: function (error) {
                console.log(error)
            }
        });
    }
    $(document).ready(function () {
        getChart();
    });
</script>
@endsection