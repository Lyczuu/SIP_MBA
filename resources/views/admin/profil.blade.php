@extends('layout.am_wilayahfeelayout')

@section('title', 'profil')

@section('content')
<title>Form Integrasi Payment MBA Fee Based (Admin)</title>
    <!-- Modal -->
    @if (Session::has('status'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('message') }}
    @endif

    @include('admin.modal.profil_add')

@endsection
