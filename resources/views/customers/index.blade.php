@extends('templates.master')
@section('pwd', 'Customer')
@section('pwd-title', 'Customer Data')
@section('pwd-title-link', '/customer')
@section('pwd-subtitle', 'Customer')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
{{--
<link rel="stylesheet" href="{{asset('assets/templates/css/select2.css')}}"> --}}
<link rel="stylesheet" href="{{asset('assets/templates/css/style.min.css')}}">
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
{{-- modal add data --}}
<div class="modal fade" id="modalAddData" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-primary text-white">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Add Customer
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form-customer">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="masukkan nama lengkap">
                                <div class="invalid-feedback error-name"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">No. HP</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="masukkan no. hp">
                                <div class="invalid-feedback error-phone"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="addr">Alamat</label>
                                <textarea name="address" id="address" class="form-control" rows="5"
                                    placeholder="masukkan alamat"></textarea>
                                <div class="invalid-feedback error-address"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Foto Profil</label>
                                <input type="file" class="form-control" name="image" id="image">
                                <div class="invalid-feedback error-image"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end modal --}}

{{-- modal edit --}}
<div class="modal fade" id="modalEditData" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-primary text-white">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edit Customer
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form-edit-customer">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <input type="text" name="customer_id" class="form-control" id="editCustomerId" hidden>
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" id="editName" class="form-control"
                                    placeholder="masukkan nama lengkap">
                                <div class="invalid-feedback error-edit_name"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">No. HP</label>
                                <input type="text" name="phone" id="editPhone" class="form-control"
                                    placeholder="masukkan no. hp">
                                <div class="invalid-feedback error-edit-phone"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="addr">Alamat</label>
                                <textarea name="address" id="editAddress" class="form-control" rows="5"
                                    placeholder="masukkan alamat"></textarea>
                                <div class="invalid-feedback error-edit-address"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-update">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end modal edit --}}
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/function/customer/main.js')}}"></script>
@endsection
