<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
        }

        .form-select,
        .form-check-input {
            border-radius: 6px;
        }
    </style>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="pagetitle">
        <h1>Pengajuan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan') }}">Home</a></li>
                <li class="breadcrumb-item active">Form Integrasi Payment MBA Fee Based (admin)</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Integrasi Payment MBA Fee Based (admin)</h5>
            <form class="row g-3" action="/ajukan" method="post" enctype="multipart/form-data">
                @csrf


                <!-- Input Hidden untuk Jenis Pengajuan -->
                <input type="hidden" name="jenis_pengajuan" value="1">

                <!-- Dropdown Wilayah -->
                    <div class="col-6">
                        <label for="wilayah" class="form-label">Nama Wilayah</label>
                        <select id="wilayah" name="wilayah_id" class="form-select" required>
                            @foreach ($wilayah as $w)
                                <option value="{{ $w->id }}">{{ $w->nama_wilayah }}</option>
                            @endforeach
                        </select>
                    </div>




                    <!-- Pilihan Jenis Transaksi -->
                    <div class="col-3 mb-4">
                        <label class="form-label">Jenis Transaksi <span class="text-danger">*</span></label>
                        <div>
                            @foreach ($jenis_transaksi as $transaksi)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="transaksi_id"
                                        id="transaksi_{{ $transaksi->id }}" value="{{ $transaksi->id }}"
                                        data-jenis="{{ $transaksi->nama_jenis_transaksi }}" required>
                                    <label class="form-check-label" for="transaksi_{{ $transaksi->id }}">
                                        {{ $transaksi->nama_jenis_transaksi }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- aggregator --}}
                    <div class="col-6" id="aggregator-input-container" style="display: none;">
                        <label for="mitra_agg" class="form-label">Informasi Tambahan untuk AGGREGATOR</label>
                        <select name="mitra_agg" id="mitra_agg" class="form-control">
                            <option value="">-- Pilih agg --</option>
                            @foreach ($mitras as $m)
                                <option value="{{ $m->id }}"
                                    {{ old('mitra_agg') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama_mitra }}
                                </option>
                            @endforeach
                        </select>
                        @error('mitra_agg')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- end aggregator --}}


                    <!-- Dropdown Mitra -->
                    <div class="col-6 mb-4">
                        <label for="mitra" class="form-label">Nama Mitra</label>
                        <select id="mitra" name="mitra_id" class="form-select" required>
                            <option value="">-- Pilih Mitra --</option>
                            @foreach ($mitra as $m)
                                <option value="{{ $m->id }}" data-flag-bank="{{ $m->flag_bank }}">
                                    {{ $m->nama_mitra }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const jenisTransaksiRadios = document.querySelectorAll('input[name="transaksi_id"]');
                            const mitraDropdown = document.getElementById('mitra');
                            const aggregatorInputContainer = document.getElementById('aggregator-input-container');

                            // Simpan semua data opsi mitra sebelum difilter
                            const allMitraOptions = Array.from(mitraDropdown.querySelectorAll('option')).slice(1);

                            jenisTransaksiRadios.forEach(radio => {
                                radio.addEventListener('change', function() {
                                    let selectedType = this.nextElementSibling.textContent.trim();

                                    // Reset dropdown dan tambahkan semua opsi mitra
                                    mitraDropdown.innerHTML = '<option value="">-- Pilih Mitra --</option>';

                                    if (selectedType === 'AGGREGATOR') {
                                        // Jika memiih jenis transaksi  AGGREGATOR, filter hanya mitra dengan flag_bank = 1
                                        allMitraOptions.forEach(option => {
                                            if (option.dataset.flagBank == 1) {
                                                mitraDropdown.appendChild(option);
                                            }
                                        });
                                        aggregatorInputContainer.style.display =
                                        'block'; // Tampilkan input tambahan
                                    } else {
                                        // Jika jenis transaksi selain AGGREGATOR, tampilkan semua mitra
                                        allMitraOptions.forEach(option => {
                                            mitraDropdown.appendChild(option);
                                        });
                                        aggregatorInputContainer.style.display =
                                        'none'; // Sembunyikan input tambahan aggregator
                                    }
                                });
                            });
                        });
                        </script>


                    {{-- jenis pajak --}}

                    <div class="col-6 mb-4">
                        <label class="form-label">Jenis Pajak <span class="text-danger">*</span></label>
                        <div>
                            @foreach ($jenis_pajak as $jak)
                                <div class="form-check">
                                    <input type="checkbox" name="jenis_pajak[]" value="{{ $jak->id }}"
                                        class="form-check-input" id="jenis_pajak_{{ $jak->id }}">
                                    <label class="form-check-label" for="jenis_pajak_{{ $jak->id }}">
                                        {{ $jak->nama_jenis_pajak }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    {{-- end jenis pajak --}}


                    <!-- Pengajuan Integrasi -->
                    <div class="row">
                    <div class="col-4 mb-4">
                        <label class="form-label">Pengajuan Integrasi</label>
                        <div class="d-flex justify-content-between">
                            @foreach ($pengajuanintegrasi as $pengajuan)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pengajuan_integrasi_id"
                                        id="pengajuan_{{ $pengajuan->id }}" value="{{ $pengajuan->id }}"
                                        {{ old('pengajuan_integrasi_id') == $pengajuan->id ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="pengajuan_{{ $pengajuan->id }}">
                                        {{ $pengajuan->nama_pengajuan_integrasi }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- end pengajuan integrasi --}}






                {{-- <div class="row"> --}}




                {{-- Cutoff  --}}
                <label class="cuttoff-settlement-label mb-3"><strong>Cuttoff & Settlement & Nomor Registrasi Legal <span
                            class="text-danger">*</span></strong></label>
                <div class="col-4">
                    <label class="form-label">Cutoff </label>
                    <input type="text" class="form-control" name="cutoff" placeholder="Masukan cuttoff" required>
                </div>

                <!-- Settlement -->
                <div class="col-4">
                    <label class="form-label">Settlement </label>
                    <input type="text" class="form-control" name="settlement" placeholder="Masukan Settlement"
                        required>
                </div>

                <!-- Nomor Registrasi Legal -->

                <div class="col-4 mb-5">
                    <label class="form-label">Nomor Registrasi Legal </label>
                    <input type="text" class="form-control" name="nomor_registrasi_legal"
                        placeholder="Masukan Nomor Registrasi Legal" required>
                </div>




                <!-- Skema Fee -->
                <div class="row">
                    <label class="fees-label mb-3"><strong>Fees<span class="text-danger">*</span></strong></label>
                    <div class="col-4">
                        <label class="form-label">Total_Fee </label>
                        <input type="text" class="form-control" name="fees" placeholder="Masukan Total fee"
                            required>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Fee MBA </label>
                        <input type="text" class="form-control" name="fee_mba" placeholder="Masukkan Fee MBA"
                            required>
                    </div>
                    <div class="col-4 mb-5">
                        <label class="form-label">Fee Mitra </label>
                        <input type="text" class="form-control" name="fee_mitra" placeholder="Masukkan Fee Mitra"
                            required>
                    </div>
                    {{-- end fees --}}

                    <!-- PIC Payment Mitra -->
                    <label class="pic-telepon-label mb-3"><strong>PIC & TELEPON<span
                                class="text-danger">*</span></strong></label>
                    <div class="col-4">
                        <label class="form-label">PIC Payment Mitra </span></label>
                        <input type="text" class="form-control" name="pic_payment_mitra"
                            placeholder="Masukan PIC Payment Mitra" required>
                    </div>
                    <div class="col-4">
                        <label for="telepon_payment_mitra"><strong>Telepon Payment Mitra</strong></label>
                        <input type="text" name="telepon_payment_mitra" id="telepon_payment_mitra"
                            class="form-control"
                            value="{{ old('telepon_payment_mitra', $paymentMba->telepon_payment_mitra ?? '') }}">
                    </div>

                    <!-- PIC Rekon Mitra -->
                    <div class="col-4 mb-3">
                        <label class="form-label">PIC Rekon Mitra</span></label>
                        <input type="text" class="form-control" name="pic_rekon_mitra"
                            placeholder="Masukan PIC Rekon Mitra" required>
                    </div>
                    <div class="col-4">
                        <label for="telepon_rekon_mitra"><strong>Telepon Rekon Mitra</strong></label>
                        <input type="text" name="telepon_rekon_mitra" id="telepon_rekon_mitra"
                            class="form-control"
                            value="{{ old('telepon_rekon_mitra', $paymentMba->telepon_rekon_mitra ?? '') }}">
                    </div>

                    <!-- PIC Dinas -->
                    <div class="col-4">
                        <label class="form-label">PIC Dinas </span></label>
                        <input type="text" class="form-control" name="pic_dinas" placeholder="Masukan Pic Dinas"
                            required>
                    </div>

                    <div class="col-4 mb-5">
                        <label for="telepon_dinas"><strong>Telepon Dinas</strong></label>
                        <input type="text" name="telepon_dinas" id="telepon_dinas" class="form-control"
                            value="{{ old('telepon_dinas', $paymentMba->telepon_dinas ?? '') }}">
                    </div>



                    <!-- WAG Koordinasi Payment -->
                    <div class="row mt-3">
                        <label class="cuttoff-settlement-label mb-3"><strong>Wag Kordinasi Payment & Rekon<span
                                    class="text-danger">*</span></strong></label>
                        <div class="col-6">
                            <label class="form-label">WAG Koordinasi Payment</label>
                            <input type="text" class="form-control" name="wag_kordinasi_payment"
                                placeholder="Masukan WAG Koordinasi Payment" required>
                        </div>

                        <!-- WAG Koordinasi Rekon -->
                        <div class="col-6 mb-5">
                            <label class="form-label">WAG Koordinasi Rekon </label>
                            <input type="text" class="form-control" name="wag_kordinasi_rekon"
                                placeholder="Masukan WAG Koordinasi Rekon" required>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary">Ajukan</button>

            </form>
        </div>


</body>

</html>
