<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <meta content="" name="description">
    <meta content="" name="keywords">

</head>

<body>
    @if (session('error'))
    <div id="alert-error" class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('status') == 'success')
    <div id="alert-success" class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

{{-- Script untuk sembunyikan alert setelah 5 detik --}}
<script>
    setTimeout(function() {
        const alertError = document.getElementById('alert-error');
        const alertSuccess = document.getElementById('alert-success');

        if (alertError) {
            alertError.style.display = 'none';
        }
        if (alertSuccess) {
            alertSuccess.style.display = 'none';
        }
    }, 5000); // 5000 ms = 5 detik
</script>



    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <div class="mb-3 text-center">
                            <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('default-profile.png') }}"
                                alt="Foto Profil" class="rounded-circle">

                        </div>

                        <h2>{{ auth()->user()->full_name }}</h2>
                        <h3>{{ auth()->user()->role->nama_role }}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic">{{ auth()->user()->role->keterangan }}</p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Username</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->username }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->full_name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->alamat }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No Telepon</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->phone_number }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                </div>

                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <form action="{{ route('profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Input untuk Gambar -->
                                    <div class="row mb-3">
                                        <label for="profile_image" class="col-md-4 col-lg-3 col-form-label">Foto
                                            Profil</label>
                                        <div class="col-md-8 col-lg-9">
                                            <!-- Preview Gambar Sebelum Upload -->
                                            <div class="mb-2">
                                                <img id="preview-image"
                                                    src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('default-avatar.png') }}"
                                                    alt="Profile Image" width="150">
                                            </div>

                                            <input type="file" name="profile_image" id="profile_image"
                                                class="form-control @error('profile_image') is-invalid @enderror">
                                            @error('profile_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Password
                                            (Opsional)</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password_confirmation"
                                            class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation" name="password_confirmation">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            <script>
                                document.getElementById('profile_image').addEventListener('change', function(event) {
                                    const reader = new FileReader();
                                    reader.onload = function() {
                                        document.getElementById('preview-image').src = reader.result;
                                    };
                                    reader.readAsDataURL(event.target.files[0]);
                                });
                            </script>

                        </div>

                    </div>
                </div>
    </section>

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

</body>

</html>
