@extends('layout.am_wilayahfeelayout')

@section('side0')
    collapsed
@endsection
@section('side1')
    collapsed
@endsection

@section('side3')
    collapsed
@endsection
@section('side4')
    collapsed
@endsection
@section('side6')
    collapsed
@endsection
@section('side7')
    collapsed
@endsection
@section('side8')
    collapsed
@endsection
@section('side10')
    collapsed
@endsection
@section('side11')
    collapsed
@endsection
@section('side12')
    collapsed
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Data Wilayah To User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengguna.baru') }}">Home</a></li>
                <li class="breadcrumb-item active">Wilayah To User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    {{-- modal flash --}}
    @if (Session::has('status'))
        <div id="flash-message" class="alert alert-{{ Session::get('status') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <script>
        // Hilangkan flash message setelah 3 detik (3000 ms)
        setTimeout(() => {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.transition = 'opacity 0.5s ease';
                flashMessage.style.opacity = '0';
                setTimeout(() => flashMessage.remove(), 500); // Hapus dari DOM setelah fade-out
            }
        }, 3000);
    </script>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        &nbsp;


                        <!-- Table with stripped rows -->
                        <form class="row g-3" action="{{ route('data.gow') }}" method="POST">
                            @csrf


                            <div class="row">
                                <!-- Pilih User -->
                                <div class="col-md-4">
                                    <label for="user_id"><strong>User Yang Di Pilih</strong></label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach ($user as $u)
                                            <option value="{{ $u->id }}"
                                                {{ session('selected_user_id', request('user_id')) == $u->id ? 'selected' : '' }}>
                                                {{ $u->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <!-- Search Bar untuk Provinsi dan Wilayah -->
                                <div class="col-md-4" id="searchWilayahContainer" style="display: none;">
                                    <label for="searchProvinsi"><strong>Cari Wilayah:</strong></label>
                                    <input type="text" id="searchProvinsi" class="form-control" placeholder="Cari Wilayah">
                                </div>


                                <!-- Pilih Provinsi -->
                                <div class="col-md-4">
                                    <label for="kode_prov"><strong>Pilih Provinsi:</strong></label>
                                    <select name="kode_prov" id="kode_prov" class="form-control">
                                        <option value="">Semua Provinsi</option>
                                        @foreach ($provinsi as $p)
                                            <option value="{{ $p->kode_prov }}">{{ $p->nama_provinsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <br>

                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Kode Area</th>
                                        <th>Nama Wilayah</th>
                                        <th>Check</th>
                                    </tr>
                                </thead>
                                <tbody id="wilayahTable">
                                    @foreach ($wilayah as $w)
                                        @php
                                            $isChecked = in_array($w->id, $selectedWilayah);
                                        @endphp
                                        <tr data-kode-prov="{{ $w->kode_prov }}"
                                            data-nama-wilayah="{{ strtolower($w->nama_wilayah) }}"
                                            class="clickable-row">
                                            <td>{{ $w->kode_area }}</td>
                                            <td>{{ $w->nama_wilayah }}</td>
                                            <td>
                                                <input type="checkbox" name="wilayah_id[]" value="{{ $w->id }}"
                                                    {{ $isChecked ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
                           <div class="footer">
                            <button type="button" class="btn btn-danger" onclick="history.back()">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
{{-- <script>
                        //script check userwilayah
                        document.addEventListener("DOMContentLoaded", function () {
                            let form = document.querySelector("form");
                            let initialSelected = new Set();

                            // Simpan wilayah yang sudah tercentang saat halaman dimuat
                            document.querySelectorAll('input[name="wilayah_id[]"]:checked').forEach(cb => {
                                initialSelected.add(cb.value);
                            });


                            // Tambahkan event click ke seluruh baris agar bisa diklik
                            document.querySelectorAll('.clickable-row').forEach(row => {
                                let checkbox = row.querySelector('input[type="checkbox"]');

                                // Simpan status awal checkbox
                                if (checkbox) {
                                    checkbox.dataset.initialChecked = checkbox.checked;
                                }

                                row.addEventListener("click", function (event) {
                                    if (!event.target.matches('input[type="checkbox"]')) {
                                        let checkbox = this.querySelector('input[type="checkbox"]');
                                        if (checkbox) {
                                            // Jika ingin menghapus (uncheck) data lama, tampilkan peringatan
                                            if (!checkbox.checked && !confirm("Apakah Anda yakin ingin menghapus wilayah ini?")) {
                                                return;
                                            }

                                            // Jika ingin menghapus centang dari data yang sebelumnya sudah tercentang, beri peringatan
                                            if (checkbox.dataset.initialChecked === "true" && checkbox.checked) {
                                                if (!confirm("Apakah Anda yakin ingin menghapus data yang sebelumnya sudah dicentang?")) {
                                                    return;
                                                }
                                            }

                                            // Toggle checkbox
                                            checkbox.checked = !checkbox.checked;

                                            // Update status awal setelah perubahan
                                            checkbox.dataset.initialChecked = checkbox.checked;
                                        }
                                    }
                                });
                            });
                        </script

<script>
                            // Saat form disubmit, hanya kirim perubahan
                            form.addEventListener("submit", function (event) {
                                let selectedNow = new Set();
                                document.querySelectorAll('input[name="wilayah_id[]"]:checked').forEach(cb => {
                                    selectedNow.add(cb.value);
                                });

                                let toAdd = [...selectedNow].filter(id => !initialSelected.has(id));
                                let toRemove = [...initialSelected].filter(id => !selectedNow.has(id));

                                // Hapus semua input hidden sebelumnya
                                document.querySelectorAll('.hidden-wilayah').forEach(input => input.remove());

                                let hiddenContainer = document.createElement("div");
                                hiddenContainer.style.display = "none";

                                // Simpan wilayah yang masih dipilih
                                selectedNow.forEach(id => {
                                    let input = document.createElement("input");
                                    input.type = "hidden";
                                    input.name = "wilayah_id[]";
                                    input.value = id;
                                    input.classList.add("hidden-wilayah");
                                    hiddenContainer.appendChild(input);
                                });

                                form.appendChild(hiddenContainer);
                            });
                        });


                        //script search wilayah $ provinsi serta dropdown provinsi

                        // Simpan daftar kode provinsi dari dropdown sebagai referensi pencarian
                        let provinsiOptions = {};
                        document.querySelectorAll('#kode_prov option').forEach(option => {
                            if (option.value) { // Hindari opsi "Semua Provinsi"
                                provinsiOptions[option.textContent.toLowerCase()] = option.value;
                            }
                        });

                        // Filter berdasarkan dropdown Provinsi
                        document.getElementById('kode_prov').addEventListener('change', function () {
                            let selectedKodeProv = this.value;
                            let rows = document.querySelectorAll('#wilayahTable tr');

                            rows.forEach(row => {
                                let kodeProv = row.getAttribute('data-kode-prov');
                                row.style.display = (selectedKodeProv === "" || kodeProv === selectedKodeProv) ? "" :
                                    "none";
                            });

                            // Kosongkan input pencarian saat dropdown dipilih
                            document.getElementById('searchProvinsi').value = "";
                        });

                        // Filter berdasarkan input pencarian (Provinsi atau Wilayah)
                        document.getElementById('searchProvinsi').addEventListener('input', function () {
                            let filter = this.value.toLowerCase();
                            let matchedKodeProv = [];

                            // Cari di dropdown provinsi, cocokkan teks dengan input
                            Object.keys(provinsiOptions).forEach(nama_provinsi => {
                                if (nama_provinsi.includes(filter)) {
                                    matchedKodeProv.push(provinsiOptions[nama_provinsi]); // Simpan kode_prov yang cocok
                                }
                            });

                            let rows = document.querySelectorAll('#wilayahTable tr');

                            rows.forEach(row => {
                                let kodeProv = row.getAttribute('data-kode-prov');
                                let namaWilayah = row.getAttribute('data-nama-wilayah');

                                // Tampilkan jika kode_prov cocok atau nama wilayah cocok
                                let matchProvinsi = matchedKodeProv.includes(kodeProv);
                                let matchWilayah = namaWilayah.includes(filter);

                                row.style.display = (matchProvinsi || matchWilayah || filter === "") ? "" : "none";
                            });

                            // Reset dropdown provinsi agar tidak mengganggu pencarian
                            document.getElementById('kode_prov').value = "";
                        });
                    </script> --}}

                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
