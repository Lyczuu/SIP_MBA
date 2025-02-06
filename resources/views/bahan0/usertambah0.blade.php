@extends('layoutes.main0')

@section('side0')
    collapsed
@endsection
@section('side1')
    collapsed
@endsection
@section('side2')
    collapsed
@endsection
@section('side3')
    collapsed
@endsection
@section('side4')
    collapsed
@endsection




@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Tambah Pengguna</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pengguna</li>
          <li class="breadcrumb-item active">Tambah Pengguna</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">


        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">



                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Tambah Pengguna</button>
                </li>


              </ul>
              <div class="tab-content pt-2">

                {{-- start insert data --}}
                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- user add form-->
                  <form>


                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="Mr.kevin69">
                      </div>
                    </div>


                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="fullName" type="text" class="form-control" id="fullName" value="Kevin Firman Maulana">
                        </div>
                      </div>


                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="fullName" type="text" class="form-control" id="fullName" value="cipatik">
                        </div>
                      </div>


                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">No Telepon</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="fullName" type="text" class="form-control" id="fullName" value="0896573748">
                        </div>
                      </div>


                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="fullName" type="text" class="form-control" id="fullName" value="kevinkn666@contoh.com">
                        </div>
                      </div>


                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Role</label>
                        <div class="col-md-8 col-lg-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Admin</option>
                                <option value="1">User</option>
                              </select>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Password</label>
                        <div class="col-md-8 col-lg-3">
                          <input name="fullName" type="password" class="form-control" id="Password" value="">
                        </div>
                      </div>


                    <div class="text-end">
                      <button type="reset" class="btn btn-danger">Reset</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form><!-- End user add form -->
                </div>

                {{-- break insert --}}


              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>

        <div class="col-xl-4">

            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                <img src="btc/assets/img/default-avatar.png" alt="Profile" class="rounded-circle">
                <p></p>
                <p></p>
                <p></p>
                <p></p>
              </div>
            </div>

          </div>
      </div>
    </section>

  </main><!-- End #main -->

  @endsection
