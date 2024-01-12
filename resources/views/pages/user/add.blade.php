@extends('layouts.app')
@section('title', '| USER')
@section('content')
<div class="container-fluid mt-3" >
    <div class="py-4">
        <a href="{{ route('user.index') }}" class="btn btn-sm btn-danger">Kembali <i class="fa fa-arrow-left m-l-8"></i></a>
        @include('layouts.alerts')
        <div class="card shadow">
            <div class="card-body">
                <p class="font-weight-bold fs-14 text-black">Tambah User</p>
                <hr>
                <form action="{{ route('user.store') }}" method="POST" novalidate class="needs-validation">
                    {{ method_field('POST') }}
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="uid" class="col-form-label fs-13">UID</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" name="uid" id="uid" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="user_id" class="col-form-label fs-13">User ID</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" name="user_id" id="user_id" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="name" class="col-form-label fs-13">Nama</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="password" class="col-form-label fs-13">Password</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" name="password" id="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="role" class="col-form-label fs-13">Role</label>
                        </div>
                        <div class="col-sm-4">
                            <select name="role" id="role" class="form-select" required>
                                <option value="">Pilih</option>
                                <option value="0">LEVEL_USER</option>
                                <option value="2">LEVEL_ENROLLER</option>
                                <option value="12">LEVEL_MANAGER</option>
                                <option value="14">LEVEL_SUPERMANAGER</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="card_no" class="col-form-label fs-13">Nomor Kartu Akses</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="card_no" id="card_no" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-sm btn-success">Simpan <i class="fa fa-save m-l-8"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.loading')
@endsection
@push('scripts')
<script type="text/javascript">
    let table = new DataTable('#dataTable');
</script>
@endpush
