<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenis Kemitraan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h1 {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 10px;
        }
        .options {
            margin-top: 20px;
        }
        .option {
            margin-bottom: 10px;
        }
        .next-button {
            display: none;
            margin-top: 20px;
        }
    </style>
    <script>
        function handleSelection() {
            const options = document.querySelectorAll('input[name="kemitraan"]');
            const button = document.getElementById('nextButton');

            options.forEach(option => {
                if (option.checked) {
                    button.style.display = 'block';
                    button.onclick = () => {
                        if (option.value === 'fee-based') {
                            window.location.href = 'payment_mba_admin';
                        } else if (option.value === 'non-fee-based') {
                            window.location.href = 'payment_mba_no_fee_admin';
                        }
                    };
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Jenis Kemitraan <span style="color: red;">*</span></h1>
        <p>
            <strong>Feebased</strong>: Payment yang ada tambahan admin di setiap transaksinya, contoh: modern channel, bank BNI, PT POS.<br>
            <strong>Non Feebased</strong>: Payment melalui Bank Pembangunan Daerah, contoh: BJB, SUMSELBABEL, NTT.
        </p>
        <div class="options">
            <label class="option">
                <input type="radio" name="kemitraan" value="fee-based" onchange="handleSelection()">
                Fee Based (Admin)
            </label><br>
            <label class="option">
                <input type="radio" name="kemitraan" value="non-fee-based" onchange="handleSelection()">
                Non Fee Based (tanpa admin)
            </label>
        </div>
        <button id="nextButton" class="next-button">Berikutnya</button>
    </div>
</body>
</html>
