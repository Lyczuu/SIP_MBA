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
@section('content')
    <div class="pagetitle">
        <h1>Tambah Wilayah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengguna.baru') }}">Home</a></li>
                <li class="breadcrumb-item active">Wilayah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <!-- Modal -->
    @if (Session::has('status'))
    <div id="flash-message" class="alert alert-success" role="alert">
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
    }, 3000); // Ubah angka ini untuk durasi yang berbeda
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
                                <div class="col-md-4">
                                    <label for="searchProvinsi"><strong>Cari Provinsi / Wilayah:</strong></label>
                                    <input type="text" id="searchProvinsi" class="form-control" placeholder="Cari Provinsi atau Wilayah">
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

                            <table class="table">
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
                                            class="clickable-row"
                                            onclick="toggleCheckbox(this)">
                                            <td>{{ $w->kode_area }}</td>
                                            <td>{{ $w->nama_wilayah }}</td>
                                            <td>
                                                <input type="checkbox" name="wilayah_id[]" value="{{ $w->id }}"
                                                    {{ $isChecked ? 'checked disabled' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                        <script>
                            function toggleCheckbox(row) {
                                let checkbox = row.querySelector('input[type="checkbox"]');

                                if (!checkbox.disabled) {
                                    checkbox.checked = !checkbox.checked;
                                }
                            }
                        </script>
                        <script>
                            // Simpan daftar kode provinsi dari dropdown sebagai referensi pencarian
                            let provinsiOptions = {};
                            document.querySelectorAll('#kode_prov option').forEach(option => {
                                if (option.value) { // Hindari opsi "Semua Provinsi"
                                    provinsiOptions[option.textContent.toLowerCase()] = option.value;
                                }
                            });

                            // Filter berdasarkan dropdown Provinsi
                            document.getElementById('kode_prov').addEventListener('change', function() {
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
                            document.getElementById('searchProvinsi').addEventListener('input', function() {
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
                        </script>





                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
