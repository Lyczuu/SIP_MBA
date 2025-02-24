@extends('layout.am_wilayahfeelayout')

@section('side0', 'collapsed')
@section('side4', 'active')
@section('side2', 'collapsed')

@section('title', 'payment_mba_no_fee_admin')

@section('content')
<title>Form Integrasi Payment MBA no fee admin</title>
    <!-- Modal -->
    @if (Session::has('status'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('message') }}
    @endif


    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>


    @include('admin.modal.payment_mba_no_fee_admin_add')




@endsection
