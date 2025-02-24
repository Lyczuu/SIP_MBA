<div class="modal fade" id="addwilayahtousers" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/gow" method="post">
                @csrf
                {{-- header --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Wilayah ke User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Pilih User --}}
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pilih User</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            <option value="" disabled selected>Pilih User</option>
                            @foreach ($user as $u)
                                <option value="{{ $u->id }}">{{ $u->username }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih Wilayah --}}
                    <div class="mb-3">
                        <label for="wilayah_id" class="form-label">Pilih Wilayah</label>
                        <select class="form-select" id="wilayah_id" name="wilayah_id" required>
                            <option value="" disabled selected>Pilih Wilayah</option>
                            @foreach ($wilayah as $w)
                                <option value="{{ $w->id }}">{{ $w->nama_wilayah }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
