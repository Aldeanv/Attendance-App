<x-app-layout>
    <x-navigation-layout>
        Log Kehadiran
    </x-navigation-layout>
    <div class="h-full p-6 lg:ml-64">
        <!-- Header dengan Pencarian dan Aksi -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('attendance.index') }}" class="flex space-x-2 w-full max-w-md">
                <input type="text" name="search" placeholder="Cari Nama atau NIP" 
                    value="{{ request('search') }}"
                    class="border px-4 py-2 rounded-lg w-full shadow-sm focus:ring focus:ring-blue-300">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg> Cari
                </button>
            </form>

            <!-- Tombol Aksi -->
            <div class="flex space-x-3">
                <!-- Download Excel -->
                <a href="{{ route('attendance.export') }}" 
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    <span class="ml-2">Download Excel</span>
                </a>

                <!-- Form Hapus Semua -->
                <form id="deleteAllForm" action="{{ route('attendance.destroyAll') }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>

                <!-- Tombol Hapus Semua -->
                <button type="button" onclick="confirmDeleteAll()"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg> Hapus Semua
                </button>
            </div>
        </div>

        <!-- Floating Button Scan -->
        <button id="openModalBtn"
            class="z-40 fixed bottom-10 right-10 bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-3 rounded-full shadow-2xl hover:scale-110 transition-transform duration-300 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
            </svg>                                    
        </button>
    
            <!-- Modal Fullscreen-->
        <div id="qrModal"
            class="z-40 fixed inset-0 items-center justify-center bg-black bg-opacity-80 backdrop-blur-lg hidden transition-opacity">
            <div class="relative w-full h-full flex flex-col items-center justify-center">
            <!-- Tombol Tutup -->
            <button id="closeModalBtn"
                class="absolute top-6 right-6 bg-red-600 text-white px-6 py-3 rounded-lg text-lg shadow-lg hover:bg-red-700 transition-transform hover:scale-110">
                ✕
            </button>
    
                <h2 class="text-5xl font-extrabold text-white text-center mb-4 animate-fade-in">
                Scan QR Code
            </h2>
            <p class="text-lg text-gray-300 text-center mb-6 animate-fade-in">
                Arahkan kamera ke QR Code untuk absen.
            </p>
    
            <!-- Scanner Fullscreen -->
            <div id="reader"
                class="w-[500px] h-[500px] rounded-lg shadow-lg overflow-hidden"></div>
            </div>
        </div>
    
            <!-- Notifikasi Pop-up -->
        <div id="successPopup"
            class="z-50 fixed top-10 right-10 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg text-lg hidden transition-transform">
            ✅ Absen Berhasil!
        </div>
    
            <!-- Notifikasi Pop-up Error -->
        <div id="errorPopup"
            class="z-50 fixed top-10 right-10 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg text-lg hidden transition-transform">
            ❌ Peserta tidak terdaftar pada acara! 
        </div>
    
            <!-- Notifikasi Pop-up Error (Peserta Sudah Absen) -->
        <div id="alreadyPopup"
            class="z-50 fixed top-10 right-10 bg-yellow-500 text-white px-6 py-4 rounded-lg shadow-lg text-lg hidden transition-transform">
            ⚠️ Peserta sudah absen hari ini!
        </div>

        <!-- Tabel Kehadiran -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Daftar Kehadiran</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse rounded-lg overflow-hidden">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="py-3 px-6">Nama</th>
                            <th class="py-3 px-6">NIP</th>
                            <th class="py-3 px-6">Dinas</th>
                            <th class="py-3 px-6">Email</th>
                            <th class="py-3 px-6">Telepon</th>
                            <th class="py-3 px-6">Datang</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($attendance as $kehadiran)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="py-4 px-6">{{ $kehadiran->nama }}</td>
                            <td class="py-4 px-6">{{ $kehadiran->nip }}</td>
                            <td class="py-4 px-6">{{ $kehadiran->dinas }}</td>
                            <td class="py-4 px-6">{{ $kehadiran->email }}</td>
                            <td class="py-4 px-6">{{ $kehadiran->telepon }}</td>
                            <td class="py-4 px-6">
                                {{ \Carbon\Carbon::parse($kehadiran->waktu_kehadiran)->timezone('Asia/Jakarta')->format('H:i') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Peserta Belum Hadir -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Peserta Belum Hadir</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse rounded-lg overflow-hidden">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="py-3 px-6">Nama</th>
                            <th class="py-3 px-6">NIP</th>
                            <th class="py-3 px-6">Dinas</th>
                            <th class="py-3 px-6">Email</th>
                            <th class="py-3 px-6">Telepon</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($notAttended as $peserta)
                        <tr class="hover:bg-red-50 transition">
                            <td class="py-4 px-6">{{ $peserta->nama }}</td>
                            <td class="py-4 px-6">{{ $peserta->nip }}</td>
                            <td class="py-4 px-6">{{ $peserta->dinas }}</td>
                            <td class="py-4 px-6">{{ $peserta->email }}</td>
                            <td class="py-4 px-6">{{ $peserta->telepon }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-4 px-6 text-center text-gray-500">Seluruh peserta telah hadir</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="/js/scanner.js"></script>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteAll() {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Semua data kehadiran akan dihapus dan tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, hapus semua! (5)",
                cancelButtonText: "Batal",
                allowOutsideClick: false, // Mencegah popup tertutup tanpa interaksi
                allowEscapeKey: false, // Mencegah popup tertutup dengan tombol "Esc"
                didOpen: () => {
                    const confirmBtn = Swal.getConfirmButton();
                    confirmBtn.disabled = true; // Nonaktifkan tombol konfirmasi

                    let countdown = 5;
                    const interval = setInterval(() => {
                        countdown--;
                        confirmBtn.textContent = `Ya, hapus semua! (${countdown})`;

                        if (countdown <= 0) {
                            clearInterval(interval);
                            confirmBtn.disabled = false; // Aktifkan kembali tombol
                            confirmBtn.textContent = "Ya, hapus semua!";
                        }
                    }, 1000);
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteAllForm").submit();
                }
            });
        }
    </script>
</x-app-layout>