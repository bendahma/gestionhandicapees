@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center py-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="btn btn-outline-success disabled">
                Previous
            </span>
        @else
            <button wire:click="previousPage" rel="prev" class="btn btn-success">
               Previous
            </button>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" rel="next" class="btn btn-success px-4">
                Next
            </button>
        @else
            <span class="btn btn-outline-success disabled px-4">
                Next
            </span>
        @endif
    </nav>
@endif