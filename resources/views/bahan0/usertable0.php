@extends('layoutes.main0')

@section('side0')
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
@section('side5')
    collapsed
@endsection


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                        &nbsp;
                            <h4 class="">Data Diajukan</h4>
                            <br>
                            <a href="{{route('index.tablelist0')}}" class="card-title"><button type="button" class="btn btn-warning"><i
                                class="bi bi-plus-lg"></i> Diajukan</button></a>


                            <a href="{{route('index.tbtolak0')}}" class="card-title"><button type="button" class="btn btn-danger"><i
                                        class="bi bi-plus-lg"></i> Ditolak</button></a>


                            <a href="{{route('index.tbsetuju0')}}" class="card-title"><button type="button" class="btn btn-success"><i
                                        class="bi bi-plus-lg"></i> Diterima</button></a>
                            <br>

                            <!-- Table with stripped rows -->
                            <table class="table  datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>N</b>ame
                                        </th>
                                        <th>Ext.</th>
                                        <th>City</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Unity Pugh</td>
                                        <td>9958</td>
                                        <td>Curicó</td>
                                        <td>2005/02/11</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="{{route('index.detail0')}}"><button type="button" class="btn btn-dark btn-sm">Detail</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Theodore Duran</td>
                                        <td>8971</td>
                                        <td>Dhanbad</td>
                                        <td>1999/04/07</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="{{route('index.detail0')}}"><button type="button" class="btn btn-dark btn-sm">Detail</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
