@extends('templates.master')
@section('content')
<div class="card card-body printableArea">
    <h3><b>Laporan Pengunjung</b></h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
            {{-- <div class="pull-left">
                <address>
                    <h3>
                        &nbsp;<b class="text-danger">Material Pro Admin</b>
                    </h3>
                    <p class="text-muted m-l-5">
                        E 104, Dharti-2, <br>
                        Nr' Viswakarma Temple, <br>
                        Talaja Road, <br>
                        Bhavnagar - 364002
                    </p>
                </address>
            </div> --}}
            <div class="pull-right text-end">
                <address>
                    <h3>Desa Ceking Tegallalang,</h3>
                    <p class="m-t-30">
                        <img src="{{asset('assets/uploads/media/logo/logo_desa.png')}}" height="100">
                    </p>
                    <p class="m-t-30">
                        <b>Dicetak oleh :</b>
                        <i class="fa fa-calendar"></i> {{username()}}
                    </p>
                    <p class="m-t-30">
                        <b>Tanggal Laporan :</b>
                        <i class="fa fa-calendar"></i> {{convertDate($date.'-01')}} - {{convertDate($date.'-31')}}
                    </p>
                </address>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="table-responsive m-t-40" style="clear: both">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Penjualan</th>
                            <th>Diskon (%)</th>
                            <th>Harga Tiket</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{convertDate($ticket->sale_date)}}</td>
                            <td>{{$ticket->discount}} %</td>
                            <td class="text-end">{{convertToRupiah($ticket->ticket->price)}}</td>
                            <td class="text-end">{{convertToRupiah($ticket->ticket->price - ($ticket->ticket->price *
                                ($ticket->discount/100)) )}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="pull-right m-t-30 text-end">
                    <p>Sub - Total amount: {{saleByMonth($date)}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection