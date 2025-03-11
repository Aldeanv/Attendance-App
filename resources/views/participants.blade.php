<x-app-layout>
    <x-navigation-layout>
        Daftar Peserta
    </x-navigation-layout>
    <div class="flex-col lg:ml-64 p-6">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <form method="GET" action="{{ route('participant.index') }}" class="flex space-x-2 w-full max-w-md">
                <input type="text" name="search" placeholder="Cari Nama, atau NIP" 
                    value="{{ request('search') }}"
                    class="border px-4 py-2 rounded-lg w-full shadow-sm focus:ring focus:ring-blue-300">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg> Cari
                </button>
            </form>

            <!-- Tombol Upload Excel dan Hapus Data -->
            <div class="flex items-center justify-end space-x-2">
                <button onclick="openModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    <span class="ml-2">Upload Excel</span>
                </button>
                <form id="deleteAllForm" action="{{ route('participant.destroyAll') }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
                
                <button type="button" onclick="confirmDeleteAll()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg> Hapus Semua
                </button>                
            </div>
        </div>
    </div>

    <!-- Modal Upload Excel -->
    <div id="uploadModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload File Excel</h2>
            <form action="{{ route('participant.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="border border-gray-300 rounded-lg p-2 w-full text-gray-700 mb-4">
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300">Batal</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <div class="flex-col bg-white rounded-xl overflow-auto lg:ml-64 h-full shadow-lg p-6 pt-0">
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <tr>
                        <th class="py-4 px-6 text-center">Nama</th>
                        <th class="py-4 px-6 text-center">Jenis Kelamin</th>
                        <th class="py-4 px-6 text-center">Dinas</th>
                        <th class="py-4 px-6 text-center">Jabatan</th>
                        <th class="py-4 px-6 text-center">NIP</th>
                        <th class="py-4 px-6 text-center">Email</th>
                        <th class="py-4 px-6 text-center">Telepon</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($participants as $participant)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-4 px-6 font-semibold text-blue-700">{{ $participant->nama }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->jenis_kelamin }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->dinas }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->jabatan }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->nip }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->email }}</td>
                        <td class="py-4 px-6 text-gray-700">{{ $participant->telepon }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openModal() {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('uploadModal').classList.add('flex');
        }
        function closeModal() {
            document.getElementById('uploadModal').classList.add('hidden');
            document.getElementById('uploadModal').classList.remove('flex');
        }
    </script>

    <script>
        function confirmDeleteAll() {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Semua data peserta akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteAllForm").submit();
                }
            });
        }
    </script>

</x-app-layout>
