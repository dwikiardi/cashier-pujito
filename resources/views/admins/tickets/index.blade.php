@extends('templates.master')
@section('pwd', 'Tiket')
@section('pwd-title', 'Data Tiket')
@section('pwd-title-link', '/admin/ticket')
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
                        <label for="title">Nama Tiket</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="nama tiket">
                        <div class="invalid-feedback error-title"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Harga Tiket</label>
                        <input type="text" name="price" id="price" class="form-control" placeholder="harga tiket">
                        <div class="invalid-feedback error-price"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="5"
                            placeholder="deskripsi tiket"></textarea>
                        <div class="invalid-feedback error-description"></div>
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
                        <label for="editTitle">Nama Tiket</label>
                        <input type="text" name="ticket_id" id="ticketId" class="form-control" hidden>
                        <input type="text" name="title" id="editTitle" class="form-control" placeholder="nama tiket">
                        <div class="invalid-feedback error-edit-title"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editPrice">Harga Tiket</label>
                        <input type="text" name="price" id="editPrice" class="form-control" placeholder="harga tiket">
                        <div class="invalid-feedback error-edit-price"></div>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Deskripsi</label>
                        <textarea name="description" id="editDescription" class="form-control" rows="5"
                            placeholder="deskripsi tiket"></textarea>
                        <div class="invalid-feedback error-edit-description"></div>
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
<script src="{{asset('assets/function/ticket/main.js')}}"></script>
@endsection