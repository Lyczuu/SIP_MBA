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
                                <div class="col-md-4">
                                    <label for="searchProvinsi"><strong>Cari Provinsi / Wilayah:</strong></label>
                                    <input type="text" id="searchProvinsi" class="form-control"
                                        placeholder="Cari Provinsi atau Wilayah">
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
                                            data-nama-wilayah="{{ strtolower($w->nama_wilayah) }}" class="clickable-row"
                                            onclick="toggleCheckbox(this)">
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


                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
