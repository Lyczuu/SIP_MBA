<!-- resources/views/success.blade.php -->

@extends('layout.secondmainlayout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Card for Success Message -->
                <div class="card shadow-lg border-success">
                    <div class="card-header bg-success text-white text-center">
                        <h3><i class="bi bi-check-circle"></i> Success!</h3>
                    </div>
                    <div class="card-body text-center">
                        <p class="lead">Data Anda berhasil disimpan dengan sukses!</p>
                        <div class="mt-4">
                            <a href="{{ route('admin.payment_mba_no_fee_admin') }}" class="btn btn-lg btn-success">
                                <i class="bi bi-house-door"></i> Kembali ke Halaman Utama
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
