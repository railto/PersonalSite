@if ($paginator->hasPages())
    <ul class="flex">
        @if ($paginator->onFirstPage())
            <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-500">
                <span class="flex items-center font-bold">
                    <span class="mx-1">Newer</span>
                </span>
            </li>
        @else
            <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700">
                <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center font-bold">
                    <span class="mx-1">Newer</span>
                </a>
            </li>
        @endif

        @if ($paginator->hasMorePages())
            <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700">
                <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center font-bold">
                    <span class="mx-1">Older</span>
                </a>
            </li>
        @else
            <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-500">
                <span class="flex items-center font-bold">
                    <span class="mx-1">Older</span>
                </span>
            </li>
        @endif
    </ul>
@endif()
