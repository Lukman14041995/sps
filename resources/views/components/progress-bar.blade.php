@props(['label', 'value', 'color' => 'blue'])

<div>
    <div class="flex justify-between text-sm mb-1">
        <span class="text-gray-600">{{ $label }}</span>
        <span class="font-medium">{{ $value }}%</span>
    </div>
    <div class="h-2 bg-gray-200 rounded-full">
        <div class="h-2 bg-{{ $color }}-500 rounded-full transition-all" style="width: {{ $value }}%"></div>
    </div>
</div>
