<x-app-layout>
    <div class="lg:ml-64 p-4">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tambah Program Acara</h2>

            <form action="{{ route('events.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Nama Program -->
                <div>
                    <label for="name" class="block text-lg font-semibold text-gray-700 mb-2">Nama Program</label>
                    <input type="text" id="name" name="name" required 
                        class="mt-1 p-4 w-full border border-gray-300 rounded-lg shadow-sm text-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                </div>

                <!-- Tanggal & Waktu -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="date" class="block text-lg font-semibold text-gray-700 mb-2">Tanggal</label>
                        <input type="date" id="date" name="date" required 
                            class="mt-1 p-4 w-full border border-gray-300 rounded-lg shadow-sm text-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Waktu Acara</label>
                        <div class="flex space-x-4">
                            <input type="time" id="start_time" name="start_time" required 
                                class="w-full p-4 border border-gray-300 rounded-lg shadow-sm text-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                            <span class="flex items-center text-gray-600 font-semibold">s/d</span>
                            <input type="time" id="end_time" name="end_time" required 
                                class="w-full p-4 border border-gray-300 rounded-lg shadow-sm text-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between pt-16">
                    <a href="{{ route('dashboard') }}" 
                        class="px-4 py-3 bg-gray-600 text-white rounded-lg text-md hover:bg-gray-700 transition duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-4 py-3 bg-blue-500 text-white rounded-lg text-md hover:bg-blue-600 transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
