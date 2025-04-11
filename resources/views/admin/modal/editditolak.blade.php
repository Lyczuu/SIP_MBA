<!-- Modal -->
<div class="modal fade" id="Editpaymentr{{ $list->id }}" tabindex="-1"
    aria-labelledby="EditpaymentrLabel{{ $list->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditpaymentrLabel{{ $list->id }}">Edit Data - ID: {{ $list->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.ditolak', $list->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <!-- Input Hidden untuk Jenis Pengajuan -->
                    <input type="hidden" name="status" value="0">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="kode_pengajuan" class="form-label"><strong>Kode Pengajuan</strong></label>
                            <input type="text" name="kode_pengajuan" id="kode_pengajuan" class="form-control"
                                placeholder="" value="{{ $list->kode_pengajuan }}" disabled>
                        </div>
                        {{-- end kode_pengajuan --}}

                        <div class="col-6 mb-3">
                            <label for="username" class="form-label"><strong>Nama Am</strong></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder=""
                                value="{{ $list->user->username }}" disabled>
                        </div>
                        {{-- end username --}}


                        <!-- Dropdown Wilayah -->
                        <div class="col-6 mb-3">
                            <label for="wilayah" class="form-label"><strong>Nama Wilayah <span
                                        class="text-danger">*</span></strong></label>
                            <select id="wilayah" name="wilayah_id" class="form-select" required>
                                @foreach ($wilayah as $w)
                                    <option value="{{ $w->id }}"
                                        {{ old('wilayah_id', $list->wilayah_id ?? '') == $w->id ? 'selected' : '' }}>
                                        {{ $w->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilihan Jenis Transaksi -->
                        <div class="col-3 mb-4">
                            <label class="form-label"><strong>Jenis Transaksi</strong><span
                                    class="text-danger">*</span></label>
                            <div>
                                @foreach ($jenistransaksi as $transaksi)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="transaksi_id"
                                            id="transaksi_{{ $transaksi->id }}" value="{{ $transaksi->id }}"
                                            data-jenis="{{ $transaksi->nama_jenis_transaksi }}"
                                            {{ old('transaksi_id', $list->transaksi_id ?? '') == $transaksi->id ? 'checked' : '' }}
                                            required>
                                        <label class="form-check-label" for="transaksi_{{ $transaksi->id }}">
                                            {{ $transaksi->nama_jenis_transaksi }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Aggregator Input (ditampilkan jika jenis transaksi AGGREGATOR) -->
                        <div class="col-6" id="aggregator-input-container" style="display: none;">
                            <label for="mitra_agg" class="form-label"><strong>Informasi Tambahan untuk
                                    AGGREGATOR</strong></label>
                            <select name="mitra_agg" id="mitra_agg" class="form-control">
                                <option value="">-- Pilih agg --</option>
                                @foreach ($mitras as $m)
                                    <option value="{{ $m->id }}"
                                        {{ old('mitra_agg', $list->mitra_agg ?? '') == $m->id ? 'selected' : '' }}>
                                        {{ $m->nama_mitra }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mitra_agg')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dropdown Mitra -->
                        <div class="col-6 mb-4">
                            <label for="mitra" class="form-label"><strong>Nama Mitra <span
                                        class="text-danger">*</span></strong></label>
                            <select id="mitra" name="mitra_id" class="form-select" required>
                                <option value="">-- Pilih Mitra --</option>
                                @foreach ($mitra as $m)
                                    <option value="{{ $m->id }}" data-flag-bank="{{ $m->flag_bank }}"
                                        {{ old('mitra_id', $list->mitra_id ?? '') == $m->id ? 'selected' : '' }}>
                                        {{ $m->nama_mitra }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jenis Pajak -->
                        <div class="col-6 mb-4">
                            <label class="form-label"><strong>Jenis Pajak</strong><span
                                    class="text-danger">*</span></label>
                            <div>
                                @php
                                    $selectedjenispajak = old(
                                        'jenis_pajak',
                                        isset($list->jenis_pajak_id)
                                            ? array_map(
                                                'intval',
                                                array_map('trim', explode(',', $list->jenis_pajak_id)),
                                            )
                                            : [],
                                    );
                                @endphp

                                @foreach ($jenispajak as $jak)
                                    <div class="form-check">
                                        <input type="checkbox" name="jenis_pajak[]" value="{{ $jak->id }}"
                                            id="jenis_pajak_{{ $jak->id }}" class="form-check-input"
                                            {{ in_array((int) $jak->id, $selectedjenispajak) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jenis_pajak_{{ $jak->id }}">
                                            {{ $jak->nama_jenis_pajak }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Pengajuan Integrasi -->
                        <div class="row">
                            <div class="col-4 mb-4">
                                <label class="form-label"><strong>Pengajuan Integrasi <span
                                            class="text-danger">*</span></strong></label>
                                <div class="d-flex justify-content-between">
                                    @foreach ($PengajuanIntegrasi as $pengajuan)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="pengajuan_integrasi_id" id="pengajuan_{{ $pengajuan->id }}"
                                                value="{{ $pengajuan->id }}"
                                                {{ old('pengajuan_integrasi_id', $list->pengajuan_integrasi_id ?? '') == $pengajuan->id ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="pengajuan_{{ $pengajuan->id }}">
                                                {{ $pengajuan->nama_pengajuan_integrasi }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>





                        
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

                        <!-- Cutoff, Settlement & Nomor Registrasi Legal -->
                        <label class="cuttoff-settlement-label mb-3">
                            <strong>Cuttoff & Settlement & Nomor Registrasi Legal <span
                                    class="text-danger">*</span></strong>
                        </label>
                        <div class="col-4">
                            <label class="form-label"><strong>Cutoff <span
                                        class="text-danger">*</span></strong></label>
                            <input type="time" class="form-control" name="cutoff" placeholder="Masukan cutoff"
                                value="{{ old('cutoff', $list->cutoff ?? '') }}">
                        </div>
                        <div class="col-4">
                            <label class="form-label"><strong>Settlement <span
                                        class="text-danger">*</span></strong></label>
                            <input type="time" class="form-control" name="settlement"
                                placeholder="Masukan Settlement"
                                value="{{ old('settlement', $list->settlement ?? '') }}">
                        </div>
                        <div class="col-4 mb-5">
                            <label class="form-label"><strong>Nomor Registrasi Legal <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="nomor_registrasi_legal"
                                placeholder="Masukan Nomor Registrasi Legal"
                                value="{{ old('nomor_registrasi_legal', $list->nomor_registrasi_legal ?? '') }}"
                                required>
                        </div>

                        <!-- Skema Fee -->
                        <div class="row">
                            <label class="fees-label mb-3"><strong>Fees <span
                                        class="text-danger">*</span></strong></label>
                            <div class="col-4">
                                <label class="form-label"><strong>Total Fee <span
                                            class="text-danger">*</span></strong></label>
                                <input type="text" class="form-control no-spinner autonumeric" name="total_fee"
                                    placeholder="Masukan Total Fee"
                                    value="{{ old('total_fee', $list->total_fee ?? '') }}" required>
                            </div>
                            <div class="col-4">
                                <label class="form-label"><strong>Fee MBA <span
                                            class="text-danger">*</span></strong></label>
                                <input type="text" class="form-control no-spinner autonumeric" name="fee_mba"
                                    placeholder="Masukkan Fee MBA" value="{{ old('fee_mba', $list->fee_mba ?? '') }}"
                                    required>
                            </div>
                            <div class="col-4 mb-5">
                                <label class="form-label"><strong>Fee Mitra <span
                                            class="text-danger">*</span></strong></label>
                                <input type="text" class="form-control no-spinner autonumeric" name="fee_mitra"
                                    placeholder="Masukkan Fee Mitra"
                                    value="{{ old('fee_mitra', $list->fee_mitra ?? '') }}" required>
                            </div>
                        </div>

                        <!-- PIC & TELEPON -->
                        <label class="pic-telepon-label mb-3"><strong>PIC & TELEPON <span
                                    class="text-danger">*</span></strong></label>
                        <div class="col-4">
                            <label class="form-label"><strong>PIC Payment Mitra <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="pic_payment_mitra"
                                placeholder="Masukan PIC Payment Mitra"
                                value="{{ old('pic_payment_mitra', $list->pic_payment_mitra ?? '') }}" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label"><strong>Telepon Payment Mitra <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" name="telepon_payment_mitra"
                                placeholder="Masukan Telepon Payment Mitra" id="telepon_payment_mitra"
                                class="form-control" maxlength="15"
                                value="{{ old('telepon_payment_mitra', $list->telepon_payment_mitra ?? '') }}"
                                required>
                            <div class="invalid-feedback">
                                Diperlukan. Hanya boleh angka (maksimal 15 digit)
                            </div>
                        </div>

                        <!-- PIC Rekon Mitra & Telepon Rekon Mitra -->
                        <div class="col-4 mb-3">
                            <label class="form-label"><strong>PIC Rekon Mitra <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="pic_rekon_mitra"
                                placeholder="Masukan PIC Rekon Mitra"
                                value="{{ old('pic_rekon_mitra', $list->pic_rekon_mitra ?? '') }}" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label"><strong>Telepon Rekon Mitra <span
                                        class="text-danger">*</span></strong></label>
                                        <input type="text" name="telepon_rekon_mitra" placeholder="Masukan Telepon Rekon Mitra"
                                        id="telepon_rekon_mitra" class="form-control" maxlength="15" required
                                        value="{{ old('telepon_rekon_mitra', $list->telepon_rekon_mitra ?? '') }}">
                                    <div class="invalid-feedback">
                                        Diperlukan. Hanya boleh angka (maksimal 15 digit)
                                    </div>
                        </div>

                        <!-- PIC Dinas & Telepon Dinas -->
                        <div class="col-4">
                            <label class="form-label"><strong>PIC Dinas <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="pic_dinas"
                                placeholder="Masukan PIC Dinas"
                                value="{{ old('pic_dinas', $list->pic_dinas ?? '') }}" required>
                        </div>
                        <div class="col-4 mb-5">
                            <label class="form-label"><strong>Telepon Dinas <span
                                        class="text-danger">*</span></strong></label>
                                        <input type="text" name="telepon_dinas" placeholder="Masukan Telepon Dinas"
                                        id="telepon_dinas" class="form-control" maxlength="15"
                                        value="{{ old('telepon_dinas', $list->telepon_dinas ?? '') }}" required>
                                    <div class="invalid-feedback">
                                        Diperlukan. Hanya boleh angka (maksimal 15 digit)
                                    </div>
                        </div>

                        <!-- WAG Koordinasi Payment & Rekon -->
                        {{-- < class="row mt-3"> --}}
                        <label class="cuttoff-settlement-label mb-3">
                            <strong>WAG Koordinasi Payment & Rekon <span class="text-danger">*</span></strong>
                        </label>
                        <div class="col-6">
                            <label class="form-label"><strong>WAG Koordinasi Payment <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="wag_kordinasi_payment"
                                placeholder="Masukan WAG Koordinasi Payment"
                                value="{{ old('wag_kordinasi_payment', $list->wag_kordinasi_payment ?? '') }}"
                                required>
                        </div>

                        <div class="col-6 mb-5">
                            <label class="form-label"><strong>WAG Koordinasi Rekon <span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="wag_kordinasi_rekon"
                                placeholder="Masukan WAG Koordinasi Rekon"
                                value="{{ old('wag_kordinasi_rekon', $list->wag_kordinasi_rekon ?? '') }}" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label for="alasan_penolakan" class="form-label"><strong>Alasan Penolakan</strong></label>
                            <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control" rows="5" disabled>{{ $list->alasan_penolakan }}</textarea>
                        </div>

                        {{-- end alasan penolakan --}}
                        <div class="col-6 mb-3">
                            <label for="ditolak_oleh" class="form-label"><strong>Ditolak Oleh</strong></label>
                            <input type="text" name="ditolak_oleh" id="ditolak_oleh" class="form-control"
                                placeholder="" value="{{ $list->ditolak_oleh }}" disabled>
                        </div>
                        {{-- end ditolak oleh --}}

                        <div class="row">
                            <!-- Script untuk menampilkan input tambahan aggregator dan filter dropdown mitra -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const jenisTransaksiRadios = document.querySelectorAll('input[name="transaksi_id"]');
                                    const mitraDropdown = document.getElementById('mitra');
                                    const aggregatorInputContainer = document.getElementById('aggregator-input-container');
                                    // Simpan semua opsi mitra (kecuali placeholder)
                                    const allMitraOptions = Array.from(mitraDropdown.querySelectorAll('option')).slice(1);

                                    function filterMitra() {
                                        let selectedRadio = document.querySelector('input[name="transaksi_id"]:checked');
                                        if (selectedRadio) {
                                            let selectedType = selectedRadio.nextElementSibling.textContent.trim();
                                            // Reset dropdown mitra
                                            mitraDropdown.innerHTML = '<option value="">-- Pilih Mitra --</option>';
                                            if (selectedType === 'AGGREGATOR') {
                                                allMitraOptions.forEach(option => {
                                                    if (option.dataset.flagBank == 1) {
                                                        mitraDropdown.appendChild(option);
                                                    }
                                                });
                                                aggregatorInputContainer.style.display = 'block';
                                            } else {
                                                allMitraOptions.forEach(option => {
                                                    mitraDropdown.appendChild(option);
                                                });
                                                aggregatorInputContainer.style.display = 'none';
                                            }
                                        }
                                    }

                                    jenisTransaksiRadios.forEach(radio => {
                                        radio.addEventListener('change', filterMitra);
                                    });

                                    // Panggil filter saat halaman pertama kali dimuat (misalnya jika ada nilai lama)
                                    filterMitra();
                                });
                            </script>
                            <!-- Footer Modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                </form>
            </div>
        </div>
        <br>
    </div>
</div>
