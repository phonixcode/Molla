@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"
                            aria-hidden="true"></i></a>
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
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"
                            aria-hidden="true"></i></a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
