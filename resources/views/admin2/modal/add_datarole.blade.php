<form action="/role" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- header --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="col-13">
                        <label for="nama_role" class="form-label">Nama Role</label>
                        <input type="text" class="form-control" id="nama_role" name="nama_role" required>
                    </div>
                    <br>

                    <div class="col-13">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>

                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
