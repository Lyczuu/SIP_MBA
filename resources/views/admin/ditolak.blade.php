@extends('layout.am_wilayahfeelayout')

@section('title', 'ditolak')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Halaman ditolak</h1>

        {{-- Jika ada pesan status --}}
        @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="" name="description">
  <meta content="" name="keywords">


  


</head>

<body>







    <section class="section">
        <div class="row">
          <div class="col-lg-12">


            <div class="card">
              <div class="card-body">
                <h5 class="card-title">data tabel </h5>
                <p>data tabel yang ditolak oleh admin </p>

                <!-- Table with stripped rows -->
                <div class="table-responsive">
                <table id="table-ditolak" class="table datatable">
                  <thead>
                    <tr>
                      <th>Pengajuan id</th>
                      <th>
                        <b>A</b>lasan penolakan
                      </th>
                      <th>Ditolak oleh</th>
                      <th>Tanggal ditolak</th>

                    </tr>
                  </thead>
                  <tbody>
                      @foreach($ditolak as $key => $list)
                    <tr>
                      <td>{{ $list->pengajuan_id }}</td>
                      <td>{{ $list->alasan_penolakan }}</td>
                      <td>{{ $list->ditolak_oleh }}</td>
                      <td>{{ $list->tanggal_ditolak }}</td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->

              </div>
            </div>

          </div>
        </div>
      </section>

    </main><!-- End #main -->

    <script>
        function updateNotifDitolak() {
            var table = document.getElementById("table-ditolak");
            if (table) {
                var rowCount = table.getElementsByTagName("tr").length - 1; // Kurangi header jika ada
                var prevCount = localStorage.getItem("countDitolak");

                // Update localStorage hanya jika ada perubahan
                if (rowCount != prevCount) {
                    localStorage.setItem("countDitolak", rowCount);
                }
            }
        }

        // Jalankan fungsi setiap 2 detik untuk update otomatis
        setInterval(updateNotifDitolak, 2000);

        // Jalankan saat halaman dimuat pertama kali
        document.addEventListener("DOMContentLoaded", updateNotifDitolak);
    </script>



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



</body>

</html>


    </div>
@endsection
