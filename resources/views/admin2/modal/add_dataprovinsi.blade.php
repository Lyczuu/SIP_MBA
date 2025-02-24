<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
                <form action="/godaw" method="post" enctype="multipart/form-data">
                    @csrf
                {{-- header --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Provinsi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_provinsi" class="form-label">Nama Provinsi</label>
                        <input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" value="{{ old('nama_provinsi') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="kode_prov" class="form-label">Kode Provinsi</label>
                        <input type="text" class="form-control" id="kode_prov" name="kode_prov" value="{{ old('kode_prov') }}" required>
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
