@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => ' border-b border-gray-700 rounded-md p-4']) }}>
