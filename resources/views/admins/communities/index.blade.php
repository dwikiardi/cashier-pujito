@extends('templates.master')

@section('pwd', 'Masyarakat')
@section('pwd-title', 'Data masyarakat')
@section('pwd-title-link', '/admin/community')
@section('pwd-subtitle', 'Masyarakat')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-body data-rendered"></div>
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/function/community/main.js')}}"></script>
@endsection