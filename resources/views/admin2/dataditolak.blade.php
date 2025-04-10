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




                            <form id="exportForm" method="POST" action="{{ route('payment.exportAdmindetail') }}">
                                @csrf

                                <!-- Tombol Cetak Excel -->
                                <button type="submit" class="btn btn-primary">Cetak Excel</button>

                                <div class="table-responsive mt-3">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" id="selectAll">
                                                    <label for="selectAll">Select All</label>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>ID</th>
                                                <th>Kode Pengajuan</th>
                                                <th>Nama AM</th>
                                                <th>Nama Mitra</th>
                                                <th>Wilayah</th>
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
                                                    <td><input type="checkbox" name="ids[]" value="{{ $list->id }}"></td>
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

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    // Select All Checkbox
                                    document.getElementById('selectAll').addEventListener('change', function () {
                                        let checkboxes = document.querySelectorAll('input[name="ids[]"]');
                                        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                                    });

                                    // Modal Log (opsional, bisa dihapus kalau tidak butuh log modal)
                                    document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(button => {
                                        button.addEventListener('click', function (event) {
                                            event.preventDefault();
                                            let modalId = this.getAttribute('data-bs-target');
                                            console.log("Opening modal:", modalId);
                                        });
                                    });
                                });
                            </script>

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
