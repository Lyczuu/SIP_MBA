@extends('layout.am_wilayahfeelayout')

@section('side1')
    collapsed
@endsection
@section('side2')
    collapsed
@endsection
@section('side3')
    collapsed
@endsection
@section('side4')
    collapsed
@endsection
@section('side5')
    collapsed
@endsection
@section('side6')
    collapsed
@endsection
@section('side7')
    collapsed
@endsection
@section('side8')
    collapsed
@endsection
@section('side9')
    collapsed
@endsection
@section('side10')
    collapsed
@endsection
@section('side11')
    collapsed
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index.index0') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">


                <section class="section dashboard">

                    <div class="row">
                        <!-- fee based Card -->
                        <div class="col-xxl-4 col-xl-6">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Integrasi Mitra Feebased </span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="ps-3">
                                            <span class="badge bg-warning"
                                                onclick="window.location.href='/feeabelumvalidasi'"
                                                style="cursor: pointer;">Belum Validasi</span> </td> |<td> <span id="not-belumvalidasi"
                                                    class="badge bg-warning" onclick="window.location.href='/feeabelumvalidasi'"
                                                    style="cursor: pointer;">0</span></td>
                                            | <td> <span class="badge bg-success"
                                                    onclick="window.location.href='/feeaditerima'"
                                                    style="cursor: pointer;">Diterima</span> </td> | <td> <span id="not-diterima"
                                                    class="badge bg-success" onclick="window.location.href='/feeaditerima'"
                                                    style="cursor: pointer;">0</span></td>
                                            |<td> <span class="badge bg-danger"
                                                    onclick="window.location.href='/feeaditolak'"
                                                    style="cursor: pointer;">Ditolak</span></td> |<td> <span id="not-ditolak"
                                                    class="badge bg-danger" onclick="window.location.href='/feeaditolak'"
                                                    style="cursor: pointer;">0</span></td>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-xl-6">

                            <div class="card info-card customers-card">


                                <div class="card-body">
                                    <h5 class="card-title">Integrasi Mitra Non Feebased </span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="ps-3">
                                            <span class="badge bg-warning"
                                                onclick="window.location.href='/nofeeabelumvalidasi'"
                                                style="cursor: pointer;">Belum Validasi</span> </td> |<td> <span id="notif-belumvalidasi"
                                                    class="badge bg-warning" onclick="window.location.href='nofeeabelumvalidasi'"
                                                    style="cursor: pointer;">0</span></td>
                                            | <td> <span class="badge bg-success"
                                                    onclick="window.location.href='/nofeeaditerima'"
                                                    style="cursor: pointer;">Diterima</span> </td> | <td> <span id="notif-diterima"
                                                    class="badge bg-success" onclick="window.location.href='/nofeeaditerima'"
                                                    style="cursor: pointer;">0</span></td>
                                            |<td> <span class="badge bg-danger"
                                                    onclick="window.location.href='/nofeeaditolak'"
                                                    style="cursor: pointer;">Ditolak</span></td> |<td> <span id="notif-ditolak"
                                                    class="badge bg-danger" onclick="window.location.href='/nofeeaditolak'"
                                                    style="cursor: pointer;">0</span></td>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @foreach ($totalpengajuanPerAM as $data)
                            <div class="col-xxl-4 col-md-4">
                                <div class="card info-card sales-card">
                                    {{-- <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div> --}}

                                    <div class="card-body">
                                        @if ($data->am_id == 2)
                                            <h5 class="card-title">AM Wilayah 1</h5>
                                        @elseif ($data->am_id == 3)
                                            <h5 class="card-title">AM Wilayah 2</h5>
                                        @elseif ($data->am_id == 4)
                                            <h5 class="card-title">AM Wilayah 3</h5>
                                        @elseif ($data->am_id == 5)
                                            <h5 class="card-title">AM Wilayah 4</h5>
                                        @elseif ($data->am_id == 6)
                                            <h5 class="card-title">AM Kerja Sama</h5>
                                        @endif

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-graph-up"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $data->total_pengajuan }}</h6>
                                                <span class="text-success small pt-1 fw-bold">8%</span>
                                                <span class="text-muted small pt-2 ps-1">increase</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">


                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Terakhir <span>| Diajukan</span></h5>

                                        <!-- Table with stripped rows -->
                                        <div class="table-responsive">
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Kode Pengajuan</th>
                                                        <th scope="col">Mitra</th>
                                                        <th scope="col">Wilayah</th>
                                                        <th scope="col">Jenis Pajak</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($paymentmba as $key => $list)
                                                        <th scope="row"><a
                                                                href="#">{{ $list->kode_pengajuan }}</a></th>
                                                        <td>{{ $list->mitra->nama_mitra }}</td>
                                                        <td>{{ $list->wilayah->nama_wilayah }}</td>
                                                        <td>{{ $list->jenis_pajak_nama }}</td>
                                                        <td>
                                                            @if ($list->status == 0)
                                                                <span class="badge bg-warning">Diajukan</span>
                                                            @elseif ($list->status == 1)
                                                                <span class="badge bg-danger"> Ditolak </span>
                                                            @elseif ($list->status == 2)
                                                                <span class="badge bg-success"> Diterima </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#Editpayment{{ $list->id }}">
                                                                    <i class="bi bi-pencil-square"></i> Detail
                                                                </button>
                                                            </div>
                                                        </td>
                                                        </tr>
                                                        @include('admin2.modal.detailpayment')
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <!-- End Table with stripped rows -->

                                        </div>
                                    </div>
                                    {{-- end card div --}}

                                </div>
                            </div>
                        </div>


                </section>
    </section>
@endsection
