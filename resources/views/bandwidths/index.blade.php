@extends('templates.master')
@section('pwd', 'Bandwidth')
@section('pwd-title', 'Bandwidth Data')
@section('pwd-title-link', '/bandwidth')
@section('pwd-subtitle', 'Bandwidth')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
{{--
<link rel="stylesheet" href="{{asset('assets/templates/css/select2.css')}}"> --}}
<link rel="stylesheet"
    href="{{asset('assets/templates/css/style.min.css')}}">
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
            <form action="" id="form-bandwidth">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="customerId">Nama Pelanggan</label>
                        <select name="customer_id" id="customerId" class="form-control">
                            @foreach ($customers as $cust)
                            <option value="{{$cust->id}}">{{$cust->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback error-customer"></div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="ipRadio">IP Radio</label>
                                <input type="text" name="ip_radio" id="ipRadio" class="form-control"
                                    placeholder="masukkan ip address radio">
                                <div class="invalid-feedback error-ip-radio"></div>
                            </div>
                            <div class="col-6">
                                <label for="ipAccess">IP Access</label>
                                <input type="text" name="ip_access" id="ipAccess" class="form-control"
                                    placeholder="masukkan ip access">
                                <div class="invalid-feedback error-ip-access"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="packageId">Bandwidth</label>
                                <select name="package_id" id="packageId" class="form-control">
                                    @foreach ($packages as $package)
                                    <option value="{{$package->id}}">{{$package->bandwidth}} MBps</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback error-bandwidth"></div>
                            </div>
                            <div class="col-6">
                                <label for="price">Price</label>
                                <input type="text" class="form-control price" id="price" readonly
                                    value="{{number_format($packages->first()->price,0,'.','.')}}">
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
            <form action="" id="form-edit-bandwidth">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <input type="text" name="bandwidth_id" class="form-control" id="editBandwidthId" hidden>
                        <label for="editCustomerId">Nama Pelanggan</label>
                        <select name="customer_id" id="editCustomerId" class="form-control">
                            @foreach ($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback error-edit-customer"></div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="editIpRadio">IP Radio</label>
                                <input type="text" name="ip_radio" id="editIpRadio" class="form-control"
                                    placeholder="masukkan ip address radio">
                                <div class="invalid-feedback error-edit-ip-radio"></div>
                            </div>
                            <div class="col-6">
                                <label for="editIpAccess">IP Access</label>
                                <input type="text" name="ip_access" id="editIpAccess" class="form-control"
                                    placeholder="masukkan ip access">
                                <div class="invalid-feedback error-edit-ip-access"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="editPackageId">Bandwidth</label>
                                <select name="package_id" id="editPackageId" class="form-control">
                                    @foreach ($packages as $package)
                                    <option value="{{$package->id}}">{{$package->bandwidth}} MBps</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback error-edit-bandwidth"></div>
                            </div>
                            <div class="col-6">
                                <label for="price">Price</label>
                                <input type="text" class="form-control price" id="editPrice" readonly>
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
<script src="{{asset('assets/function/bandwidth/main.js')}}"></script>
@endsection
