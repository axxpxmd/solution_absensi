@extends('layouts.app')
@section('title', '| USER')
@section('content')
<div class="container-fluid mt-3" >
    <div class="py-4">
        <a href="{{ route('user.index') }}" class="btn btn-sm btn-danger">Kembali <i class="fa fa-arrow-left m-l-8"></i></a>
        <div class="card shadow">
            <div class="card-body">
                <p class="font-weight-bold fs-14 text-black">Tambah User</p>
                <hr>
                <form action="">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="uid" class="col-form-label fs-13">UID</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" name="uid" id="uid" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="user_id" class="col-form-label fs-13">User ID</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" name="user_id" id="user_id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="name" class="col-form-label fs-13">Nama</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="password" class="col-form-label fs-13">Password</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="password" id="password" class="form-control">
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
