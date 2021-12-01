@extends('templates.master')

@section('pwd', 'Staff')
@section('pwd-title', 'Data staff')
@section('pwd-title-link', '/manager/staff')
@section('pwd-subtitle', 'Staff')

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
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="">Nama Lengkap</label>
                                <input class="form-control" type="text" name="name" autocomplete="off" id="name" />
                                <div class="invalid-feedback error-name"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">Tempat Lahir</label>
                                <input class="form-control" type="text" name="place_of_birth" autocomplete="off"
                                    id="placeOfBirth" />
                                <div class="invalid-feedback error-place-of-birth"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">Tanggal Lahir</label>
                                <input class="form-control" type="date" name="date_of_birth" autocomplete="off"
                                    id="dateOfBirth" />
                                <div class="invalid-feedback error-date-of-birth"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">Jenis Kelamin</label>
                                <select name="gender" class="form-control">
                                    <option value="1">Laki - Laki</option>
                                    <option value="0">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">No. Hp</label>
                                <input class="form-control" type="text" name="phone" autocomplete="off" id="phone" />
                                <div class="invalid-feedback error-phone"></div>
                            </div>
                            <div class="form-group">
                                <label class="">Alamat</label>
                                <textarea class="form-control" rows="5" name="address" id="address"></textarea>
                                <div class="invalid-feedback error-address"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="">Foto</label>
                                <input class="form-control" type="file" name="image" autocomplete="off" id="image" />
                                <div class="invalid-feedback error-image"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">Email</label>
                                <input class="form-control" type="text" name="email" autocomplete="off" id="email" />
                                <div class="invalid-feedback error-email"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">Password</label>
                                <input class="form-control" type="password" name="password" autocomplete="off"
                                    id="password" />
                                <div class="invalid-feedback error-password"></div>
                            </div>
                            <div class="form-group">
                                <label class="">Konfirmasi
                                    Password</label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    autocomplete="off" id="passwordConfirmation" />
                                <div class="invalid-feedback error-password-confirmation"></div>
                            </div>
                        </div>
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
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="">Nama Lengkap</label>
                                <input class="form-control" type="text" name="admin_id" autocomplete="off"
                                    id="editAdminId" hidden />
                                <input class="form-control" type="text" name="name" autocomplete="off" id="editName" />
                                <div class="invalid-feedback error-edit-name"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">Tempat Lahir</label>
                                <input class="form-control" type="text" name="place_of_birth" autocomplete="off"
                                    id="editPlaceOfBirth" />
                                <div class="invalid-feedback error-edit-place-of-birth"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">Tanggal Lahir</label>
                                <input class="form-control" type="date" name="date_of_birth" autocomplete="off"
                                    id="editDateOfBirth" />
                                <div class="invalid-feedback error-edit-date-of-birth"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">Jenis Kelamin</label>
                                <select name="gender" class="form-control" id="editGender">
                                    <option value="1">Laki - Laki</option>
                                    <option value="0">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">No. Hp</label>
                                <input class="form-control" type="text" name="phone" autocomplete="off"
                                    id="editPhone" />
                                <div class="invalid-feedback error-edit-phone"></div>
                            </div>
                            <div class="form-group">
                                <label class="">Alamat</label>
                                <textarea class="form-control" rows="5" name="address" id="editAddress"></textarea>
                                <div class="invalid-feedback error-edit-address"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="">Foto</label>
                                <input class="form-control" type="file" name="image" autocomplete="off"
                                    id="editImage" />
                                <span class="text-muted text-small">*kosongkan jika tidak ingin mengganti foto</span>
                                <div class="invalid-feedback error-edit-image"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">Email</label>
                                <input class="form-control" type="text" name="email" autocomplete="off"
                                    id="editEmail" />
                                <div class="invalid-feedback error-edit-email"></div>
                            </div>
                        </div>
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
<script src="{{asset('assets/function/staff/main.js')}}"></script>
@endsection