
<!-- Modal -->
<div class="modal fade" id="Editpengajuan{{$list->id}}" tabindex="-1" aria-labelledby="EditpengajuanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form untuk edit mitra -->
            <form action="{{ route('update_datapengajuanintegrasi', $list->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="EditmitraLabel">Edit Pengajuan Integrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_pengajuan_integrasi" class="form-label">Nama Pengajuan Integrasi</label>
                        <input type="text" name="nama_pengajuan_integrasi" id="nama_pengajuan_integrasi"
                            class="form-control"
                            placeholder="Masukkan nama Pengajuan Integrasi"
                            value="{{ old('nama_pengajuan_integrasi', $list->nama_pengajuan_integrasi) }}" required>
                    </div>
                </div>

                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
