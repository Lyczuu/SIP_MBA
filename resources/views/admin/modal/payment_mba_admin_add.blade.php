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

        .r {
            color: red
        }

        .no-spinner::-webkit-inner-spin-button,
        .no-spinner::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .no-spinner {
            -moz-appearance: textfield;
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

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Integrasi Payment MBA Fee Based (admin)</h5>
            <form class="row g-3 needs-validation" action="/jukan" method="post" enctype="multipart/form-data"
                novalidate>
                @csrf


                <!-- Input Hidden untuk Jenis Pengajuan -->
                <input type="hidden" name="jenis_pengajuan" value="1">

                {{-- row 1 --}}
                <div class="row">
                    <!-- Dropdown Wilayah -->
                    <div class="col-6">
                        <label for="wilayah" class="form-label">Nama Wilayah <span class="r">*</span></label>
                        <select id="wilayah" name="wilayah_id" class="form-select" required>
                            <option value="">-- Pilih wilayah --</option>
                            @foreach ($wilayah as $w)
                                <option value="{{ $w->id }}" {{ old('wilayah_id') == $w->id ? 'selected' : '' }}>
                                    {{ $w->nama_wilayah }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <!-- Pilihan Jenis Transaksi -->
                    <div class="col-3 mb-4">
                        <label class="form-label">Jenis Transaksi <span class="r">*</span></label>
                        <div>
                            @foreach ($jenis_transaksi as $transaksi)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="transaksi_id"
                                        id="transaksi_{{ $transaksi->id }}" value="{{ $transaksi->id }}"
                                        data-jenis="{{ $transaksi->nama_jenis_transaksi }}" required
                                        {{ old('transaksi_id') == $transaksi->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="transaksi_{{ $transaksi->id }}">
                                        {{ $transaksi->nama_jenis_transaksi }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- endrows --}}


                {{-- row 2 --}}

                <div class="row">

                    {{-- aggregator --}}
                    <div class="col-6" id="aggregator-input-container" style="display: none;">
                        <label for="mitra_agg" class="form-label">Informasi Tambahan untuk AGGREGATOR <span
                                class="r">*</span></label>
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
                    {{-- end --}}


                    <!-- Dropdown Mitra -->
                    <div class="col-6 mb-4">
                        <label for="mitra" class="form-label">Nama Mitra <span class="r">*</span></label>
                        <select id="mitra" name="mitra_id" class="form-select" required>
                            <option value="">-- Pilih Mitra --</option>
                            @foreach ($mitra as $m)
                                <option value="{{ $m->id }}" data-flag-bank="{{ $m->flag_bank }}"
                                    {{ old('mitra_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama_mitra }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- end --}}


                </div>

                {{-- endrows --}}



                {{-- row 3 --}}
                {{-- jenis pajak --}}
                <div class="row">
                    <div class="col-6 mb-4">
                        <label class="form-label">Jenis Pajak <span class="r">*</span></label>
                        <div>
                            @foreach ($jenis_pajak as $jak)
                                <div class="form-check">
                                    <input type="checkbox" name="jenis_pajak[]" value="{{ $jak->id }}"
                                        class="form-check-input @error('jenis_pajak') is-invalid @enderror"
                                        id="jenis_pajak_{{ $jak->id }}"
                                        {{ in_array($jak->id, old('jenis_pajak', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jenis_pajak_{{ $jak->id }}">
                                        {{ $jak->nama_jenis_pajak }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                {{-- end jenis pajak --}}


                {{-- row 4 --}}
                <!-- Pengajuan Integrasi -->
                <div class="row">
                    <div class="col-4 mb-4">
                        <label class="form-label">Pengajuan Integrasi <span class="r">*</span></label>
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
                <div class="row">
                    <label class="cuttoff-settlement-label mb-3"><strong>Cuttoff & Settlement
                            <span class="r">*</span></strong></label>
                    <div class="col-4">
                        <label class="form-label">Cutoff </label>
                        <input type="time" class="form-control" name="cutoff" placeholder="Masukan Cutoff" required
                            value="{{ old('cutoff') }}">
                        <div class="invalid-feedback">
                            Diperlukan. Hanya boleh berupa angka
                        </div>
                    </div>

                    <!-- Settlement -->
                    <div class="col-4">
                        <label class="form-label">Settlement <span class="r">*</span></label>
                        <input type="time" class="form-control" name="settlement"
                            placeholder="Masukan Settlement" required value="{{ old('settlement') }}">
                        <div class="invalid-feedback">
                            Diperlukan. Hanya boleh berupa angka
                        </div>
                    </div>

                    <!-- Nomor Registrasi Legal -->
                    <div class="col-4 mb-4">
                        <label class="form-label">Nomor Registrasi Legal <span class="r">*</span></label>
                        <input type="text" class="form-control" name="nomor_registrasi_legal"
                            placeholder="Masukan Nomor Registrasi Legal" required
                            value="{{ old('nomor_registrasi_legal') }}">
                        <div class="invalid-feedback">
                            Harap isi kolom ini
                        </div>
                    </div>
                </div>
                {{-- end --}}



                <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.6.0/dist/autoNumeric.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const inputs = document.querySelectorAll('.autonumeric');
                        inputs.forEach(input => {
                            new AutoNumeric(input, {
                                digitGroupSeparator: '.',
                                decimalCharacter: ',',
                                decimalPlaces: 0,
                                unformatOnSubmit: true
                            });
                        });
                    });
                </script>

                <div class="row">
                    <label class="fees-label mb-3"><strong>Fees <span class="r">*</span></strong></label>

                    <div class="col-4">
                        <label class="form-label">Total Fee <span class="r">*</span></label>
                        <input type="text" class="form-control no-spinner autonumeric" name="total_fee"
                            placeholder="Masukan Total fee" required value="{{ old('total_fee') }}">
                        <div class="invalid-feedback">Diperlukan. Hanya boleh berupa angka</div>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Fee MBA <span class="r">*</span></label>
                        <input type="text" class="form-control no-spinner autonumeric" name="fee_mba"
                            placeholder="Masukkan Fee MBA" required value="{{ old('fee_mba') }}">
                        <div class="invalid-feedback">Diperlukan. Hanya boleh berupa angka</div>
                    </div>

                    <div class="col-4 mb-5">
                        <label class="form-label">Fee Mitra <span class="r">*</span></label>
                        <input type="text" class="form-control no-spinner autonumeric" name="fee_mitra"
                            placeholder="Masukkan Fee Mitra" required value="{{ old('fee_mitra') }}">
                        <div class="invalid-feedback">Diperlukan. Hanya boleh berupa angka</div>
                    </div>
                </div>



                {{-- row2 --}}
                <!-- PIC Payment Mitra -->
                <div class="row">
                    <label class="pic-telepon-label mb-3"><strong>PIC & TELEPON <span
                                class="r">*</span></strong></label>


                    <div class="col-4">
                        <label class="form-label">PIC Payment Mitra <span class="r">*</span></label>
                        <input type="text" class="form-control" name="pic_payment_mitra"
                            placeholder="Masukan PIC Payment Mitra" required value="{{ old('pic_payment_mitra') }}">
                        <div class="invalid-feedback">
                            Harap isi kolom ini
                        </div>
                    </div>


                    <div class="col-4">
                        <label for="telepon_payment_mitra" class="form-label">Telepon Payment Mitra <span class="r">*</span></label>
                        <input type="text" name="telepon_payment_mitra" placeholder="Masukan Telepon Payment Mitra"
                            id="telepon_payment_mitra" class="form-control" maxlength="15"
                            value="{{ old('telepon_payment_mitra', $paymentMba->telepon_payment_mitra ?? '') }}" required>
                        <div class="invalid-feedback">
                            Diperlukan. Hanya boleh angka (maksimal 15 digit)
                        </div>
                    </div>


                    <!-- PIC Rekon Mitra -->
                    <div class="col-4 mb-3">
                        <label class="form-label">PIC Rekon Mitra <span class="r">*</span></label>
                        <input type="text" class="form-control" name="pic_rekon_mitra"
                            placeholder="Masukan PIC Rekon Mitra" required value="{{ old('pic_rekon_mitra') }}">
                        <div class="invalid-feedback">
                            Harap isi kolom ini
                        </div>
                    </div>
                </div>
                {{-- endrow --}}



                <p></p>
                {{-- row3 --}}
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">Telepon Rekon Mitra <span class="r">*</span></label>
                        <input type="text" name="telepon_rekon_mitra" placeholder="Masukan Telepon Rekon Mitra"
                            id="telepon_rekon_mitra" class="form-control" maxlength="15" required
                            value="{{ old('telepon_rekon_mitra', $paymentMba->telepon_rekon_mitra ?? '') }}">
                        <div class="invalid-feedback">
                            Diperlukan. Hanya boleh angka (maksimal 15 digit)
                        </div>
                    </div>


                    <!-- PIC Dinas -->
                    <div class="col-4">
                        <label class="form-label">PIC Dinas <span class="r">*</span></label>
                        <input type="text" class="form-control" name="pic_dinas" placeholder="Masukan Pic Dinas"
                            required value="{{ old('pic_dinas') }}">
                        <div class="invalid-feedback">
                            Harap isi kolom ini
                        </div>
                    </div>

                    <div class="col-4 mb-5">
                        <label class="form-label">Telepon Dinas <span class="r">*</span></label>
                        <input type="text" name="telepon_dinas" placeholder="Masukan Telepon Dinas"
                            id="telepon_dinas" class="form-control" maxlength="15"
                            value="{{ old('telepon_dinas', $paymentMba->telepon_dinas ?? '') }}" required>
                        <div class="invalid-feedback">
                            Diperlukan. Hanya boleh angka (maksimal 15 digit)
                        </div>
                    </div>
                </div>
                {{-- endrow --}}


                <!-- WAG Koordinasi Payment -->
                <div class="row">
                    <label class="cuttoff-settlement-label mb-3"><strong>Wag Kordinasi Payment & Rekon <span
                                class="r">*</span></strong></label>
                    <div class="col-6">
                        <label class="form-label">WAG Koordinasi Payment <span class="r">*</span></label>
                        <input type="text" class="form-control" name="wag_kordinasi_payment"
                            placeholder="Masukan WAG Koordinasi Payment" required
                            value="{{ old('wag_kordinasi_payment') }}">
                        <div class="invalid-feedback">
                            Harap isi kolom ini
                        </div>
                    </div>

                    <!-- WAG Koordinasi Rekon -->
                    <div class="col-6 mb-5">
                        <label class="form-label">WAG Koordinasi Rekon <span class="r">*</span></label>
                        <input type="text" class="form-control" name="wag_kordinasi_rekon"
                            placeholder="Masukan WAG Koordinasi Rekon" required
                            value="{{ old('wag_kordinasi_rekon') }}">
                        <div class="invalid-feedback">
                            Harap isi kolom ini
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">Ajukan</button>




                {{-- script tambahan aggregator --}}
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
                                    // Jika memilih jenis transaksi AGGREGATOR, filter hanya mitra dengan flag_bank = 1
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


                        // Cek old input untuk transaksi_id
                        const oldTransaksiId = "{{ old('transaksi_id') }}";
                        if (oldTransaksiId) {
                            const selectedRadio = document.querySelector(
                                `input[name="transaksi_id"][value="${oldTransaksiId}"]`);
                            if (selectedRadio) {
                                selectedRadio.checked = true;
                                // Trigger event change untuk memicu filtering dan menampilkan input aggregator jika diperlukan
                                selectedRadio.dispatchEvent(new Event('change'));
                            }
                        }
                    });
                </script>
                {{-- end script tambahan aggregator --}}

            </form>
        </div>


</body>

</html>
