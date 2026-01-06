@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div class="flex justify-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-gray-400 cursor-not-allowed rounded-lg">
                    ← Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="px-4 py-2 text-blue-600 hover:text-blue-800 rounded-lg hover:bg-gray-100">
                    ← Previous
                </a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="px-4 py-2 text-blue-600 hover:text-blue-800 rounded-lg hover:bg-gray-100">
                    Next →
                </a>
            @else
                <span class="px-4 py-2 text-gray-400 cursor-not-allowed rounded-lg">
                    Next →
                </span>
            @endif
        </div>
        
        <div class="mt-4 text-center text-sm text-gray-600">
            Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
        </div>
    </nav>
@endif