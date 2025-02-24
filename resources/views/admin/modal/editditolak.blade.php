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


                    <!-- Body Modal -->
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12 col-md-6">
                                <label for="kode_pengajuan" class="form-label">Kode Barang</label>
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
                                <label for="nama_mitra" class="form-label">Nama mitra</label>
                                <input type="text" name="nama_mitra" id="nama_mitra" class="form-control"
                                    placeholder="" value="{{ $list->mitra->nama_mitra }}" required>
                            </div>
                            {{-- end nama mitra --}}


                            <div class="col-12 col-md-6">
                                <label for="nama_wilayah" class="form-label">Nama wilayah</label>
                                <input type="text" name="nama_wilayah" id="nama_wilayah" class="form-control"
                                    placeholder="" value="{{ $list->wilayah->nama_wilayah }}" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="nama_jenis_pajak" class="form-label">jenis pajak</label>
                                <input type="text" name="nama_jenis_pajak" id="nama_jenis_pajak" class="form-control"
                                    placeholder="" value="{{ $list->jenis_pajak->nama_jenis_pajak }}" required>
                            </div>
                            {{-- end  jenis pajak --}}

                            <div class="col-12 col-md-6">
                                <label for="nama_jenis_transaksi" class="form-label">jenis transaksi</label>
                                <input type="text" name="nama_jenis_transaksi" id="nama_jenis_transaksi"
                                    class="form-control" placeholder=""
                                    value="{{ $list->jenis_transaksi->nama_jenis_transaksi }}" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="cutoff" class="form-label">Cutoff</label>
                                <input type="text" name="cutoff" id="cutoff" class="form-control" placeholder=""
                                    value="{{ $list->cutoff }}" required>
                            </div>
                            {{-- end  cutoff --}}

                            <div class="col-12 col-md-6">
                                <label for="settlemen" class="form-label">Settlemnet</label>
                                <input type="text" name="settlement" id="settlement" class="form-control"
                                    placeholder="" value="{{ $list->settlement }}" required>
                            </div>
                            {{-- end  settlement --}}

                            <div class="col-12 col-md-6">
                                <label for="nomor_registrasi_legal" class="form-label">Nomor Registrasi
                                    Legal</label>
                                <input type="text" name="nomor_registrasi_legal" id="nomor_registrasi_legal"
                                    class="form-control" placeholder="" value="{{ $list->nomor_registrasi_legal }}"
                                    required>
                            </div>
                            {{-- end  nomor registrasi legal --}}

                            <div class="col-12 col-md-6">
                                <label for="mitra_agg" class="form-label">Mitra agg</label>
                                <input type="text" name="mitra_agg" id="mitra_agg" class="form-control"
                                    placeholder="" value="{{ $list->mitra_agg }}" required>
                            </div>
                            {{-- end  mitra agg --}}

                            <div class="col-12 col-md-6">
                                <label for="pengajuan_integrasi" class="form-label">Pengajuan Integrasi</label>
                                <input type="text" name="pengajuan_integrasi" id="pengajuan_integrasi"
                                    class="form-control" placeholder="" value="{{ $list->pengajuan_integrasi }}"
                                    required>
                            </div>
                            {{-- end  pengajuan integrasi --}}

                            <div class="col-12 col-md-6">
                                <label for="total_fee" class="form-label">Total Fee</label>
                                <input type="text" name="total_fee" id="total_fee" class="form-control"
                                    placeholder="" value="{{ $list->fees->total_fee }}" required>
                            </div>
                            {{-- end  total fee --}}

                            <div class="col-12 col-md-6">
                                <label for="fee_mba" class="form-label">Fee Mba</label>
                                <input type="text" name="fee_mba" id="fee_mba" class="form-control"
                                    placeholder="" value="{{ $list->fees->fee_mba }}" required>
                            </div>
                            {{-- end  fee mba --}}

                            <div class="col-12 col-md-6">
                                <label for="fee_mitra" class="form-label">Fee Mba</label>
                                <input type="text" name="fee_mitra" id="fee_mitra" class="form-control"
                                    placeholder="" value="{{ $list->fees->fee_mitra }}" required>
                            </div>
                            {{-- end  fee mitra --}}

                            <div class="col-12 col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" name="status" id="status" class="form-control"
                                    placeholder="" value="{{ $list->status }}" disabled>
                            </div>
                            {{-- end  status --}}

                            <div class="col-12 col-md-6">
                                <label for="jenis_pengajuan" class="form-label">Jenis pengajuan</label>
                                <input type="text" name="jenis_pengajuan" id="jenis_pengajuan" class="form-control"
                                    placeholder="" value="{{ $list->status }}" disabled>
                            </div>
                            {{-- end  status --}}

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="pic_payment_mitra" class="form-label">Pic Payment Mitra</label>
                                    <input type="text" name="pic_payment_mitra" id="pic_payment_mitra"
                                        class="form-control" placeholder="" value="{{ $list->pic_payment_mitra }}"
                                        required>
                                </div>
                                {{-- end  pic_payment_mitra --}}

                                <div class="col-12 col-md-6">
                                    <label for="telepon_payment_mitra" class="form-label">Telepon Payment
                                      Mitra</label>
                                    <input type="text" name="telepon_payment_mitra" id="telepon_payment_mitra"
                                        class="form-control" placeholder=""
                                        value="{{ $list->telepon_payment_mitra }}" required>
                                </div>
                                {{-- end  telepon_payment_mitra --}}

                                <div class="col-12 col-md-6">
                                    <label for="pic_rekon_mitra" class="form-label">Pic Rekon Mitra</label>
                                    <input type="text" name="pic_rekon_mitra" id="pic_rekon_mitra"
                                        class="form-control" placeholder="" value="{{ $list->pic_rekon_mitra }}"
                                        required>
                                </div>
                                {{-- end  pic_rekon_mitra --}}

                                <div class="col-12 col-md-6">
                                    <label for="telepon_rekon_mitra" class="form-label">Telepon Rekon
                                        Mitra</label>
                                    <input type="text" name="telepon_rekon_mitra" id="telepon_rekon_mitra"
                                        class="form-control" placeholder="" value="{{ $list->telepon_rekon_mitra }}"
                                        required>
                                </div>
                                {{-- end  telepon_rekon_mitra --}}

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="pic_dinas" class="form-label">Pic Dinas</label>
                                        <input type="text" name="pic_dinas" id="pic_dinas" class="form-control"
                                            placeholder="" value="{{ $list->pic_dinas }}" required>
                                    </div>
                                    {{-- end  pic dinas --}}

                                    <div class="col-12 col-md-6">
                                        <label for="telepon_dinas" class="form-label">Telepon Dinas</label>
                                        <input type="text" name="telepon_dinas" id="telepon_dinas"
                                            class="form-control" placeholder="" value="{{ $list->telepon_dinas }}"
                                            required>
                                    </div>
                                    {{-- end  telepon dinas --}}

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="wag_kordinasi_payment" class="form-label">Wag Kordinasi
                                                Payment</label>
                                            <input type="text" name="wag_kordinasi_payment"
                                                id="wag_kordinasi_payment" class="form-control" placeholder=""
                                                value="{{ $list->wag_kordinasi_payment }}" required>
                                        </div>
                                        {{-- end  Wag Kordinasi Payment --}}

                                        <div class="col-12 col-md-6">
                                            <label for="wag_kordinasi_rekon" class="form-label">Wag Kordinasi
                                                Rekon</label>
                                            <input type="text" name="wag_kordinasi_rekon" id="wag_kordinasi_rekon"
                                                class="form-control" placeholder=""
                                                value="{{ $list->wag_kordinasi_rekon }}" required>
                                        </div>
                                        {{-- end  Wag Kordinasi Rekon --}}


                                        {{-- <div class="col-12 col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">-- Pilih Status --</option>
                                                <option value="2">Disetujui</option>
                                                <option value="1">Ditolak</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="alasan_penolakan" class="form-label">Alasan penolakan</label>
                                            <input type="text" name="alasan_penolakan" id="alasan_penolakan"class="form-control" placeholder="Masukan alasan ditolak" required>
                                        </div> --}}




                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <!-- Footer Modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>

                </form><!-- Vertical Form -->
            </div>
        </div>
        {{-- <script>
            document.getElementById('status').addEventListener('change', function() {
                if (this.value == '1','2') {
                    alasanPenolakanContainer.style.display = 'block';
                } else {
                    alasanPenolakanContainer.style.display = 'none';
                }
            });
        </script> --}}

