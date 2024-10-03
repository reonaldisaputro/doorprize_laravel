<!DOCTYPE html>
<html>

<head>
    <title>QR Code Peserta</title>
</head>

<body>
    <h1>QR Code untuk Peserta: {{ $peserta->nama }}</h1>
    <p>Kode Peserta: {{ $peserta->kode_peserta }}</p>

    <!-- Menampilkan QR Code -->
    <div>
        {!! $qrCode !!}
    </div>
</body>

</html>
