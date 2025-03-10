<form action="/masuk" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- header --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Mitra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="col-13">
                        <label for="nama_mitra" class="form-label">Nama Mitra</label>
                        <input type="text" class="form-control" id="nama_mitra" name="nama_mitra">
                    </div>
                    <br>

                    <div class="col-13">
                        <label class="form-label">Sebagai Agg</label>
                        <div class="form-check form-switch d-flex align-items-center">
                            <input type="hidden" name="flag_agg" value="0">
                            <input class="form-check-input" type="checkbox" id="flag_agg" name="flag_agg" value="1">
                            <span class="ms-2" id="flag_agg_status">Off</span>
                        </div>
                    </div>

                    <div class="col-13">
                        <label class="form-label">Sebagai Bank</label>
                        <div class="form-check form-switch d-flex align-items-center">
                            <input type="hidden" name="flag_bank" value="0">
                            <input class="form-check-input" type="checkbox" id="flag_bank" name="flag_bank" value="1">
                            <span class="ms-2" id="flag_bank_status">Off</span>
                        </div>
                    </div>


                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            function toggleFlag(flag, statusSpan) {
                                flag.addEventListener("change", function () {
                                    statusSpan.textContent = this.checked ? "On" : "Off";
                                });

                                // Set status awal berdasarkan nilai default checkbox
                                statusSpan.textContent = flag.checked ? "On" : "Off";
                            }

                            toggleFlag(document.getElementById("flag_agg"), document.getElementById("flag_agg_status"));
                            toggleFlag(document.getElementById("flag_bank"), document.getElementById("flag_bank_status"));
                        });
                    </script>

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
