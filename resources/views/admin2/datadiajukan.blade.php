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
        <h1>Data Diajukan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.utama') }}">Home</a></li>
                <li class="breadcrumb-item active">Diajukan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <!-- Modal -->
    <!-- Modal -->
    @if (Session::has('status'))
        <div id="flash-message" class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <script>
        // Hilangkan flash message setelah 3 detik (3000 ms)
        setTimeout(() => {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.transition = 'opacity 0.5s ease';
                flashMessage.style.opacity = '0';
                setTimeout(() => flashMessage.remove(), 500); // Hapus dari DOM setelah fade-out
            }
        }, 3000); // Ubah angka ini untuk durasi yang berbeda
    </script>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <a class="nav-link w-50 {{ Request::routeIs('admin.datadiajukan') ? 'active' : '' }}"
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
                        <!-- Table with stripped rows -->


                        <!-- Tabel Data -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode Pengajuan</th>
                                        <th>
                                            Nama AM
                                        </th>
                                        <th>Nama mitra</th>
                                        <th>Nama wilayah</th>
                                        <th>Jenis pajak</th>
                                        <th>Jenis transaksi</th>
                                        <th>Wag kordinasi payment</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentmba->filter(function ($item) {
            return $item->status == 0;
        }) as $key => $list)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $list->kode_pengajuan }}</td>
                                            <td>{{ $list->user->username }}</td>
                                            <td>{{ $list->mitra->nama_mitra }}</td>
                                            <td>{{ $list->wilayah->nama_wilayah }}</td>
                                            <td>{{ $list->jenis_pajak_nama }}</td>
                                            <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}</td>
                                            <td>{{ $list->wag_kordinasi_payment }}</td>
                                            <td>
                                                @if ($list->status == 0)
                                                    <span class="badge bg-warning">Diajukan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="col-3">
                                                    <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#Editpayment{{ $list->id }}">
                                                        <i class="bi bi-pencil-square"></i> Detail
                                                    </button>
                                                </div>
                                            </td>
                                            @include('admin2.modal.edit_detailpayment')
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <!-- End Table with stripped rows -->

                        </div>

                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('select, input[type="date"]').change(function() {
                $(this).closest('form').submit();
            });
        });
    </script>
@endsection
