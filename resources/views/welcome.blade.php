@extends('layouts.app')
@section('title', '| DASHBOARD')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h6 class="card-header bg-success text-white font-weight-bold px-4 fs-14" style="border-top-right-radius: 15px; border-top-left-radius: 15px; padding-top: 13px; padding-bottom: 13px">Status Devices<i class="fas fa-microchip m-l-10"></i></h6>
                <div class="card-body pt-0 pb-4">
                    <table id="tableChannelBayar" class="table table-hover fs-12" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>IP</th>
                                <th>device Time</th>
                                <th>device Name</th>
                                <th>serial Number</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devices as $index => $i)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $i['ip'] }}</td>
                                    <td>{{ $i['deviceTime'] }}</td>
                                    <td>{{ $i['deviceName'] }}</td>
                                    <td>{{ $i['serialNumber'] }}</td>
                                    <td>{{ $i['ket'] }}</td>
                                    <td>
                                        @if ($i['status'] == true)
                                            <span class="badge bg-success">Online</span>
                                        @else
                                            <span class="badge bg-danger">Offline</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($i['status'] == true)
                                            <a href="#" onclick="testPerangkat({{ $i['id'] }})">
                                                <span class="badge bg-danger">Hit Me!</span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    function testPerangkat(id){
        url =  "{{ route('hitMe', ':id') }}".replace(':id', id);
        $.get(url, function(data){
            console.log(data.message)
        }, 'JSON');
    }

    $(document).ready(function () {
        $('#tableChannelBayar').DataTable({
            "scrollX": true,
            // "scrollY": 50,
            "bPaginate": false,
            "bInfo": false,
            "searching": false,
            "order": [[1, 'desc']],
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
@endpush
