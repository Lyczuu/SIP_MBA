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
@section('side9')
    collapsed
@endsection
@section('side10')
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


                            <!-- Tambah Modal -->
                            {{-- button modal --}}
                            <a class="card-title">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#basicModal">
                                    <i class="bi bi-plus-lg"> </i>
                                    Tambah
                                </button></a>
                            {{-- end button modal --}}
                            @include('admin2.modal.add_datapengguna')




                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama lengkap</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Dibuat</th>
                                            <th>Diubah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $key => $list)
                                            <tr>
                                                <td>{{ $list->username }}</td>
                                                <td>{{ $list->full_name }}</td>
                                                <td>{{ $list->alamat }}</td>
                                                <td>{{ $list->phone_number }}</td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->role->nama_role }}</td>
                                                <td>12/3/21</td>
                                                <td>12/3/26</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#Editdatapengguna{{ $list->id }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                                data-bs-target="#addwilayahtousers">
                                                                <i class="bi bi-crosshair2"> </i>
                                                            </button>
                                                            <button onclick="window.location='{{ route('user.wilayah') }}'" class="btn btn-primary">+</button>


                                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#hapusdatapengguna{{ $list->id }}">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('admin2.modal.add_wilayah_to_datapengguna')
                                            @include('admin2.modal.edit_datapengguna')
                                            @include('admin2.modal.delete_datapengguna')
                                        @endforeach

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
