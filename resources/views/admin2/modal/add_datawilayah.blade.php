<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
                <form action="/gowlet" method="post" enctype="multipart/form-data">
                    @csrf
                {{-- header --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data wilayah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_wilayah" class="form-label">Nama Wilayah</label>
                        <input type="text" class="form-control" id="nama_wilayah" name="nama_wilayah" value="{{ old('nama_wilayah') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="kode_prov" class="form-label">Kode Provinsi</label>
                        <select class="form-control" id="kode_prov" name="kode_prov" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinsi as $p)
                                <option value="{{ $p->kode_prov }}">{{ $p->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kode_area" class="form-label">Kode Area</label>
                        <input type="text" class="form-control" id="kode_area" name="kode_area" value="{{ old('kode_area') }}" required>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
