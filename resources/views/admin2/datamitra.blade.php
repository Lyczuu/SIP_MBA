@extends('layoutes.main0')

@section('side0')
    collapsed
@endsection
@section('side1')
    collapsed
@endsection

@section('side4')
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
@section('side9')
    collapsed
@endsection
@section('side10')
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
        <!-- Modal -->
        @if (Session::has('status'))
            <div id="flash-mitra" class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        <script>
            // Hilangkan flash message setelah 3 detik (3000 ms)
            setTimeout(() => {
                const flashMessage = document.getElementById('flash-mitra');
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
                            @include('admin2.modal.add_datamitra')
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table  datatable">
                                    <thead>
                                        <tr>
                                            <th>Nama Mitra</th>
                                            <th>Flag agg</th>
                                            <th>Flag bank</th>
                                            <th>Dibuat</th>
                                            <th>Diubah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mitra as $key => $list)
                                            <tr>
                                                <td>{{ $list->nama_mitra }}</td>
                                                <td>{{ $list->flag_agg }}</td>
                                                <td>{{ $list->flag_bank }}</td>
                                                <td>{{ $list->created_at }}</td>
                                                <td>{{ $list->updated_at }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#Editmitra{{ $list->id }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#hapusmitra{{ $list->id }}">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </td>

                                            </tr>
                                            @include('admin2.modal.edit_datamitra')
                                            @include('admin2.modal.delete_datamitra')
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
