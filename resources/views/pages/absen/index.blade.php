@extends('layouts.app')
@section('title', '| USER')
@section('content')
<div class="container-fluid mt-3" >
    <div class="py-4">
        <a href="#" onclick="getDataAbsenFromDevice()" class="btn btn-sm btn-warning">Tarik Data <i class="fa fa-rotate m-l-8"></i></a>
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 mb-5-m px-1">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-2 mb-5-m px-1 ">
                        <input type="text" class="form-control" placeholder="Nama Pegawai " id="nama_pegawai" placeholder="" name="nama_pegawai">
                    </div>
                    <div class="col-md-1 mb-5-m px-1">
                        <select class="form-control select2" name="type" id="type">
                            <option value="">Semua</option>
                            <option value="0">Masuk</option>
                            <option value="1">Pulang</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-5-m px-1 text-center-m">
                        <button type="submit" class="btn btn-primary m-l-5 m-r-10 fs-12" onclick="pressOnChange()"><i class="fa fa-search m-r-8"></i>Cari</button>
                        <a href="#" id="urlCetakAbsen" target="blank" class="btn btn-success fs-12"><i class="fa fa-download"></i></a>
                    </div>
                </div>
                <hr class="m-0">
                <div class="table-responsive">
                    <table id="dataTable" class="table data-table display nowrap table-striped" style="width:100%">
                        <thead>
                            {{-- <th width="10%" class="px-0 text-center">NO</th> --}}
                            <th width="10%" class="px-0">UID</th>
                            <th width="40%" class="px-0">Name</th>
                            <th width="10%" class="px-0">State</th>
                            <th width="10%" class="px-0">Type</th>
                            <th width="10%" class="px-0">Timestamps</th>
                            {{-- <th width="10%" class="px-0">Action</th> --}}
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.loading')
@endsection
@push('scripts')
<script type="text/javascript">
    var table = $('#dataTable').dataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        pageLength: 10,
        searching: true,
        language: {
            paginate: {
                next: '&#8594;', // or '→'
                previous: '&#8592;' // or '←'
            }
        },
        ajax: {
            url: "{{ route('absen.table') }}",
            method: 'POST',
            data: function (data) {
                data.tanggal = $('#tanggal').val();
                data.type = $('#type').val();
                data.nama_pegawai = $('#nama_pegawai').val();
            }
        },
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center align-middle'},
            {data: 'uid', name: 'uid', className: 'align-middle'},
            {data: 'user_id', name: 'user_id', className: 'align-middle'},
            {data: 'state', name: 'state', className: 'align-middle'},
            {data: 'type', name: 'type', className: 'align-middle'},
            {data: 'timestamp', name: 'timestamp', className: 'align-middle'},
            // {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center align-middle'},
        ]
    });

    function getDataAbsenFromDevice(){
        urlgetDataAbsenFromDevice = "{{ route('absen.getDataAbsenFromDevice') }}"
        $.get(urlgetDataAbsenFromDevice, function(data){
            if (data.status) {
                table.api().ajax.reload();
            }
        }, 'JSON');
    }

    pressOnChange();
    function pressOnChange(){
        table.api().ajax.reload();
    }
</script>
@endpush
