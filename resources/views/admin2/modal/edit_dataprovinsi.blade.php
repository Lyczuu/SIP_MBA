<!-- Modal -->
<div class="modal fade" id="Editprovinsi{{$list->id}}" tabindex="-1" aria-labelledby="EditprovinsiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form untuk edit mitra -->
            <form action="{{ route('update_provinsi', $list->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="EditprovinsiLabel">Edit Provinsi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_provinsi" class="form-label">Nama provinsi</label>
                        <input type="text" name="nama_provinsi" id="nama_provinsi"
                            class="form-control"
                            placeholder="Masukkan nama mitra"
                            value="{{ old('nama_provinsi', $list->nama_provinsi) }}" required>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_prov" class="form-label">Kode Provinsi</label>
                        <input type="text" name="kode_prov" id="kode_prov"
                            class="form-control"
                            placeholder="Masukkan kode prov"
                            value="{{ old('kode_prov', $list->kode_prov) }}" required>
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
