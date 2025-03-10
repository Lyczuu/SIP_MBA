<!-- Modal -->
<div class="modal fade" id="Editwilayah{{$list->id}}" tabindex="-1" aria-labelledby="EditwilayahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form untuk edit mitra -->
            <form action="{{ route('update_wilayah', $list->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="EditwilayahLabel">Edit wilayah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_wilayah" class="form-label">Nama wilayah</label>
                        <input type="text" name="nama_wilayah" id="nama_wilayah"
                            class="form-control"
                            placeholder="Masukkan nama mitra"
                            value="{{ old('nama_wilayah', $list->nama_wilayah) }}" required>
                    </div>


                    <div class="mb-3">
                        <label for="kode_prov" class="form-label">Provinsi</label>
                        <select class="form-control" id="kode_prov" name="kode_prov" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinsi as $p)
                                <option value="{{ $p->kode_prov }}"
                                    {{ old('kode_prov', $list->kode_prov ?? '') == $p->kode_prov ? 'selected' : '' }}>
                                    {{ $p->nama_provinsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="mb-3">
                        <label for="kode_area" class="form-label">Kode area</label>
                        <input type="text" name="kode_area" id="kode_area"
                            class="form-control"
                            placeholder="Masukkan kode area"
                            value="{{ old('kode_area', $list->kode_area) }}" required>
                    </div>


                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
