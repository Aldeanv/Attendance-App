<x-app-layout>
    <x-navigation-layout>
        Selamat Datang di Dashboard
    </x-navigation-layout>
    <div class="lg:ml-64 p-6 space-y-6">
        
        <!-- Statistik Kehadiran -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach ([
                ['Total Peserta', $totalParticipants, 'bg-indigo-600', 'user-group'],
                ['Peserta Hadir', $totalAttendance, 'bg-green-600', 'check-circle'],
                ['Belum Hadir', $notAttended, 'bg-red-600', 'x-circle']
            ] as [$title, $count, $bg, $icon])
                <div class="p-6 {{ $bg }} rounded-lg shadow-md text-white flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $title }}</h3>
                        <p class="text-4xl font-bold">{{ $count }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Detail Acara & Kehadiran -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Informasi Acara -->
            <div class="md:col-span-1 p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Detail Acara</h3>
                @forelse ($eventname as $event)
                    <div class="p-4 border-l-4 border-blue-500 bg-gray-50 rounded-lg shadow-sm mb-4">
                        <h4 class="text-lg font-semibold text-blue-700">{{ $event->name }}</h4>
                        <p class="text-gray-600 text-sm mt-1">📅 {{ \Carbon\Carbon::parse($event->date)->locale('id')->translatedFormat('l, d F Y') }}</p>
                        <p class="text-gray-600 text-sm mt-1">⏰ {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada acara terjadwal.</p>
                    <a href="{{ route('events.create') }}" class="mt-3 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">+ Tambah Acara</a>
                @endforelse
            </div>

            <!-- Log Kehadiran -->
            <div class="md:col-span-2 p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Daftar Kehadiran</h3>
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">NIP</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Telepon</th>
                                <th class="border px-4 py-2">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Attendance as $kehadiran)
                                <tr class="text-center hover:bg-gray-100">
                                    <td class="border px-4 py-2 font-semibold text-gray-700">{{ $kehadiran->nama }}</td>
                                    <td class="border px-4 py-2">{{ $kehadiran->nip }}</td>
                                    <td class="border px-4 py-2 text-gray-500">{{ $kehadiran->email }}</td>
                                    <td class="border px-4 py-2">{{ $kehadiran->telepon }}</td>
                                    <td class="border px-4 py-2 font-semibold text-green-600">{{ \Carbon\Carbon::parse($kehadiran->waktu_kehadiran)->timezone('Asia/Jakarta')->format('H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 px-6 text-center text-gray-500">Belum ada peserta yang hadir</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
