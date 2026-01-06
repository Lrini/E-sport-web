@extends('admin.tiketing.layouts.main')

@section('section')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Tiketing Dashboard</h1>
    
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Scan QR Code</h2>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <div id="reader" class="w-full max-w-xl mx-auto border rounded overflow-hidden"></div>
            
            <div class="mt-4 text-center">
                <button id="startScan" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 text-lg">Mulai Scan</button>
                <button id="stopScan" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600 ml-2 text-lg" style="display:none;">Berhenti</button>
            </div>
            <div id="result" class="mt-4 text-center font-semibold text-lg min-h-[3rem]"></div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    // Inisialisasi menggunakan ID container "reader"
    const html5QrCode = new Html5Qrcode("reader");
    const resultDiv = document.getElementById('result');
    const startBtn = document.getElementById('startScan');
    const stopBtn = document.getElementById('stopScan');

    function playBeep() {
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioCtx.createOscillator();
        const gainNode = audioCtx.createGain();

        oscillator.connect(gainNode);
        gainNode.connect(audioCtx.destination);

        oscillator.type = 'sine'; // Jenis bunyi
        oscillator.frequency.setValueAtTime(880, audioCtx.currentTime); // Frekuensi tinggi (Pitch)
        gainNode.gain.setValueAtTime(0.5, audioCtx.currentTime); // Volume

        oscillator.start();
        oscillator.stop(audioCtx.currentTime + 0.2); // Bunyi selama 0.2 detik
    }

    function startScanning() {
        resultDiv.innerText = "Menginisialisasi kamera...";
        resultDiv.className = "mt-4 text-center text-blue-600 font-semibold text-lg";

        html5QrCode.start(
            { facingMode: "environment" }, 
            {
                fps: 10,
                qrbox: { width: 250, height: 250 }
            },
            qrCodeMessage => {
                // Berhenti scan agar tidak duplikat saat proses kirim data
                playBeep();
                html5QrCode.stop().then(() => {
                    startBtn.style.display = 'inline-block';
                    stopBtn.style.display = 'none';
                    processCheckin(qrCodeMessage);
                });
            }
        ).then(() => {
            startBtn.style.display = 'none';
            stopBtn.style.display = 'inline-block';
            resultDiv.innerText = "Scanner Aktif - Silahkan Scan Barcode";
            resultDiv.className = "mt-4 text-center text-gray-600 font-semibold text-lg";
        }).catch(err => {
            resultDiv.innerText = "Kamera tidak ditemukan atau izin ditolak.";
            resultDiv.className = "mt-4 text-center text-red-600 font-semibold text-lg";
        });
    }

    function processCheckin(code) {
        resultDiv.innerText = "Memverifikasi tiket...";
        
        fetch("/api/checkin", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ ticket_code: code })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                // Tampilan saat berhasil: Pesan Tiket + Berhasil
                // Database diperbarui di CheckinController: $penonton->update(['checked_in_at' => now()])
                resultDiv.innerText = `[${code}] - ${data.message}`;
                resultDiv.className = "mt-4 text-center text-green-600 font-bold text-2xl p-4 bg-green-50 rounded shadow";
            } else {
                resultDiv.innerText = data.message;
                resultDiv.className = "mt-4 text-center text-red-600 font-bold text-xl p-4 bg-red-50 rounded shadow";
            }
        })
        .catch(error => {
            resultDiv.innerText = "Koneksi server terputus.";
            resultDiv.className = "mt-4 text-center text-red-600 font-semibold text-lg";
        });
    }

    startBtn.addEventListener('click', startScanning);

    stopBtn.addEventListener('click', () => {
        html5QrCode.stop().then(() => {
            startBtn.style.display = 'inline-block';
            stopBtn.style.display = 'none';
            resultDiv.innerText = "Scanner Non-aktif";
        });
    });
</script>
@endsection