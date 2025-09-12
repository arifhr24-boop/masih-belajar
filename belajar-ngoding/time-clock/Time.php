<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Time Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap');
        body {
            font-family: 'JetBrains Mono', monospace;
        }
        .blink-red {
            animation: blink 0.5s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-black flex items-center justify-center p-4">
    <div class="bg-black/90 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-gray-800 max-w-md w-full">
        <h1 class="text-3xl font-bold text-center text-white mb-8">
            Live Millisecond Time Tracker
        </h1>

        <div class="flex items-center justify-center space-x-2 text-white font-bold text-4xl md:text-5xl">
            <!-- Hours -->
            <div class="bg-gray-800/50 px-3 py-3 rounded-xl" id="hours">00</div>
            <div>:</div>
            
            <!-- Minutes -->
            <div class="bg-gray-800/50 px-3 py-3 rounded-xl" id="minutes">00</div>
            <div>:</div>
            
            <!-- Seconds -->
            <div class="bg-gray-800/50 px-3 py-3 rounded-xl" id="seconds">00</div>
            <div>.</div>
            
            <!-- Milliseconds (first two digits) -->
            <div class="bg-gray-800/50 px-3 py-3 rounded-xl" id="milliseconds-first">00</div>
            
            <!-- Milliseconds (last digit) -->
            <div class="px-3 py-3 rounded-xl transition-all duration-150" id="milliseconds-last">0</div>
        </div>

        <div class="mt-8 text-center">
            <div class="text-lg font-semibold transition-colors duration-150" id="status-text">
                Millisecond tracking...
            </div>
            <div class="text-gray-400 text-sm mt-2">
                Digit terakhir milidetik berubah merah saat bernilai 7
            </div>
        </div>

        <div class="mt-12 p-4 bg-gray-800/30 rounded-lg text-center text-gray-400 text-sm">
            <p>Format: HH:MM:SS.mmm (highlight digit terakhir milidetik)</p>
            <p>Diperbarui setiap 10ms • Presisi: ±10ms</p>
        </div>

        <div class="mt-6 text-center text-gray-500 text-xs">
            <p>Inspired by time.is • Live millisecond tracking</p>
        </div>
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            
            // Format waktu
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const milliseconds = String(now.getMilliseconds()).padStart(3, '0');
            
            // Ambil digit terakhir milidetik
            const lastDigit = milliseconds.charAt(2);
            
            // Cek apakah digit terakhir adalah 7
            const isRed = lastDigit === '7';
            
            // Update tampilan
            document.getElementById('hours').textContent = hours;
            document.getElementById('minutes').textContent = minutes;
            document.getElementById('seconds').textContent = seconds;
            document.getElementById('milliseconds-first').textContent = milliseconds.slice(0, 2);
            document.getElementById('milliseconds-last').textContent = lastDigit;
            
            // Update warna digit terakhir
            const lastDigitElement = document.getElementById('milliseconds-last');
            if (isRed) {
                lastDigitElement.className = 'px-3 py-3 rounded-xl bg-red-600 text-red-400 border-2 border-red-500/50 shadow-lg shadow-red-500/20 blink-red transition-all duration-150';
                document.getElementById('status-text').className = 'text-lg font-semibold text-red-400 transition-colors duration-150';
                document.getElementById('status-text').textContent = 'Digit terakhir milidetik adalah 7! (Merah)';
            } else {
                lastDigitElement.className = 'px-3 py-3 rounded-xl bg-gray-800/50 text-white transition-all duration-150';
                document.getElementById('status-text').className = 'text-lg font-semibold text-green-400 transition-colors duration-150';
                document.getElementById('status-text').textContent = 'Millisecond tracking...';
            }
        }

        // Jalankan pertama kali
        updateTime();
        
        // Set interval untuk update setiap 10ms
        setInterval(updateTime, 10);
    </script>
</body>
</html>
