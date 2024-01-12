@extends('layouts.app')
@section('title', '| USER')
@section('content')
<div class="container-fluid mt-3" >
    <div class="py-4">
        <a href="#" onclick="getDataAbsenFromDevice()" class="btn btn-sm btn-warning">Perbarui Data <i class="fa fa-rotate m-l-8"></i></a>
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table data-table display nowrap table-striped" style="width:100%">
                        <thead>
                            <th width="10%" class="px-0 text-center">NO</th>
                            <th width="10%" class="px-0">UID</th>
                            <th width="10%" class="px-0">User ID</th>
                            <th width="30%" class="px-0">State</th>
                            <th width="10%" class="px-0">Timestamps</th>
                            <th width="10%" class="px-0">Type</th>
                            <th width="10%" class="px-0">Action</th>
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
                //
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center align-middle'},
            {data: 'uid', name: 'uid', className: 'align-middle'},
            {data: 'user_id', name: 'user_id', className: 'align-middle'},
            {data: 'state', name: 'state', className: 'align-middle'},
            {data: 'timestamp', name: 'timestamp', className: 'align-middle'},
            {data: 'type', name: 'type', className: 'align-middle'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center align-middle'},
        ]
    });

    getDataAbsenFromDevice();
    function getDataAbsenFromDevice(){
        urlgetDataAbsenFromDevice = "{{ route('absen.getDataAbsenFromDevice') }}"
        $.get(urlgetDataAbsenFromDevice, function(data){
            if (data.status) {
                table.api().ajax.reload();
            }
        }, 'JSON');
    }
</script>
@endpush
