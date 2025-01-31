\@extends('layout.am_wilayahfeelayout')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Halaman Dashboard</h1>

        {{-- Jika ada pesan status --}}
        @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        <!-- Tabel Data Pengajuan Tanpa Fee Admin -->
        <h2>NO FEE ADMIN</h2>
        <table class="table table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pengajuan</th>
                    <th>User</th>
                    <th>Mitra</th>
                    <th>Wilayah</th>
                    <th>Transaksi</th>
                    <th>Jenis Pajak ID</th>
                    <th>Mitra Agg</th>
                    <th>Cutoff</th>
                    <th>Settlement</th>
                    <th>Pengajuan Integras</th>
                    <th>Nomor Registrasi Legal</th>
                    <th>Wag Kordinasi Payment</th>
                    <th>Wag Kordinasi Rekon</th>
                    <th>PIC Payment Mitra</th>
                    <th>Telepon Payment Mitra</th>
                    <th>PIC Rekon Mitra</th>
                    <th>Telepon Rekon Mitra</th>
                    <th>PIC Dinas</th>
                    <th>Telepon Dinas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentmbafee as $key => $list)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $list->kode_pengajuan }}</td>
                        <td>{{ $list->username }}</td>
                        <td>{{ $list->mitra->nama_mitra}}</td>
                        <td>{{ $list->wilayah->nama_wilayah }}</td>
                        <td>{{ $list->jenis_transaksi->nama_jenis_transaksi}}</td>
                        <td>{{ $list->jenis_pajak_id }}</td>
                        <td>{{ $list->mitra_agg }}</td>
                        <td>{{ $list->cutoff }}</td>
                        <td>{{ $list->settlement }}</td>
                        <td>{{ $list->pengajuan_integrasi }}</td>
                        <td>{{ $list->nomor_registrasi_legal }}</td>
                        <td>{{ $list->wag_kordinasi_payment }}</td>
                        <td>{{ $list->wag_kordinasi_rekon }}</td>
                        <td>{{ $list->pic_payment_mitra }}</td>
                        <td>{{ $list->telepon_payment_mitra }}</td>
                        <td>{{ $list->pic_rekon_mitra }}</td>
                        <td>{{ $list->telepon_rekon_mitra }}</td>
                        <td>{{ $list->pic_dinas }}</td>
                        <td>{{ $list->telepon_dinas }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Edit{{$list->id}}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusbarang{{$list->id}}">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tabel Data Pengajuan Dengan Fee Admin -->
        <h2>FEE ADMIN</h2>
        <table class="table table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pengajuan</th>
                    <th>User</th>
                    <th>Mitra</th>
                    <th>Wilayah</th>
                    <th>Transaksi</th>
                    <th>Jenis Pajak ID</th>
                    <th>Total Fee</th>
                    <th>Fee Mba</th>
                    <th>Fee Mitra</th>
                    <th>Mitra Agg</th>
                    <th>Cutoff</th>
                    <th>Settlement</th>
                    <th>Pengajuan Integras</th>
                    <th>Nomor Registrasi Legal</th>
                    <th>Wag Kordinasi Payment</th>
                    <th>Wag Kordinasi Rekon</th>
                    <th>PIC Payment Mitra</th>
                    <th>Telepon Payment Mitra</th>
                    <th>PIC Rekon Mitra</th>
                    <th>Telepon Rekon Mitra</th>
                    <th>PIC Dinas</th>
                    <th>Telepon Dinas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentmba as $key => $list)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $list->kode_pengajuan }}</td>
                        <td>{{ $list->user->username }}</td>
                        <td>{{ $list->mitra->nama_mitra}}</td>
                        <td>{{ $list->wilayah->nama_wilayah }}</td>
                        <td>{{ $list->jenis_transaksi->nama_jenis_transaksi}}</td>
                        <td>{{ $list->jenis_pajak_id }}</td>
                        <td>{{ $list->fees->total_fee }}</td>
                        <td>{{ $list->fees->fee_mba }}</td>
                        <td>{{ $list->fees->fee_mitra }}</td>
                        <td>{{ $list->mitra_agg }}</td>
                        <td>{{ $list->cutoff }}</td>
                        <td>{{ $list->settlement }}</td>
                        <td>{{ $list->pengajuan_integrasi }}</td>
                        <td>{{ $list->nomor_registrasi_legal }}</td>
                        <td>{{ $list->wag_kordinasi_payment }}</td>
                        <td>{{ $list->wag_kordinasi_rekon }}</td>
                        <td>{{ $list->pic_payment_mitra }}</td>
                        <td>{{ $list->telepon_payment_mitra }}</td>
                        <td>{{ $list->pic_rekon_mitra }}</td>
                        <td>{{ $list->telepon_rekon_mitra }}</td>
                        <td>{{ $list->pic_dinas }}</td>
                        <td>{{ $list->telepon_dinas }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Editnofee{{$list->id}}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusbarang{{$list->id}}">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @include('admin.modal.edit_mba_no_fee_admin')
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
