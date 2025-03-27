@extends('layout.am_wilayahfeelayout')

@section('side0', 'collapsed')
@section('side4', 'active')
@section('side2', 'collapsed')

@section('title', 'payment_mba_no_fee_admin')

@section('content')
    <div class="pagetitle">
        <h1>Pengajuan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan') }}">Home</a></li>
                <li class="breadcrumb-item active">Form Integrasi Payment MBA No Fee Based (admin)</li>
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


    @include('admin.modal.payment_mba_no_fee_admin_add')




@endsection
