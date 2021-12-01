@extends('templates.master')
@section('pwd', 'Penjualan Tiket')
@section('pwd-title', 'Data Penjualan Tiket')
@section('pwd-title-link', '/admin/sale')
@section('pwd-subtitle', 'Tiket')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card">
    <div class="d-flex card-body justify-content-end">
        <button type="button" class="btn btn-primary btn-add">
            <span class="ti-plus"></span> Tambah Data
        </button>
    </div>
    <div class="dropdown-divider"></div>
    <div class="card-body data-rendered"></div>
</div>
@endsection

@section('modal')
{{-- add modal --}}
<div class="modal fade" id="modalAddData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-primary text-white">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah Data
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAddData">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="title">Tiket</label>
                        <select name="ticket_id" class="form-control" id="ticket">
                            @foreach ($tickets as $item)
                            <option value="{{$item->id}}" data-price="{{$item->price}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="3"
                            readonly>{{$ticketPrice->description}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="saleDate">Tanggal dijual</label>
                        <input type="date" name="sale_date" id="saleDate" class="form-control">
                        <div class="invalid-feedback error-sale-date"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="total">Total Tiket</label>
                        <input type="text" name="total" id="total" class="form-control" value="1"
                            placeholder="total tiket" autocomplete="off">
                        <div class="invalid-feedback error-total"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="discount">Diskon (%)</label>
                        <input type="text" name="discount" id="discount" class="form-control" value="0"
                            placeholder="diskon tiket" autocomplete="off">
                        <div class="invalid-feedback error-discount"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Total Diskon</label>
                        <input type="text" id="totalDiscount" class="form-control bg-success text-white"
                            value="{{convertToRupiah(0)}}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label>Total Harga</label>
                        <input type="text" id="totalPrice" class="form-control"
                            value="{{convertToRupiah($ticketPrice->price)}}" readonly>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-light-danger text-danger font-weight-medium waves-effect text-start"
                    data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button"
                    class="btn btn-light-success text-success font-weight-medium waves-effect text-start btn-save">
                    Simpan
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- end modal --}}

{{-- update modal --}}
<div class="modal fade" id="modalEditData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-primary text-white">
                <h4 class="modal-title" id="myLargeModalLabel"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditData">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="editTicket">Tiket</label>
                        <select name="edit_ticket_id" class="form-control" id="editTicket">
                            @foreach ($tickets as $ticket)
                            <option value="{{$ticket->id}}" data-price="{{$ticket->price}}">{{$ticket->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editDescription">Deskripsi</label>
                        <textarea name="description" id="editDescription" class="form-control" rows="3"
                            readonly>{{$ticketPrice->description}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="sale_id" id="saleId" class="form-control" hidden>
                        <label for="editSaleDate">Tanggal dijual</label>
                        <input type="date" name="sale_date" id="editSaleDate" class="form-control">
                        <div class="invalid-feedback error-edit-sale-date"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editDiscount">Diskon (%)</label>
                        <input type="text" name="discount" id="editDiscount" class="form-control"
                            placeholder="diskon tiket" autocomplete="off">
                        <div class="invalid-feedback error-edit-discount"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Total Diskon</label>
                        <input type="text" id="editTotalDiscount" class="form-control bg-success text-white"
                            value="{{convertToRupiah(0)}}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label>Total Harga</label>
                        <input type="text" id="editTotalPrice" class="form-control"
                            value="{{convertToRupiah($ticketPrice->price)}}" readonly>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-light-danger text-danger font-weight-medium waves-effect text-start"
                    data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button"
                    class="btn btn-light-success text-success font-weight-medium waves-effect text-start btn-update">
                    Simpan
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- end modal --}}
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/function/sale/main.js')}}"></script>
@endsection