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
@section('side3')
    collapsed
@endsection
@section('side4')
    collapsed
@endsection



@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Pengguna</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            &nbsp;
                            <h4 class="">Data Pengguna</h4>
                            <br>
                            &nbsp;
                            <a href="{{route('index.penggunaadd0')}}" class="card-title"><button type="button" class="btn btn-primary"><i
                                class="bi bi-plus-lg"></i>Tambah</button></a>



                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                            <table class="table  datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Role</th>
                                        <th>Dibuat</th>
                                        <th>Diubah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>Mr.kevin69</td>
                                        <td>Kevin Firman Maulana</td>
                                        <td>Cipatik</th>
                                        <td>Kevinkn666@contoh.com</td>
                                        <td>089765768769</td>
                                        <td>Admin</td>
                                        <td>24/1/24</td>
                                        <td>24/1/27</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="{{route('index.detailuser0')}}"><button type="button" class="btn btn-dark btn-sm">Detail</button></a>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>Mr.kevin69</td>
                                        <td>Kevin Firman Maulana</td>
                                        <td>Cipatik</th>
                                        <td>Kevinkn666@contoh.com</td>
                                        <td>089765768769</td>
                                        <td>Admin</td>
                                        <td>24/1/24</td>
                                        <td>24/1/27</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="{{route('index.detailuser0')}}"><button type="button" class="btn btn-dark btn-sm">Detail</button></a>
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
