<!-- Modal -->
<div class="modal fade" id="Editmitra{{$list->id}}" tabindex="-1" aria-labelledby="EditmitraLabel" aria-hidden="true">

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
                        <input type="text" name="nama_mitra" id="nama_mitra"
                            class="form-control"
                            placeholder="Masukkan nama mitra"
                            value="{{ old('nama_mitra', $list->nama_mitra) }}" required>
                    </div>



                <div class="col-13 mb-3">
                    <label for="flag_agg" class="form-label">Flag Agg</label>
                    <div class="form-check form-switch">
                        <input type="hidden" name="flag_agg" value="0"> <!-- Hidden input -->
                        <input class="form-check-input" type="checkbox" id="flag_agg" name="flag_agg" value="1">
                        <label class="form-check-label" for="flag_agg">On</label>
                    </div>
                </div>

                <div class="col-13">
                    <label for="flag_bank" class="form-label">Flag Bank</label>
                    <div class="form-check form-switch">
                        <input type="hidden" name="flag_bank" value="0"> <!-- Hidden input -->
                        <input class="form-check-input" type="checkbox" id="flag_bank" name="flag_bank" value="1">
                        <label class="form-check-label" for="flag_bank">On</label>
                    </div>
                </div>


                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        let flagAgg = document.getElementById("flag_agg");
                        let labelAgg = document.querySelector("label[for='flag_agg']");
                        let flagBank = document.getElementById("flag_bank");
                        let labelBank = document.querySelector("label[for='flag_bank']");

                        function toggleFlag(flag, label) {
                            flag.addEventListener("change", function () {
                                if (this.checked) {
                                    this.value = 1;
                                    label.textContent = "On";
                                } else {
                                    this.value = 0;
                                    label.textContent = "Off";
                                }
                            });
                        }

                        toggleFlag(flagAgg, labelAgg);
                        toggleFlag(flagBank, labelBank);
                    });
                </script>
                </div>
                <br>



                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
