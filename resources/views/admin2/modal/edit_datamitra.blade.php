<!-- Modal -->
<div class="modal fade" id="Editmitra{{ $list->id }}" tabindex="-1" aria-labelledby="EditmitraLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form untuk edit mitra -->
            <form action="{{ route('update_mitra', $list->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="EditmitraLabel">Edit Mitra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="col-13 mb-3">
                        <label for="nama_mitra" class="form-label">Nama Mitra</label>
                        <input type="text" name="nama_mitra" id="nama_mitra" class="form-control"
                            placeholder="Masukkan nama mitra" value="{{ old('nama_mitra', $list->nama_mitra) }}"
                            required>
                    </div>


                    <div class="col-13 mb-3">
                        <label class="form-label">Sebagai Agg</label>
                        <div class="form-check form-switch d-flex align-items-center">
                            <input type="hidden" name="flag_agg" value="0">
                            <input class="form-check-input" type="checkbox" id="flag_agg{{ $list->id }}"
                                name="flag_agg" value="1"
                                {{ old('flag_agg', $list->flag_agg) == 1 ? 'checked' : '' }}>
                            <span class="ms-2" id="flag_agg{{ $list->id }}_status">
                                {{ old('flag_agg', $list->flag_agg) == 1 ? 'Aktif' : 'Off' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-13">
                        <label class="form-label">Sebagai Bank</label>
                        <div class="form-check form-switch d-flex align-items-center">
                            <input type="hidden" name="flag_bank" value="0">
                            <input class="form-check-input" type="checkbox" id="flag_bank{{ $list->id }}"
                                name="flag_bank" value="1"
                                {{ old('flag_bank', $list->flag_bank) == 1 ? 'checked' : '' }}>
                            <span class="ms-2" id="flag_bank{{ $list->id }}_status">
                                {{ old('flag_bank', $list->flag_bank) == 1 ? 'Aktif' : 'Off' }}
                            </span>
                        </div>
                    </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        document.querySelectorAll(".form-check-input").forEach(function (checkbox) {
                            let statusSpan = document.getElementById(checkbox.id + "_status");

                            if (statusSpan) {
                                checkbox.addEventListener("change", function () {
                                    statusSpan.textContent = this.checked ? "Aktif" : "Off";
                                });

                                // Set status awal berdasarkan nilai default checkbox
                                statusSpan.textContent = checkbox.checked ? "Aktif" : "Off";
                            }
                        });
                    });
                </script>
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
