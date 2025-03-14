<!-- Modal -->
<div class="modal fade" id="Editrole{{ $list->id }}" tabindex="-1" aria-labelledby="EditroleLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form untuk edit mitra -->
            <form action="{{ route('update_role', $list->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="EditroleLabel">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="col-13 mb-3">
                        <label for="nama_role" class="form-label">Nama Role</label>
                        <input type="text" name="nama_role" id="nama_role" class="form-control"
                            placeholder="Masukkan nama role" value="{{ old('nama_role', $list->nama_role) }}"
                            required>
                    </div>

                    <div class="col-13 mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control"
                            placeholder="Masukkan keterangan" value="{{ old('keterangan', $list->keterangan) }}"
                            required>
                    </div>

                <br>
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
