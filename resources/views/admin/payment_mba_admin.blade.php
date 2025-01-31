@extends('layout.am_wilayahfeelayout')

@section('title', 'payment_mba_admin')

@section('content')
<title>Form Integrasi Payment MBA Fee Based (Admin)</title>
    <!-- Modal -->
    @if (Session::has('status'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('message') }}
    @endif

    @include('admin.modal.payment_mba_admin_add')

@endsection
