@extends('layout.am_wilayahfeelayout')

@section('side0')
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
@section('side12')
    collapsed
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Data Ditolak</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.utama') }}">Home</a></li>
                <li class="breadcrumb-item active">Ditolak</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <a class="nav-link w-50 {{ Request::routeIs('admin.diajukan') ? 'active' : '' }}"
                                    id="diajukan-tab" href="{{ route('admin.datadiajukan') }}" role="tab"
                                    aria-controls="diajukan"
                                    aria-selected="{{ Request::routeIs('admin.datadiajukan') ? 'true' : 'false' }}">
                                    Diajukan <span id="diajukan-badge" class="badge bg-warning ms-1">0</span>
                                </a>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <a class="nav-link w-50 {{ Request::routeIs('data.ditolak') ? 'active' : '' }}"
                                    id="ditolak-tab" href="{{ route('data.ditolak') }}" role="tab"
                                    aria-controls="ditolak"
                                    aria-selected="{{ Request::routeIs('data.ditolak') ? 'true' : 'false' }}">
                                    Ditolak
                                </a>
                            </li>

                            <li class="nav-item flex-fill" role="presentation">
                                <a class="nav-link w-50 {{ Request::routeIs('data.disetujui') ? 'active' : '' }}"
                                    id="disetujui-tab" href="{{ route('data.disetujui') }}" role="tab"
                                    aria-controls="disetujui"
                                    aria-selected="{{ Request::routeIs('data.disetujui') ? 'true' : 'false' }}">
                                    Disetujui
                                </a>
                            </li>
                        </ul>


                        <form method="get" action="">
                            <div class="row mt-3 justify-content-center">
                                <div class="col-2 text-center">
                                    <select class="form-select" name="kode_pengajuan">
                                        <option value="">Kode Pengajuan</option>
                                        @foreach ($kode_pengajuan as $prefix)
                                            <option value="{{ $prefix }}"
                                                {{ request('kode_pengajuan') == $prefix ? 'selected' : '' }}>
                                                {{ $prefix }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-2 text-center">
                                    <select class="form-select" name="nama_mitra">
                                        <option value="">Nama Mitra</option>
                                        @foreach ($nama_mitra as $mitra)
                                            <option value="{{ $mitra->id }}"
                                                {{ request('nama_mitra') == $mitra->id ? 'selected' : '' }}>
                                                {{ $mitra->nama_mitra }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-2 text-center">
                                    <select class="form-select" name="wilayah">
                                        <option value="">Wilayah</option>
                                        @foreach ($wilayah as $w)
                                            <option value="{{ $w->id }}"
                                                {{ request('wilayah') == $w->id ? 'selected' : '' }}>
                                                {{ $w->nama_wilayah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-2 text-center">
                                    <select class="form-select" name="jenis_transaksi">
                                        <option value="">Jenis Transaksi</option>
                                        @foreach ($jenis_transaksi as $jt)
                                            <option value="{{ $jt->id }}"
                                                {{ request('jenis_transaksi') == $jt->id ? 'selected' : '' }}>
                                                {{ $jt->nama_jenis_transaksi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-2 text-center">
                                    <input type="date" class="form-control" name="tanggal"
                                        value="{{ request('tanggal') }}">
                                </div>

                                <div class="col-1 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-funnel"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
<br>

                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode Pengajuan</th>
                                        <th>Nama AM</th>
                                        <th>Nama Mitra</th>
                                        <th>Nama Wilayah</th>
                                        <th>Jenis Pajak</th>
                                        <th>Jenis Transaksi</th>
                                        <th>WAG Kordinasi Payment</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentmba->filter(fn($item) => $item->status == 1) as $key => $list)
                                        <tr>

                                            <td>{{ $list->id }}</td>
                                            <td>{{ $list->kode_pengajuan }}</td>
                                            <td>{{ $list->user->username }}</td>
                                            <td>{{ $list->mitra->nama_mitra }}</td>
                                            <td>{{ $list->wilayah->nama_wilayah }}</td>
                                            <td>{{ $list->jenis_pajak_nama }}</td>
                                            <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}</td>
                                            <td>{{ $list->wag_kordinasi_payment }}</td>
                                            <td>
                                                <span class="badge bg-danger">ditolak</span>
                                            </td>
                                            <td>
                                                <div class="col-3">
                                                    <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#Editpayment{{ $list->id }}">
                                                        <i class="bi bi-pencil-square"></i> Detail
                                                    </button>
                                                </div>
                                            </td>
                                            @include('admin.modal.detailditolak')
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </form>



                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>



    <script>
        function updateNotifDitolak() {
            var table = document.getElementById("table-ditolak");
            if (table) {
                var rowCount = table.getElementsByTagName("tr").length - 1; // Kurangi header jika ada
                var prevCount = localStorage.getItem("countDitolak");

                // Update localStorage hanya jika ada perubahan
                if (rowCount != prevCount) {
                    localStorage.setItem("countDitolak", rowCount);
                }
            }
        }

        // Jalankan fungsi setiap 2 detik untuk update otomatis
        setInterval(updateNotifDitolak, 2000);

        // Jalankan saat halaman dimuat pertama kali
        document.addEventListener("DOMContentLoaded", updateNotifDitolak);
    </script>
@endsection
