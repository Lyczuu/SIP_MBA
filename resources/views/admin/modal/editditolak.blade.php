<!-- Modal -->
<div class="modal fade" id="Editpayment{{ $list->id }}" tabindex="-1"
    aria-labelledby="EditpaymentLabel{{ $list->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditpaymentLabel{{ $list->id }}">Edit Data - ID: {{ $list->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ditolak.update', $list->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <!-- Input Hidden untuk Jenis Pengajuan -->
                    <input type="hidden" name="status" value="0">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="kode_pengajuan" class="form-label">Kode Pengajuan</label>
                            <input type="text" name="kode_pengajuan" id="kode_pengajuan" class="form-control"
                                placeholder="" value="{{ $list->kode_pengajuan }}" disabled>
                        </div>
                        {{-- end kode_pengajuan --}}

                        <div class="col-12 col-md-6">
                            <label for="username" class="form-label">Nama Am</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder=""
                                value="{{ $list->user->username }}" disabled>
                        </div>
                        {{-- end username --}}
                        <div class="col-12 col-md-6">
                            <label for="alasan_penolakan" class="form-label">Alasan Penolakan</label>
                            <input type="text" name="alasan_penolakan" id="alasan_penolakan" class="form-control" placeholder=""
                                value="{{ $list->alasan_penolakan }}" disabled>
                        </div>
                        {{-- end alasan penolakan--}}
                        <div class="col-12 col-md-6">
                            <label for="ditolak_oleh" class="form-label">Ditolak Oleh</label>
                            <input type="text" name="ditolak_oleh" id="ditolak_oleh" class="form-control" placeholder=""
                                value="{{ $list->ditolak_oleh }}" disabled>
                        </div>
                        {{-- end ditolak oleh --}}

                        <!-- Dropdown Wilayah -->
                        <div class="row">
                            <div class="col-6">
                                <label for="wilayah" class="form-label">Nama Wilayah</label>
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
                                <label class="form-label">Jenis Transaksi <span class="text-danger">*</span></label>
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
                                <label for="mitra_agg" class="form-label">Informasi Tambahan untuk AGGREGATOR</label>
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
                                <label for="mitra" class="form-label">Nama Mitra</label>
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
                                <label class="form-label">Jenis Pajak <span class="text-danger">*</span></label>
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
                                    <label class="form-label">Pengajuan Integrasi</label>
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

                            <!-- Cutoff, Settlement & Nomor Registrasi Legal -->
                            <label class="cuttoff-settlement-label mb-3">
                                <strong>Cuttoff & Settlement & Nomor Registrasi Legal <span
                                        class="text-danger">*</span></strong>
                            </label>
                            <div class="col-4">
                                <label class="form-label">Cutoff</label>
                                <input type="text" class="form-control" name="cutoff"
                                    placeholder="Masukan cutoff" value="{{ old('cutoff', $list->cutoff ?? '') }}"
                                    required>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Settlement</label>
                                <input type="text" class="form-control" name="settlement"
                                    placeholder="Masukan Settlement"
                                    value="{{ old('settlement', $list->settlement ?? '') }}" required>
                            </div>
                            <div class="col-4 mb-5">
                                <label class="form-label">Nomor Registrasi Legal</label>
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
                                    <label class="form-label">Total Fee</label>
                                    <input type="text" class="form-control" name="total_fee"
                                        placeholder="Masukan Total Fee"
                                        value="{{ old('total_fee', $list->total_fee ?? '') }}" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Fee MBA</label>
                                    <input type="text" class="form-control" name="fee_mba"
                                        placeholder="Masukkan Fee MBA"
                                        value="{{ old('fee_mba', $list->fee_mba ?? '') }}" required>
                                </div>
                                <div class="col-4 mb-5">
                                    <label class="form-label">Fee Mitra</label>
                                    <input type="text" class="form-control" name="fee_mitra"
                                        placeholder="Masukkan Fee Mitra"
                                        value="{{ old('fee_mitra', $list->fee_mitra ?? '') }}" required>
                                </div>
                            </div>

                            <!-- PIC & TELEPON -->
                            <label class="pic-telepon-label mb-3"><strong>PIC & TELEPON <span
                                        class="text-danger">*</span></strong></label>
                            <div class="col-4">
                                <label class="form-label">PIC Payment Mitra</label>
                                <input type="text" class="form-control" name="pic_payment_mitra"
                                    placeholder="Masukan PIC Payment Mitra"
                                    value="{{ old('pic_payment_mitra', $list->pic_payment_mitra ?? '') }}" required>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Telepon Payment Mitra</label>
                                <input type="text" class="form-control" name="telepon_payment_mitra"
                                    placeholder="Masukan Telepon Payment Mitra"
                                    value="{{ old('telepon_payment_mitra', $list->telepon_payment_mitra ?? '') }}"
                                    required>
                            </div>

                            <!-- PIC Rekon Mitra & Telepon Rekon Mitra -->
                            <div class="col-4 mb-3">
                                <label class="form-label">PIC Rekon Mitra</label>
                                <input type="text" class="form-control" name="pic_rekon_mitra"
                                    placeholder="Masukan PIC Rekon Mitra"
                                    value="{{ old('pic_rekon_mitra', $list->pic_rekon_mitra ?? '') }}" required>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Telepon Rekon Mitra</label>
                                <input type="text" class="form-control" name="telepon_rekon_mitra"
                                    placeholder="Masukan Telepon Rekon Mitra"
                                    value="{{ old('telepon_rekon_mitra', $list->telepon_rekon_mitra ?? '') }}"
                                    required>
                            </div>

                            <!-- PIC Dinas & Telepon Dinas -->
                            <div class="col-4">
                                <label class="form-label">PIC Dinas</label>
                                <input type="text" class="form-control" name="pic_dinas"
                                    placeholder="Masukan PIC Dinas"
                                    value="{{ old('pic_dinas', $list->pic_dinas ?? '') }}" required>
                            </div>
                            <div class="col-4 mb-5">
                                <label class="form-label">Telepon Dinas</label>
                                <input type="text" class="form-control" name="telepon_dinas"
                                    placeholder="Masukan Telepon Dinas"
                                    value="{{ old('telepon_dinas', $list->telepon_dinas ?? '') }}" required>
                            </div>

                            <!-- WAG Koordinasi Payment & Rekon -->
                            {{-- <div class="row mt-3"> --}}
                            <label class="cuttoff-settlement-label mb-3">
                                <strong>WAG Koordinasi Payment & Rekon <span class="text-danger">*</span></strong>
                            </label>
                            <div class="col-6">
                                <label class="form-label">WAG Koordinasi Payment</label>
                                <input type="text" class="form-control" name="wag_kordinasi_payment"
                                    placeholder="Masukan WAG Koordinasi Payment"
                                    value="{{ old('wag_kordinasi_payment', $list->wag_kordinasi_payment ?? '') }}"
                                    required>
                            </div>

                            <div class="col-6 mb-5">
                                <label class="form-label">WAG Koordinasi Rekon</label>
                                <input type="text" class="form-control" name="wag_kordinasi_rekon"
                                    placeholder="Masukan WAG Koordinasi Rekon"
                                    value="{{ old('wag_kordinasi_rekon', $list->wag_kordinasi_rekon ?? '') }}"
                                    required>
                            </div>
                        </div>
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
