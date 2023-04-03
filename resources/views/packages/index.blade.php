@extends('templates.master')
@section('pwd', 'Package')
@section('pwd-title', 'Package Data')
@section('pwd-title-link', '/package')
@section('pwd-subtitle', 'Package')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
{{--
<link rel="stylesheet" href="{{asset('assets/templates/css/select2.css')}}"> --}}
<link rel="stylesheet"
    href="https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/assets/libs/select2/dist/css/select2.min.css">
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
                    Add Package
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form-package">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control"
                                    placeholder="masukkan harga">
                                <div class="invalid-feedback error-price"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="bandwidth">Bandwidth</label>
                                <input type="text" name="bandwidth" id="bandwidth" class="form-control"
                                    placeholder="masukkan besar bandwidth">
                                <div class="invalid-feedback error-bandwidth"></div>
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
                    Edit Package
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form-edit-package">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <input type="text" name="package_id" class="form-control" id="editPackageId" hidden>
                                <label for="editPrice">Price</label>
                                <input type="text" name="price" id="editPrice" class="form-control"
                                    placeholder="masukkan harga paket">
                                <div class="invalid-feedback error-edit-price"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editBandwidth">Bandwidth</label>
                                <input type="text" name="bandwidth" id="editBandwidth" class="form-control"
                                    placeholder="masukkan besar bandwidth">
                                <div class="invalid-feedback error-edit-bandwidth"></div>
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
<script src="{{asset('assets/function/package/main.js')}}"></script>
@endsection