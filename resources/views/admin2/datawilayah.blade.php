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
@section('side9')
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
        <h1>Wilayah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.utama') }}">Home</a></li>
                <li class="breadcrumb-item active">Wilayah</li>
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
                        <h5 class="card-title">Data <span>| Wilayah</span></h5>
                        &nbsp;

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


                        @include('admin2.modal.add_datawilayah')
                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Nama Wilayah</th>
                                        <th>Provinsi</th>
                                        <th>Kode Area</th>
                                        <th>Dibuat</th>
                                        <th>Diubah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wilayah as $key => $list)
                                        <tr>
                                            <td>{{ $list->nama_wilayah }}</td>
                                            <td>{{ $list->provinsi->nama_provinsi }}</td>
                                            <td>{{ $list->kode_area }}</td>
                                            <td>{{ $list->created_at->format('d-m-Y H:i') }}</td>
                                            <td>{{ $list->updated_at->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @if ($list->deleted_at)
                                                        <a href="{{ url('/wilayah/restore/' . $list->id) }}"
                                                            class="btn btn-success btn-sm">
                                                            <i class="bi bi-arrow-counterclockwise"></i> Restore
                                                        </a>
                                                    @else
                                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#Editwilayah{{ $list->id }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#hapuswilayah{{ $list->id }}">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                        @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @include('admin2.modal.edit_datawilayah')
                                        @include('admin2.modal.delete_datawilayah')
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
