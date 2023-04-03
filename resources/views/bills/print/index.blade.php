@extends('templates.master')
@section('content')
<div class="card card-body printableArea">
    {{-- <h3><b>Invoice</b></h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right text-end">
                <address>
                    <h3>IT EKa Solution,</h3>
                    <p class="m-t-30">
                        <img src="{{asset('assets/uploads/media/logo/pujito.jpg')}}" height="100">
                    </p>
                    <p class="m-t-30">
                        <b>Dicetak oleh :</b>
                        <i class="fa fa-print"></i> {{username()}}
                    </p>
                    <p class="m-t-30">
                        <b>Tanggal Laporan :</b>
                        <i class="fa fa-calendar"></i> {{$date}}
                    </p>
                </address>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="table-responsive m-t-40" style="clear: both">
                <table class="table table-bordered">
                    <tbody>
                        <tr class="text-center">
                            <td>#</td>
                            <td>Deskripsi</td>
                            <td>Kuantitas</td>
                            <td>Bandwidth</td>
                            <td>Harga</td>
                            <td>Total Harga</td>
                        </tr>
                        <tr class="text-center align-middle">
                            <td>{{$bill->invoice_number}}</td>
                            <td>Paket Internet</td>
                            <td>1</td>
                            <td>{{$bill->customer->customer_bandwidth->package->bandwidth}} MBps</td>
                            <td class="text-right">
                                {{number_format($bill->customer->customer_bandwidth->package->price,0,'.','.')}}
                            </td>
                            <td class="text-right">
                                {{number_format($bill->customer->customer_bandwidth->package->price,0,'.','.')}}
                            </td>
                        </tr>
                        <tr class="text-end">
                            <td colspan="5">Sub - Total amount:</td>
                            <td><strong>
                                    Rp.{{number_format($bill->customer->customer_bandwidth->package->price,0,'.','.')}}
                                </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    <div class="row mb-5">
        <div class="col-6">
            <h2>INVOICE</h2>
        </div>
        <div class="col-6 mb-4">
            <img src="{{asset('assets/uploads/media/logo/pujito.jpg')}}" height="80">
        </div>

        <div class="col-6">
            <div>
                <strong>Tagihan Kepada</strong>
            </div>
            <div><span>{{$bill->customer->name}}</div>
            <div><span>{{$bill->customer->address}}</div>
            <div><span>{{$bill->customer->phone}}</div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    Invoice
                </div>
                <div class="col-6">
                    {{$bill->invoice_number}}
                </div>

                <div class="col-6">
                    Tanggal
                </div>
                <div class="col-6">
                    {{convertDate($bill->date)}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-5">
            <table class="table table-bordered">
                <tbody>
                    <tr class="text-center table-danger">
                        <td>#</td>
                        <td>Deskripsi</td>
                        <td>Kuantitas</td>
                        <td>Bandwidth</td>
                        <td>Harga</td>
                        <td>Total Harga</td>
                    </tr>
                    <tr class="text-center align-middle">
                        <td>1</td>
                        <td>Paket Internet</td>
                        <td>1</td>
                        <td>{{$bill->customer->customer_bandwidth->package->bandwidth}} MBps</td>
                        <td class="text-end">
                            {{number_format($bill->customer->customer_bandwidth->package->price,0,'.','.')}}
                        </td>
                        <td class="text-end">
                            {{number_format($bill->customer->customer_bandwidth->package->price,0,'.','.')}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">Total Pembayaran</td>
                        <td class="text-end">
                            <strong>
                                Rp.{{number_format($bill->customer->customer_bandwidth->package->price,0,'.','.')}}
                            </strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12"><strong>Pesan</strong></div>
        <div class="col-6">
            BCA (I Wayan Pujito Adnyana)
        </div>
        <div class="col-6">
            6690253176
        </div>

        <div class="col-6">
            OVO (I Wayan Pujito Adnyana)
        </div>
        <div class="col-6">
            085935178773
        </div>

        <div class="col-6">
            DANA (I Wayan Pujito Adnyana)
        </div>
        <div class="col-6">
            085935178773
        </div>

        <div class="col-6">
            GO-PAY (I Wayan Pujito Adnyana)
        </div>
        <div class="col-6">
            085935178773
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-8"></div>
        <div class="col-4 text-end">
            <div class="row">
                <div class="col-12">Salam hormat,</div>
                <div class="col-12">Gianyar, {{convertDate(date('Y-m-d'))}}</div>
            </div>
        </div>
    </div> --}}
</div>
@endsection