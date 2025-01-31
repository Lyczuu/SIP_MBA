<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login - oi</title>

  <!-- Favicons -->
  <link href="V-TAX/img/V-TAX.png" rel="icon">
  <link href="V-TAX/img/V-TAX.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="V-TAX/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="V-TAX/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="V-TAX/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="V-TAX/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="V-TAX/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="V-TAX/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="V-TAX/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="V-TAX/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <img src="V-TAX/img/V-TAX.png" alt="" style="height: 80px; width: 150px;">
              <div class="d-flex justify-content-center py-2 ">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  {{-- <img src="V-TAX/img/V-TAX.png" alt="" style="height: 300px; width: 250px;"> --}}
                </a>
              </div><!-- End Logo -->
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your 0</h5>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>

                  <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control" id="yourEmail" value="{{ old('email') }}" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                      @error('email')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                      @error('password')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      {{-- <p class="small mb-0">Don't have an account? <a href="{{ route('register') }}">Create an account</a></p> --}}
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="V-TAX/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="V-TAX/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="V-TAX/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="V-TAX/js/main.js"></script>

</body>

</html>
