@props(['label', 'value', 'color' => 'blue', 'icon' => null])

<div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow transition">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">{{ $label }}</p>
            <p class="text-2xl font-semibold text-gray-800 mt-1">{{ $value }}</p>
        </div>

        <div class="w-11 h-11 rounded-lg bg-{{ $color }}-50 flex items-center justify-center">
            {{ $icon }}
        </div>
    </div>
</div>
