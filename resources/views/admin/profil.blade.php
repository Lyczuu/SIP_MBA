@extends('layout.am_wilayahfeelayout')

@section('side0', 'collapsed')
@section('side1', 'collapsed')
@section('side2', 'collapsed')
@section('side3', 'collapsed')
@section('side8', 'collapsed')
@section('side9', 'collapsed')
@section('side10', 'collapsed')
@section('side4', 'collapsed')
@section('side6', 'collapsed')
@section('side7', 'collapsed')
@section('side11', 'collapsed')
@section('side5', 'collapsed')

@section('title', 'profil')

@section('content')

<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
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


    @include('admin.modal.edit_profil')

@endsection
