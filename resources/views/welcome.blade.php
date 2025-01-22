@extends('layouts.app')
@section('title', '| DASHBOARD')
@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body p-3">
            <div class="text-center">
                <p class="font-weight-bold fs-25 text-black mb-0">SELAMAT DATANG</p>
                <p class="fs-18 text-black">SOLUTION X100-c</p>
            </div>
        </div>
    </div>
    <div class="row my-4 justify-content-center">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <select class="form-control select2 bg-white" name="device_id" id="device_id">
                @foreach ($devices as $key => $i)
                    <option value="{{ $i->id }}" {{ $key == 0 ? "selected" : "-" }}>{{ $i->ip }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="font-weight-bold text-black fs-15">STATUS PERANGKAT</p>
                                @if ($status_device)
                                    <p class="text-success font-weight-bold fs-14">TERHUBUNG</p>
                                @else
                                    <p class="text-danger font-weight-bold fs-18">Terputus</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fa fa-signal" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="font-weight-bold text-black fs-15">NAMA PERANGKAT</p>
                                <p class="text-black font-weight-bold fs-14">{{ $device_name }}</p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fa fa-display" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="numbers">
                                <p class="font-weight-bold text-black fs-15">NOMOR SERI PERANGKAT</p>
                                <p class="text-black font-weight-bold fs-14">{{ $device_serial_number }}</p>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fa fa-clock fs-20 opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                        <div class="numbers">
                                <p class="font-weight-bold text-black fs-15">TEST PERANGKAT</p>
                                <a href="#" onclick="testPerangkat()" class="btn btn-sm btn-primary mb-1">HIT ME!</a>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fa fa-check fs-20 opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    function testPerangkat(){
        urlGetTotalAbsen =  "{{ route('testPerangkat') }}"
        $.get(urlGetTotalAbsen, function(data){
            console.log(data.message)
        }, 'JSON');
    }
</script>
@endpush
