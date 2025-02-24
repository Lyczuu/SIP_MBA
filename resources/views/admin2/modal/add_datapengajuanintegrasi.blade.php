<form action="/datapengajuan" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                  {{-- header --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="HpauspengajuanLabel">Tambah Pengajuan Integrasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="col-13">
                        <label for="nama_pengajuan_integrasi" class="form-label">Nama Pengajuan Integrasi</label>
                        <input type="text" class="form-control" id="nama_pengajuan_integrasi" name="nama_pengajuan_integrasi">
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
