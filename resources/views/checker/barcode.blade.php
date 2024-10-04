<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner Barcode Peserta</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <style>
        .scanner-container {
            width: 100%;
            max-width: 500px;
            margin: auto;
            padding: 20px;
            text-align: center;
        }

        #interactive {
            width: 100%;
            height: auto;
        }

        .message {
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="scanner-container">
        <h1>Validasi Peserta</h1>
        <p>Silakan scan barcode peserta untuk memvalidasi.</p>
        <div id="interactive" class="viewport"></div>
        <p id="status" class="message">Menunggu scan...</p>
        <p id="scanned-code" class="message"></p> <!-- Menampilkan kode yang discan -->
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#interactive'), // Menampilkan hasil pemindaian barcode
                    constraints: {
                        facingMode: "environment" // Menggunakan kamera belakang
                    }
                },
                decoder: {
                    readers: [
                        "qr_code_reader"
                    ] // Format barcode yang di-scan, ganti jika menggunakan QR code
                }
            }, function(err) {
                if (err) {
                    console.log(err);
                    return;
                }
                console.log("Quagga initialized");
                Quagga.start();
            });

            Quagga.onDetected(function(data) {
                let scannedCode = data.codeResult.code;

                // Menampilkan kode yang di-scan di halaman
                document.getElementById("scanned-code").textContent = `Kode ditemukan: ${scannedCode}`;
                document.getElementById("status").textContent = "Kode berhasil di-scan, memvalidasi...";

                // Mengirim hasil pemindaian ke backend untuk validasi
                validatePeserta(scannedCode);
            });

            // Fungsi untuk mengirim hasil barcode ke backend untuk validasi
            function validatePeserta(scannedCode) {
                fetch(`https://reonaldi-saputro.website/api/peserta/validate-by-code/${scannedCode}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert('Peserta valid: ' + data.data.nama);
                            document.getElementById("status").textContent = 'Peserta valid: ' + data.data.nama;
                        } else {
                            alert('Peserta tidak valid atau tidak ditemukan');
                            document.getElementById("status").textContent =
                                'Peserta tidak valid atau tidak ditemukan';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById("status").textContent = 'Error memvalidasi peserta';
                    });
            }
        });
    </script>
</body>

</html>
