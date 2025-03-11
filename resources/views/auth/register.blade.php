<x-guest-layout>
    <h2 class="text-center text-3xl font-extrabold text-gray-800">Selamat Datang</h2>
    <p class="text-center text-gray-600 mb-6">Silakan daftar untuk melanjutkan</p>

    <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        <!-- Nama -->
        <div class="col-span-2 md:col-span-1">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input id="name" type="text" name="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-3" value="{{ old('name') }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-2 md:col-span-1">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-3" value="{{ old('email') }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nomor Telepon -->
        <div class="col-span-2 md:col-span-1">
            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input id="phone" type="tel" name="phone" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-3" value="{{ old('phone') }}" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="col-span-2 md:col-span-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-3" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Konfirmasi Password -->
        <div class="col-span-2">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 p-3" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Link Login -->
        <div class="col-span-2 flex items-center justify-between">
            <a href="{{ route('login') }}" class="text-sm text-purple-600 hover:text-purple-800">Sudah punya akun?</a>
        </div>

        <!-- Tombol Daftar -->
        <div class="col-span-2">
            <button type="submit" class="w-full px-4 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition text-lg">Daftar</button>
        </div>
    </form>
</x-guest-layout>
