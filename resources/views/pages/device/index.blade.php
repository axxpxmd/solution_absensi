@extends('layouts.app')
@section('title', '| USER')
@section('content')
<div class="container-fluid mt-3">
    <div class="py-4">
        <a href="#" onclick="add()" class="btn btn-sm btn-success">Tambah<i class="fa fa-plus m-l-8"></i></a>
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table data-table display nowrap table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10%" class="px-0 text-center">NO</th>
                                <th width="20%" class="px-0">IP</th>
                                <th width="30%" class="px-0">Keterangan</th>
                                <th width="30%" class="px-0">Status</th>
                                <th width="10%" class="px-0">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary px-3 py-3">
                <p class="fs-14 m-0 text-white">Form <span class="font-weight-bolder" id="title"></span></p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" id="form" method="POST" novalidate>
                    {{ method_field('POST') }}
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="ip" class="col-form-label fs-12">IP</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="ip" id="ip" class="form-control" placeholder="Masukan IP perangkat (DHCP)" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="keterangan" class="col-form-label fs-12">Keterangan</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea rows="3" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan Perangkat" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row" id="statusDisplay">
                        <div class="col-sm-4">
                            <label for="status" class="col-form-label fs-12">Status</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="status" name="status" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-sm btn-success fs-12 m-r-8" id="btnSave" title="Simpan Data"><i class="fa fa-pen-to-square m-r-8"></i>Simpan</button>
                            <button type="button" class="btn btn-sm btn-danger fs-12" data-bs-dismiss="modal" title="Batalkan"><i class="fa fa-xmark m-r-8"></i>Batalkan</button>
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
    var table = $('#dataTable').dataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        pageLength: 10,
        searching: true,
        language: {
            paginate: {
                next: '&#8594;', // or '→'
                previous: '&#8592;' // or '←'
            }
        },
        ajax: {
            url: "{{ route('perangkat.table') }}",
            method: 'POST',
            data: function (data) {
                // Additional data if needed
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center align-middle'},
            {data: 'ip', name: 'ip', className: 'align-middle'},
            {data: 'ket', name: 'ket', className: 'align-middle'},
            {data: 'status', name: 'status', className: 'align-middle'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center align-middle'},
        ]
    });

    add();
    function add(){
        save_method = "add";
        $('#title').html('Tambah Perangkat');
        $('#modalAdd').modal('show');
        $('#statusDisplay').hide();
        $('#form').trigger('reset');
    }

    $('#form').on('submit', function (e) {
        e.preventDefault();
        if (this.checkValidity() === false) {
            e.stopPropagation();
        } else {
            $('#alert').html('');
            $('#btnSave').attr('disabled', true);
            let url = (save_method === 'add') ? "{{ route('perangkat.store') }}" : "{{ route('perangkat.update', ':id') }}".replace(':id', $('#id').val());
            $.post(url, $(this).serialize(), function(data) {
                $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                table.api().ajax.reload();
                if (save_method === 'add') add();
                $('#form').removeClass('was-validated');
            }, "JSON").fail(function(data) {
                let err = '';
                let respon = data.responseJSON;
                $.each(respon.errors, function(index, value) {
                    err += "<li>" + value + "</li>";
                });
                $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
            }).always(function() {
                $('#btnSave').removeAttr('disabled');
            });
        }
        $(this).addClass('was-validated');
    });
</script>
@endpush
