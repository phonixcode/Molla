@if ($paginator->hasPages())
<nav aria-label="Page navigation example" style="margin-top: 20px;">
    <ul class="pagination justify-content-end">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="javascript:void(0)" tabindex="-1">Previous</a>
            </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">Previous</a>
        </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disable">{{ $element }}</li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li class="page-item active"><a class="page-link">{{ $page }}</a></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>
        @endif
    </ul>
</nav>
@endif
