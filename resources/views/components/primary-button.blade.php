<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full flex justify-center items-center px-6 py-3 bg-purple-600 border border-transparent rounded-lg font-semibold text-white text-lg tracking-wide hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-200 shadow-md']) }}>
    {{ $slot }}
</button>
