@extends('layout.am_wilayahfeelayout')

@section('side0', 'active')
@section('side1', 'collapsed')
@section('side3', 'collapsed')
@section('side10', 'collapsed')
@section('side4', 'collapsed')
@section('side6', 'collapsed')
@section('side7', 'collapsed')
@section('side8', 'collapsed')
@section('side5', 'collapsed')
@section('side11', 'collapsed')
@section('content')
    <div class="container mt-4">

        {{-- Jika ada pesan status --}}
        @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">

            <meta content="" name="description">
            <meta content="" name="keywords">

            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        </head>

        <body>

            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
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
                                                        onclick="window.location.href='/feebelumvalidasi'"
                                                        style="cursor: pointer;">Diajaukan</span> </td> |<td> <span
                                                            id="nott-belumvalidasi" class="badge bg-warning"
                                                            onclick="window.location.href='/feebelumvalidasi'"
                                                            style="cursor: pointer;">0</span></td>
                                                    | <td> <span class="badge bg-success"
                                                            onclick="window.location.href='/feediterima'"
                                                            style="cursor: pointer;">Disetujui</span> </td> | <td> <span
                                                            id="nott-diterima" class="badge bg-success"
                                                            onclick="window.location.href='/feediterima'"
                                                            style="cursor: pointer;">0</span></td>
                                                    |<td> <span class="badge bg-danger"
                                                            onclick="window.location.href='/feeditolak'"
                                                            style="cursor: pointer;">Ditolak</span></td> |<td> <span
                                                            id="nott-ditolak" class="badge bg-danger"
                                                            onclick="window.location.href='/feeditolak'"
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
                                                        onclick="window.location.href='/nofeebelumvalidasi'"
                                                        style="cursor: pointer;">Diajukan</span> </td> |<td> <span
                                                            id="noti-belumvalidasi" class="badge bg-warning"
                                                            onclick="window.location.href='/nofeebelumvalidasi'"
                                                            style="cursor: pointer;">0</span></td>
                                                    | <td> <span class="badge bg-success"
                                                            onclick="window.location.href='/nofeediterima'"
                                                            style="cursor: pointer;">Disetujui</span> </td> | <td> <span
                                                            id="noti-diterima" class="badge bg-success"
                                                            onclick="window.location.href='/nofeediterima'"
                                                            style="cursor: pointer;">0</span></td>
                                                    |<td> <span class="badge bg-danger"
                                                            onclick="window.location.href='/nofeeditolak'"
                                                            style="cursor: pointer;">Ditolak</span></td> |<td> <span
                                                            id="noti-ditolak" class="badge bg-danger"
                                                            onclick="window.location.href='/nofeeditolak'"
                                                            style="cursor: pointer;">0</span></td>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Sales Card -->
                                <div class="col-xxl-4 col-md-4">
                                    <div class="card info-card sales-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Jumlah Pengajuan</h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-graph-up"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $totalpengajuan }}</h6>
                                                    <span class="text-muted small pt-2 ps-1 fw-bold">Jumlah Pengajuan</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- End Sales Card -->



                                @if ($totalMitraAgg > 0)
                                <div class="col-xxl-4 col-md-4">
                                    <div class="card info-card sales-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Jumlah Kerja Sama</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-graph-up"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h2>{{ $totalMitraAgg }}</h2>
                                                    <span class="text-muted small pt-1 fw-bold">Jumlah Kerja Sama</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Revenue Card -->
                            @endif





                                <!-- Recent Sales -->
                                <div class="col-12">
                                    <div class="card recent-sales overflow-auto">

                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                    class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>

                                                <li><a class="dropdown-item" href="#">Today</a></li>
                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                            </ul>
                                        </div>



                                        <div class="card">
                                            <div class="card-body">

                                                <h5 class="card-title">Terakhir <span>| Diajukan</span></h5>


                                                <!-- Table with stripped rows -->
                                                <div class="table-responsive">
                                                    <table id="mken" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Kode Pengajuan</th>
                                                                <th>Nama</th>
                                                                <th>Nama mitra</th>
                                                                <th>Nama wilayah</th>
                                                                <th>Jenis pajak</th>
                                                                <th>Nama Jenis transaksi</th>
                                                                <th>Wag kordinasi payment</th>
                                                                <th>Status</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                            <tr id="filterRow">
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($paymentmba as $key => $list)
                                                                <tr>
                                                                    <td>{{ $list->kode_pengajuan }}</td>
                                                                    <td>{{ $list->user->username }}</td>
                                                                    <td>{{ $list->mitra->nama_mitra }}</td>
                                                                    <td>{{ $list->wilayah->nama_wilayah }}</td>
                                                                    <td>{{ $list->jenis_pajak_nama }}</td>
                                                                    <td>{{ $list->jenis_transaksi->nama_jenis_transaksi }}
                                                                    </td>
                                                                    <td>{{ $list->wag_kordinasi_payment }}</td>
                                                                    <td>
                                                                        @if ($list->status == 0)
                                                                            <span class="badge bg-warning">Diajukan</span>
                                                                        @elseif ($list->status == 1)
                                                                            <span class="badge bg-danger">Ditolak</span>
                                                                        @elseif ($list->status == 2)
                                                                            <span class="badge bg-success">Disetujui</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-3">
                                                                            <button class="btn btn-dark btn-sm"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#Editpayment{{ $list->id }}">
                                                                                <i class="bi bi-pencil-square"></i> Detail
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                    @include('admin.modal.detaildiajukan')
                                                                </tr>
                                                            @endforeach
                                                        </tbody>

                                                        <script>
                                                            $(document).ready(function () {
                                                            var table = $('#mken').DataTable();

                                                            // Hapus filterRow dulu biar gak dobel saat reload/refresh
                                                            $('#filterRow').empty();

                                                            // Tambahkan input + select ke setiap kolom
                                                            $('#mken thead tr:eq(0) th').each(function (i) {
                                                                // Hanya tampilkan filter untuk kolom yang punya nama (hindari kolom checkbox/aksi)
                                                                if ($(this).text().trim() !== '' && i !== 7 && i !== 8) { // sesuaikan indeks kolom jika perlu
                                                                    $('#filterRow').append(`
                                                                        <th>
                                                                            <input type="text" class="filter-input form-control mb-1" data-col="${i}" placeholder="Search..." style="width: 100%;" />
                                                                            <select class="filter-select form-select" data-col="${i}" style="width: 100%;">
                                                                                <option value="">-- Semua --</option>
                                                                            </select>
                                                                        </th>
                                                                    `);
                                                                } else {
                                                                    $('#filterRow').append(`<th></th>`); // kolom kosong (aksi, checkbox, dll.)
                                                                }
                                                            });

                                                            // Isi select dengan data unik dari tiap kolom
                                                            table.columns().every(function (i) {
                                                                let column = this;
                                                                let select = $('.filter-select[data-col="' + i + '"]');

                                                                if (select.length) {
                                                                    let uniqueData = column.data().unique().sort();
                                                                    uniqueData.each(function (d) {
                                                                        if (d && d !== '') {
                                                                            select.append('<option value="' + d + '">' + d + '</option>');
                                                                        }
                                                                    });

                                                                    // Aktifkan Select2 jika perlu
                                                                    select.select2({
                                                                        placeholder: 'Pilih...',
                                                                        width: '100%',
                                                                        allowClear: true
                                                                    });
                                                                }
                                                            });

                                                            // Event untuk input search
                                                            $('.filter-input').on('keyup change', function () {
                                                                let col = $(this).data('col');
                                                                table.column(col).search(this.value).draw();
                                                            });

                                                            // Event untuk select dropdown
                                                            $('.filter-select').on('change', function () {
                                                                let col = $(this).data('col');
                                                                let val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                                table.column(col).search(val ? '^' + val + '$' : '', true, false).draw();
                                                            });
                                                        });

                                                        </script>




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

            </main><!-- End #main -->



            <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                    class="bi bi-arrow-up-short"></i></a>


        </body>

        </html>


    </div>
@endsection
