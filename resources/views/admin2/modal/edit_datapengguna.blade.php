<!-- Modal -->
<div class="modal fade" id="Editdatapengguna{{ $list->id }}" tabindex="-1" aria-labelledby="EditdatapenggunaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form untuk edit mitra -->
            <form action="{{ route('update_pengguna', $list->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="EditpenggunaLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder=""
                            value="{{ old('username', $list->username) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder=""
                            value="{{ old('full_name', $list->full_name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder=""
                            value="{{ old('alamat', $list->alamat) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">No Telepon</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder=""
                            value="{{ old('phone_number', $list->phone_number) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder=""
                            value="{{ old('email', $list->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Pilih Role</option>
                            @foreach ($role as $r)
                                <option value="{{ $r->id }}" {{ $list->role_id == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_role }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
