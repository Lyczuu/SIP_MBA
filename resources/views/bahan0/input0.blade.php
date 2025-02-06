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
@section('side5')
    collapsed
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Input</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index.index0') }}">Home</a></li>
                    <li class="breadcrumb-item active">Input</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Fee Based (Admin)</h5>

                <!-- Vertical Form -->
                <form class="row g-3">
                    <div class="col-3">
                        <label for="inputNanme4" class="form-label">Nama wilayah</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="0">one</option>
                            <option value="1">two</option>
                          </select>
                    </div>
                    <div class="col-3">
                        <label for="inputEmail4" class="form-label">Nama Mitra</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="0">one</option>
                            <option value="1">two</option>
                          </select>
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">Jenis Pajak</label>
                        <div class="form-control">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> PBB INDIVIDU</label>&nbsp&nbsp
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                            <label for="vehicle2"> PBB KOLEKTIF</label>&nbsp&nbsp
                            <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                            <label for="vehicle3"> BPHTB</label>&nbsp&nbsp
                            <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                            <label for="vehicle3"> PDL</label>&nbsp&nbsp
                            <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                            <label for="vehicle3"> RETRIBUSI</label>&nbsp&nbsp
                            </div>
                    </div>
                    {{-- break --}}
                    <div class="col-3">
                        <label for="inputPassword4" class="form-label">Pengajuan Integrasi</label>
                        <div class="form-control">

                                <input class="form-check-input" type="radio" name="gridRadio" id="gridRadios1" value="option1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                  DEVELOPMENT
                                </label>
                                &nbsp;&nbsp;

                                <input class="form-check-input" type="radio" name="gridRadio" id="gridRadios2" value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                  SIT
                                </label>

                    </div>
                    </div>

                    <div class="col-6">
                        <label for="inputPassword4" class="form-label">Jenis Transaksi</label>

                        <div class="form-control">

                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                  H2H (HOST TO HOST)
                                </label>
                                &nbsp;&nbsp;

                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                  VA
                                </label>
                                &nbsp;&nbsp;

                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                  QRIS
                                </label>
                                &nbsp;&nbsp;

                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                  AGGREGATOR
                                </label>
                                &nbsp;&nbsp;
                              {{-- <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios" value="option" disabled>
                                <label class="form-check-label" for="gridRadios3">
                                  Third disabled radio
                                </label>
                              </div> --}}

                    </div>
                    </div>
                    <div class="col-3">
                        <label for="inputPassword4" class="form-label">Tambahan Agregator</label>
                        <input type="text" class="form-control" id="inputPassword4" disabled>
                    </div>
                    {{-- break --}}
                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Cutoff</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Settlement</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Nomor registrasi legal</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    {{-- break --}}
                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Fee Mba</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Fee Mitra</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Total Fee</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                {{-- break --}}

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Pic Payment Mitra</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Telepon Payment Mitra</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>
<br>

                    {{--break  --}}

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Pic Rekon Mitra</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Telepon Rekon Mitra</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>
<br>
                    {{-- break --}}

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Pic Dinas</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Telepon Dinas</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>
<br>
                    {{-- break --}}

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Wag Koordinasi Payment</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-4">
                        <label for="inputPassword4" class="form-label">Wag koordinasi rekon</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>

                    {{-- break --}}



                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>

                </form><!-- Vertical Form -->

            </div>
        </div>
    </main>
@endsection
