<x-app-layout>
    <x-navigation-layout>
        Users
    </x-navigation-layout>

    <div class="flex-col lg:ml-64 p-6">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <form method="GET" action="{{ route('users.index') }}" class="flex space-x-2 w-full max-w-md">
                <input type="text" name="search" placeholder="Cari Nama, atau NIP" 
                    value="{{ request('search') }}"
                    class="border px-4 py-2 rounded-lg w-full shadow-sm focus:ring focus:ring-blue-300">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg> Cari
                </button>
            </form>

            <!-- Tombol Tambah Pengguna -->
            <div class="flex items-center justify-end space-x-2">
                <a href="{{ route('users.export') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg> 
                    Download Users
                </a>                           
            </div>
        </div>
    </div>

    <div class="flex-col bg-white rounded-xl overflow-auto lg:ml-64 h-full shadow-lg p-6 pt-0">
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <tr>
                        <th class="py-4 px-6 text-center">Nama</th>
                        <th class="py-4 px-6 text-center">Email</th>
                        <th class="py-4 px-6 text-center">Telepon</th>
                        <th class="py-4 px-6 text-center">Role</th>
                        <th class="py-4 px-6 text-center">Dibuat</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-4 px-6 font-semibold text-blue-700 text-center">{{ $user->name }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $user->email }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $user->phone }}</td>
                        <td class="py-4 px-6 text-center">{{ $user->role }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $user->created_at }}</td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
