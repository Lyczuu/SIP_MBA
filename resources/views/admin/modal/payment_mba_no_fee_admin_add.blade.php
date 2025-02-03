
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .form-select,
        .form-check-input,
        .form-control {
            border-radius: 6px;
        }  .btn-primary {
            width: 100%;
            border-radius: 6px;
        }

        .form-check-label {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-5">
        <h3>Form Integrasi Payment MBA No Fee Base(admin)</h3>
        <form action="/submit" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Dropdown Wilayah -->
            <div class="mb-3">
                <label for="wilayah" class="form-label">Nama Wilayah</label>
                <select id="wilayah" name="wilayah_id" class="form-select" required>
                    @foreach ($wilayah as $w)
                        <option value="{{ $w->id }}">{{ $w->nama_wilayah }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Mitra -->
            <div class="mb-3">
                <label for="mitra" class="form-label">Nama Mitra</label>
                <select id="mitra" name="mitra_id" class="form-select" required>
                    @foreach ($mitra as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_mitra }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pengajuan Integrasi -->
            <div class="mb-3">
                <label class="form-label">Pengajuan Integrasi</label>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Pengajuan_integrasi" id="development"
                            value="Development" required>
                        <label class="form-check-label" for="development">Development</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Pengajuan_integrasi" id="sit"
                            value="SIT" required>
                        <label class="form-check-label" for="sit">SIT</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Pajak <span class="text-danger">*</span></label>
                <div>
                    @foreach ($jenis_pajak as $jak)
                        <div class="form-check">
                            <input type="checkbox" name="jenis_pajak[]" value="{{ $jak->id }}"
                                class="form-check-input" id="jenis_pajak_{{ $jak->id }}">
                            <label class="form-check-label" for="jenis_pajak_{{ $jak->id }}">
                                {{ $jak->nama_jenis_pajak }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Jenis Transaksi -->
            <div class="mb-3">
                <label class="form-label">Jenis Transaksi <span class="text-danger">*</span></label>
                <div>
                    @foreach ($jenis_transaksi as $transaksi)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="transaksi_id"
                                id="transaksi_{{ $transaksi->id }}" value="{{ $transaksi->id }}" required>
                            <label class="form-check-label" for="transaksi_{{ $transaksi->id }}">
                                {{ $transaksi->nama_jenis_transaksi }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3" id="aggregator-input-container" style="display: none;">
                <label for="aggregator-info" class="form-label">Informasi Tambahan untuk AGGREGATOR</label>
                <input type="text" name="mitra_agg" id="mitra_agg" class="form-control"
                    value="{{ old('mitra_agg') }}" placeholder="Masukkan ya atau tidak">
                @error('mitra_agg')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Cutoff -->
            <div class="mb-3">
                <label class="form-label">Cutoff <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="Cutoff" placeholder="Jawaban Anda" required>
            </div>

            <!-- Settlement -->
            <div class="mb-3">
                <label class="form-label">Settlement <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="Settlement" placeholder="Jawaban Anda" required>
            </div>

            <!-- Nomor Registrasi Legal -->
            <div class="mb-3">
                <label class="form-label">Nomor Registrasi Legal <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="Nomor_Registrasi_Legal" placeholder="Jawaban Anda"
                    required>
            </div>

            <!-- Skema Fee (hidden inputs for default values) -->
            <input type="hidden" name="fees" value="0">
            <input type="hidden" name="Fee_mba" value="0">
            <input type="hidden" name="Fee_mitra" value="0">

            <!-- PIC Payment Mitra -->
            <div class="mb-3">
                <label class="form-label">PIC Payment Mitra <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="PIC_Payment_Mitra" placeholder="Jawaban Anda"
                    required>
            </div>
            <div class="form-group">
                <label for="telepon_payment_mitra">Telepon Payment Mitra</label>
                <input type="text" name="telepon_payment_mitra" id="telepon_payment_mitra" class="form-control"
                    value="{{ old('telepon_payment_mitra', $paymentMba->telepon_payment_mitra ?? '') }}">
            </div>

            <!-- PIC Rekon Mitra -->
            <div class="mb-3">
                <label class="form-label">PIC Rekon Mitra <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="PIC_Rekon_Mitra" placeholder="Jawaban Anda"
                    required>
            </div>
            <div class="form-group">
                <label for="telepon_rekon_mitra">Telepon Rekon Mitra</label>
                <input type="text" name="telepon_rekon_mitra" id="telepon_rekon_mitra" class="form-control"
                    value="{{ old('telepon_rekon_mitra', $paymentMba->telepon_rekon_mitra ?? '') }}">
            </div>

            <!-- PIC Dinas -->
            <div class="mb-3">
                <label class="form-label">PIC Dinas <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="PIC_Dinas" placeholder="Jawaban Anda" required>
            </div>

            <div class="form-group">
                <label for="telepon_dinas">Telepon Dinas</label>
                <input type="text" name="telepon_dinas" id="telepon_dinas" class="form-control"
                    value="{{ old('telepon_dinas', $paymentMba->telepon_dinas ?? '') }}">
            </div>

            <!-- WAG Koordinasi Payment -->
            <div class="mb-3">
                <label class="form-label">WAG Koordinasi Payment <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="WAG_KORDINASI_PAYMENT" placeholder="Jawaban Anda"
                    required>
            </div>

            <!-- WAG Koordinasi Rekon -->
            <div class="mb-3">
                <label class="form-label">WAG Koordinasi Rekon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="WAG_KORDINASI_REKON" placeholder="Jawaban Anda"
                    required>
            </div>
            <!-- Submit -->
            <button type="submit" class="btn btn-primary">Ajukan</button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Ambil semua radio button untuk jenis transaksi
                const jenisTransaksiRadios = document.querySelectorAll('input[name="transaksi_id"]');
                const aggregatorInputContainer = document.getElementById('aggregator-input-container');
                const aggregatorInputField = document.getElementById('aggregator-info');

                // Tambahkan event listener untuk setiap radio button
                jenisTransaksiRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        // Periksa apakah nilai radio yang dipilih adalah "AGGREGATOR"
                        if (this.nextElementSibling && this.nextElementSibling.textContent.trim() ===
                            'AGGREGATOR') {
                            aggregatorInputContainer.style.display = 'block';
                        } else {
                            aggregatorInputContainer.style.display = 'none';
                            aggregatorInputField.value = ''; // Kosongkan nilai jika disembunyikan
                        }
                    });
                });
            });
        </script>


    </div>
</body>

</html>
