@extends('layouts.app')
@section('title', '| USER')
@section('content')
<div class="container-fluid mt-3" >
    <div class="py-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table data-table display nowrap table-striped" style="width:100%">
                        <thead>
                            <th width="10%" class="px-0 text-center">NO</th>
                            <th width="10%" class="px-0">UID</th>
                            <th width="10%" class="px-0">User ID</th>
                            <th width="40%" class="px-0">Name</th>
                            <th width="10%" class="px-0">Role</th>
                            <th width="10%" class="px-0">Password</th>
                            <th width="10%" class="px-0">Card No</th>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key => $i)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td>{{ $i['uid'] }}</td>
                                    <td>{{ $i['userid'] }}</td>
                                    <td>{{ $i['name'] }}</td>
                                    <td>{{ $i['role'] }}</td>
                                    <td>{{ $i['password'] }}</td>
                                    <td>{{ $i['cardno'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
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
    let table = new DataTable('#dataTable');
</script>
@endpush
