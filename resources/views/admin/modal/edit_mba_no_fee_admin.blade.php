<!-- Modal -->
<div class="modal fade" id="Editnofee{{$list->id}}" tabindex="-1" aria-labelledby="EditnofeeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form untuk edit barang -->
            <form action="/update_nofee{{$list->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="EditbarangLabel">Edit pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Pengajuan</label>
                        <input type="text" name="kode_barang" id="kode_barang"
                            class="form-control"
                            placeholder="Masukkan kode barang"
                            value="{{$list->kode_pengajuan}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_wilayah" class="form-label">Nama wilayah</label>
                        <select name="nama_wilayah" id="nama_wilayah" class="form-control" required>
                            <option value="{{$list->wilayah->id}}" selected>
                                {{$list->wilayah->nama_wilayah}}
                            </option>


                            {{-- @foreach ($paymentmba as $paymentmbaiItem)
                                <option value="{{$paymentmbaItem->id}}">
                                    {{$listItem->nama_wilayah}}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name_user" class="form-label">Nama user</label>
                        <input type="text" name="name_user" id="name_user"
                            class="form-control"
                            placeholder="Masukkan nama user"
                            value="{{$list->user->name_user}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_pajak" class="form-label">jenis pajak</label>
                        <select name="jenis_pajak" id="jenis_pajak"
                            class="form-control" required>
                            <option value="{{$list->jenis_pajak_id}}" selected>
                                {{ $list->jenis_pajak ? $list->jenis_pajak->nama_jenis_pajak : 'Data Tidak Ditemukan' }}
                            </option>

                            @foreach ($paymentmba as $jenis_pajak_idItem)
                                <option value="{{$jenis_pajak_idItem->id}}">
                                    {{$jenis_pajak_idItem->nama_jenis_pajak}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" id="gambar"
                            class="form-control">
                        @if ($list->gambar)
                            <img src="{{ asset('path/to/gambar/'.$list->gambar) }}"
                                alt="Gambar {{$list->nama_barang}}"
                                class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" name="stok" id="stok"
                                    class="form-control"
                                    placeholder="Masukkan jumlah stok"
                                    value="{{$list->stok}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" name="harga" id="harga"
                                    class="form-control"
                                    placeholder="Masukkan harga barang"
                                    value="{{$list->harga}}" required>
                            </div>
                        </div>
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

{{-- @include('admin.payment_mba_no_fee_admin', ['data' => $paymentmba]) --}}
