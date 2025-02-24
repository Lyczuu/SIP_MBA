<!-- Modal -->
<div class="modal fade" id="Editjenistransaksi{{$list->id}}" tabindex="-1" aria-labelledby="EditjenistransaksiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form untuk edit mitra -->
            <form action="{{ route('update_datajenistransaksi', $list->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="EditmitraLabel">Edit Jenis transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_jenis_transaksi" class="form-label">Nama Jenis transaksi</label>
                        <input type="text" name="nama_jenis_transaksi" id="nama_jenis_transaksi"
                            class="form-control"
                            placeholder="Masukkan nama pajak"
                            value="{{ old('nama_jenis_transaksi', $list->nama_jenis_transaksi) }}" required>
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
