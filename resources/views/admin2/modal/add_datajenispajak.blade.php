<form action="/datapajak" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- header --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Jenis pajak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="col-13">
                        <label for="nama_jenis_pajak" class="form-label">Nama pajak</label>
                        <input type="text" class="form-control" id="nama_jenis_pajak" name="nama_jenis_pajak">
                    </div>
                    <br>


                    <div class="col-13">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch d-flex align-items-center">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input" type="checkbox" id="statusCheckbox" name="status" value="1">
                            <span class="ms-2" id="statusText">Off</span> <!-- Ganti ID -->
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        function toggleStatus(status, statusSpan) {
                            status.addEventListener("change", function () {
                                statusSpan.textContent = this.checked ? "On" : "Off";
                            });

                            // Set status awal berdasarkan nilai default checkbox
                            statusSpan.textContent = status.checked ? "On" : "Off";
                        }

                        toggleStatus(
                            document.getElementById("statusCheckbox"),
                            document.getElementById("statusText")
                        );

                    });
                </script>



                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
