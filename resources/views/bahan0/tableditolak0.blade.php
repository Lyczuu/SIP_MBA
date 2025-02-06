@extends('layoutes.main0')

@section('side0')
    collapsed
@endsection
@section('side2')
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
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                        &nbsp;
                            <h4 class="">Data Ditolak</h4>
                            <br>
                            &nbsp;
                            <a href="{{route('index.tablelist0')}}" class="card-title"><button type="button" class="btn btn-warning"><i
                                class="bi bi-plus-lg"></i> Diajukan</button></a>


                            <a href="{{route('index.tbtolak0')}}" class="card-title"><button type="button" class="btn btn-danger"><i
                                        class="bi bi-plus-lg"></i> Ditolak</button></a>


                            <a href="{{route('index.tbsetuju0')}}" class="card-title"><button type="button" class="btn btn-success"><i
                                        class="bi bi-plus-lg"></i> Disetujui</button></a>
                            <br>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Pengajuan</th>
                                            <th>Nama AM</th>
                                            <th>diajukan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Kode Pengajuan</td>
                                            <td>Nama AM</td>
                                            <td>diajukan</td>

                                            <td><span class="badge bg-danger">Ditolak</span></td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="{{route('index.detail0')}}"><button type="button" class="btn btn-dark btn-sm">Detail</button></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Kode Pengajuan</td>
                                            <td>Nama AM</td>
                                            <td>diajukan</td>


                                            <td><span class="badge bg-danger">Ditolak</span></td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="{{route('index.detail0')}}"><button type="button" class="btn btn-dark btn-sm">Detail</button></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
