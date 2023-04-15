@extends('templates.master')
@section('pwd', 'Dashboard')
@section('pwd-title', 'Home')
@section('pwd-title-link', '/dashboard')
@section('pwd-subtitle', 'Dashboard')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
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
                <img src="{{asset('assets/uploads/media/users/blank.png')}}" class="rounded-3 img-fluid" width="90">
                <div class="mt-n2 border-bottom">
                    {{-- <span class="badge bg-danger">{{auth()->user()->}}</span> --}}
                    <h3 class="card-title mt-3">{{username()}}</h3>
                    <h6 class="card-subtitle">IT Eka Solution</h6>
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
                            <h5 class="card-title mb-1">Total Transaksi</h5>
                            <p class="text-muted mb-0 total-transaction"></p>
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
                            <h5 class="card-title mb-1">Pembayaran Sukses</h5>
                            <p class="text-muted mb-0 transaction-success"></p>
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
                            <form id="formBill">
                                <div class="row">
                                    <h5 class="card-title mb-1">Filter Pencarian</h5>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="month">Bulan</label>
                                            <select name="month" id="month" class="form-control">
                                                @foreach ($month as $key => $mm)
                                                <option value="{{$key+1}}">{{$mm}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="year">Tahun</label>
                                            <select name="year" id="year" class="form-control">
                                                @for ($i = 21; $i < 50; $i++) <option value="{{'20' . $i}}">20{{$i}}
                                                    </option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="d-flex card-header align-items-center px-3">
                <div class="flex-grow-1">
                  <h4 class="card-title">Data Pembayaran</h4>
                </div>
                <div class="px-3">
                    <button class="ms-auto btn btn-sm btn-success btn-printAll" id="#printAll">
                        Print all
                    </button>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" id="checkAll" class="form-check-input" name="inputCheckboxesRecieve[]">
                    <label for="inputRecieve" class="form-check-label font-weight-medium">
                      <span>Check All</span>
                    </label>
                </div>
              </div>
            <div class="card-body table-render" style="position: relative;"></div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset('assets/function/bill/print.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/function/bill/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
@endsection
