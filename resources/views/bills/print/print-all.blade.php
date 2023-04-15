@extends('templates.master')
@section('content')
    @foreach ($bill as $key => $pAll)
    <div class="card card-body printableArea">
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
                <div><span>{{$pAll->customer->name}}</div>
                <div><span>{{$pAll->customer->address}}</div>
                <div><span>{{$pAll->customer->phone}}</div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        Invoice
                    </div>
                    <div class="col-6">
                        {{$pAll->invoice_number}}
                    </div>

                    <div class="col-6">
                        Tanggal
                    </div>
                    <div class="col-6">
                        {{convertDate($pAll->date)}}
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
                            <td>{{$pAll->customer->customer_bandwidth->package->bandwidth}} MBps</td>
                            <td class="text-end">
                                {{number_format($pAll->customer->customer_bandwidth->package->price,0,'.','.')}}
                            </td>
                            <td class="text-end">
                                {{number_format($pAll->customer->customer_bandwidth->package->price,0,'.','.')}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center">Total Pembayaran</td>
                            <td class="text-end">
                                <strong>
                                    Rp.{{number_format($pAll->customer->customer_bandwidth->package->price,0,'.','.')}}
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
        <p style="page-break-after: always;">&nbsp;</p>
    </div>
    @endforeach
@endsection
