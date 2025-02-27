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
@section('side5')
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
@section('side4')
    collapsed
@endsection
@section('side11')
    collapsed
@endsection
@section('content')


        <div class="pagetitle">
            <h1>Provinsi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index.index0')}}">Home</a></li>
                    <li class="breadcrumb-item active">Provinsi</li>
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
                            <h4 class="">Data Provinsi</h4>
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


                            @include('admin2.modal.add_dataprovinsi')
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table  datatable">
                                    <thead>
                                        <tr>
                                            <th>Nama Provinsi</th>
                                            <th>Kode Provinsi</th>
                                            <th>Dibuat</th>
                                            <th>Diubah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($provinsi as $key => $list)
                                            <tr>
                                                <td>{{ $list->nama_provinsi }}</td>
                                                <td>{{ $list->kode_prov }}</td>
                                                <td>12/3/21</td>
                                                <td>12/3/26</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#Editprovinsi{{ $list->id }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#hapusprovinsi{{ $list->id }}">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('admin2.modal.edit_dataprovinsi')
                                            @include('admin2.modal.delete_dataprovinsi')
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


@endsection
