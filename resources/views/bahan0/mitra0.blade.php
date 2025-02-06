@extends('layoutes.main0')

@section('side0')
    collapsed
@endsection
@section('side1')
    collapsed
@endsection
@section('side2')
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
            <h1>Mitra</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Mitra</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            &nbsp;
                            <h4 class="">Data Mitra</h4>
                            <br>
                            &nbsp;



                             <!-- Tambah Modal -->
                            {{-- button modal --}}
                            <a class="card-title">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#basicModal">
                                    <i class="bi bi-plus-lg"> </i>
                                    Tambah
                                </button></a>
                            {{-- end button modal --}}

                            <div class="modal fade" id="basicModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Data Mitra</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="col-13">
                                                <label for="inputPassword4" class="form-label">Nama Mitra</label>
                                                <input type="text" class="form-control" id="inputPassword4">
                                            </div>
                                            <br>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Basic Modal-->


                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                            <table class="table  datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>Nama Mitra</th>
                                        <th>Dibuat</th>
                                        <th>Diubah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Panti jompo</td>
                                        <td>12/3/21</td>
                                        <td>12/3/26</td>
                                        <td>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editfromrow"><i class="bi bi-pencil-square"></i></button>
                                                <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>Panti jompo</td>
                                        <td>12/3/21</td>
                                        <td>12/3/26</td>
                                        <td>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editfromrow"><i class="bi bi-pencil-square"></i></button>
                                                <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>


                                    {{-- modal edit --}}
                                    <div class="modal fade" id="editfromrow" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Mitra</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="col-13">
                                                        <label for="inputPassword4" class="form-label">Nama Mitra</label>
                                                        <input type="text" class="form-control" id="inputPassword4">
                                                    </div>
                                                    <br>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="button" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End  Modal edit-->

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
