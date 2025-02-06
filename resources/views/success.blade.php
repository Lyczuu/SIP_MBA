<!-- resources/views/success.blade.php -->

@extends('layout.am_wilayahfeelayout')

@section('content')

     <!-- Toast Container -->
     <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var toastEl = document.getElementById("successToast");
            var successToast = new bootstrap.Toast(toastEl);
            successToast.show();

            // Redirect ke URL tujuan setelah toast hilang
            setTimeout(function() {
                window.location.href = "{{ session('redirectUrl') }}";
            }, 3000);
        });
    </script>
@endsection
