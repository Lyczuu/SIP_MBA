@extends('layout.am_wilayahfeelayout')

@section('side0', 'collapsed')
@section('side1', 'collapsed')
@section('side2', 'collapsed')
@section('side3', 'collapsed')
@section('side8', 'collapsed')
@section('side9', 'collapsed')

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
