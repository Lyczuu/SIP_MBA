<!-- Modal -->
<div class="modal fade" id="Editjenispajak{{$list->id}}" tabindex="-1" aria-labelledby="EditjenispajakLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Form untuk edit mitra -->
            <form action="{{ route('update_datajenispajak', $list->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="EditmitraLabel">Edit Pajak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_jenis_pajak" class="form-label">Nama Pajak</label>
                        <input type="text" name="nama_jenis_pajak" id="nama_jenis_pajak"
                            class="form-control"
                            placeholder="Masukkan nama pajak"
                            value="{{ old('nama_jenis_pajak', $list->nama_jenis_pajak) }}" required>
                    </div>


                    <div class="col-13">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch d-flex align-items-center">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input" type="checkbox" id="statusCheckbox{{$list->id}}" name="status" value="1" {{ $list->status ? 'checked' : '' }}>
                            <span class="ms-2" id="statusText{{$list->id}}">{{ $list->status ? 'On' : 'Off' }}</span>
                        </div>
                    </div>
                

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
                            let id = checkbox.id.replace('statusCheckbox', '');
                            let statusSpan = document.getElementById("statusText" + id);

                            checkbox.addEventListener("change", function () {
                                statusSpan.textContent = this.checked ? "On" : "Off";
                            });

                            // Set status awal berdasarkan nilai default checkbox
                            statusSpan.textContent = checkbox.checked ? "On" : "Off";
                        });
                    });
                </script>

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
