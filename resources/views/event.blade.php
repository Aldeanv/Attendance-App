<x-app-layout>
    <x-navigation-layout>
        Acara
    </x-navigation-layout>
    <div class="space-y-12 lg:ml-64 p-6">
        @forelse ($eventname as $event)
        <div class="relative col-span-1 p-6 bg-white rounded-lg shadow-lg">
            <!-- Tombol Hapus -->
            <form action="{{ route('events.destroy', $event->id) }}" method="POST" 
                class="absolute top-4 right-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">
                    ✕
                </button>
            </form>

            <h3 class="text-lg font-semibold mb-4">Edit Program</h3>
            <div class="space-y-4">
                <div>
                    <label class="font-semibold">Nama Program</label>
                    <p class="border p-2 rounded-md bg-gray-100">{{ $event->name }}</p>
                </div>
                <div>
                    <label class="font-semibold">Tanggal</label>
                    <p class="border p-2 rounded-md bg-gray-100">
                        {{ \Carbon\Carbon::parse($event->date)->locale('id')->translatedFormat('l, d F Y') }}
                    </p>
                </div>
                <div>
                    <label class="font-semibold">Waktu</label>
                    <p class="border p-2 rounded-md bg-gray-100">
                        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                    </p>
                </div>
            </div>

            <!-- Form Edit Program -->
            <div class="mt-6 border-t pt-6">
                <h3 class="text-lg font-semibold mb-4">Form Edit Program</h3>
                <form action="{{ route('events.update', $event->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Program -->
                    <div>
                        <label for="name" class="block text-base font-medium text-gray-700">Nama Program</label>
                        <input type="text" id="name" name="name" value="{{ $event->name }}" required 
                            class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="date" class="block text-base font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="date" name="date" value="{{ $event->date }}" required 
                            class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                    </div>

                    <!-- Waktu Acara -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_time" class="block text-base font-medium text-gray-700">Waktu Mulai</label>
                            <input type="time" id="start_time" name="start_time" value="{{ $event->start_time }}" required 
                                class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="end_time" class="block text-base font-medium text-gray-700">Waktu Selesai</label>
                            <input type="time" id="end_time" name="end_time" value="{{ $event->end_time }}" required 
                                class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between">
                        <a href="{{ route('dashboard') }}" 
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                            Batal
                        </a>
                        <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-1 p-6 bg-white rounded-lg shadow-md text-center">
            <p class="text-gray-500 mb-4">Tidak ada program acara yang tersedia.</p>
            <a href="{{ route('events.create') }}" 
               class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition">
                + Tambah Acara
            </a>
        </div>
        @endforelse
    </div>   
</x-app-layout>
