<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tiket Event</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            text-align: center;
        }
        .box {
            border: 2px dashed #000;
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>TIKET RESMI EVENT</h2>

<div class="box">
    <p><strong>Nama Penonton:</strong><br>{{ $penonton->nama }}</p>

    <p><strong>Acara:</strong><br>{{ $penonton->acara->nama_acara }}</p>

    <p><strong>Tanggal:</strong><br>{{ $penonton->acara->tanggal_acara }}</p>

    <p><strong>Kode Tiket:</strong><br>{{ $penonton->ticket_code }}</p>
</div>

<p>Harap simpan tiket ini dan tunjukkan saat check-in.</p>

</body>
</html>
