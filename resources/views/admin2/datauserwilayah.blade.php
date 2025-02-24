@extends('layoutes.main0')

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

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Wilayah</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Wilayah</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            &nbsp;
                            {{-- <h6>{{ auth()->user()->full_name }}</h6> --}}


                            <!-- Table with stripped rows -->
                            <form action="{{ route('assign.wilayah') }}" method="POST">
                                @csrf

                                <!-- Pilih user yang ingin diberikan wilayah -->
                                <label for="user_id">Pilih User:</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}">{{ $u->username }}</option>
                                    @endforeach
                                </select>

                                <br>

                                <!-- Pilih Provinsi untuk Filter -->
                                <label for="kode_prov">Pilih Provinsi:</label>
                                <select name="kode_prov" id="kode_prov" class="form-control">
                                    <option value="">Semua Provinsi</option>
                                    @foreach ($provinsi as $p)
                                        <option value="{{ $p->kode_prov }}">{{ $p->nama_provinsi }}</option>
                                    @endforeach
                                </select>

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
                                            <tr data-kode-prov="{{ $w->kode_prov }}">
                                                <td>{{ $w->kode_area }}</td>
                                                <td>{{ $w->nama_wilayah }}</td>
                                                <td>
                                                    <input type="checkbox" name="wilayah_id[]" value="{{ $w->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>

                            <script>
                                document.getElementById('kode_prov').addEventListener('change', function() {
                                    let selectedKodeProv = this.value;
                                    let rows = document.querySelectorAll('#wilayahTable tr');

                                    rows.forEach(row => {
                                        let kodeProv = row.getAttribute('data-kode-prov');
                                        if (selectedKodeProv === "" || kodeProv === selectedKodeProv) {
                                            row.style.display = "";
                                        } else {
                                            row.style.display = "none";
                                        }
                                    });
                                });
                            </script>

                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
