<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tiket Penonton</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
        }
        .box {
            border: 2px solid #000;
            padding: 20px;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>TIKET PENONTON</h2>

    <p><strong>Nama:</strong> {{ $penonton->nama_lengkap }}</p>
    <p><strong>Acara:</strong> {{ $penonton->acara->nama_acara }}</p>
    <p><strong>Tanggal:</strong> {{ $penonton->acara->tanggal_acara }}</p>

    <br>

    <img src="data:image/png;base64,{{ $qr }}" width="200">

    <p><strong>Kode Tiket:</strong> {{ $penonton->tiket_code }}</p>

    <small>Harap tunjukkan QR Code saat check-in</small>
</div>

</body>
</html>
