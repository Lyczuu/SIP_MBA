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
                    <li class="breadcrumb-item"><a href="{{route('admin.utama')}}">Home</a></li>
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
                            <br>




                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table id="table-ditolak" class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Kode Pengajuan</th>
                                            <th>Nama Am</th>
                                            <th>Nama mitra</th>
                                            <th>Nama wilayah</th>
                                            <th>Jenis pajak</th>
                                            <th>Nama Jenis transaksi</th>
                                            <th>Wag kordinasi payment</th>
                                            <th>Status</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paymentmba->filter(function ($item) {
                                                 return $item->status == 1; // Hanya filter berdasarkan status = 1
                                           }) as $key => $list)
                                            <tr>
                                                <td> {{ $list->kode_pengajuan }}</td>
                                                <td> {{ $list->user->username }}</td>
                                                <td> {{ $list->mitra->nama_mitra }}</td>
                                                <td> {{ $list->wilayah->nama_wilayah }}</td>
                                                <td> {{ $list->jenis_pajak_nama }}</td>
                                                <td> {{ $list->jenis_transaksi->nama_jenis_transaksi }}</td>
                                                <td> {{ $list->wag_kordinasi_payment }}</td>
                                                 <td>
                                                    @if ($list->status == 1)
                                                       <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#Editpayment{{ $list->id }}">
                                                            <i class="bi bi-pencil-square"></i> Detail
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('admin2.modal.detailditolak')
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>
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
