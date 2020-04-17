@if ($paginator->hasPages())
    <div class="row">
        <div class="col-sm-12 col-md-5"></div>
        <div class="col-sm-12 col-md-7 d-flex justify-content-end">
            <ul class="pagination" role="navigation">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link mx-3 my-custom-link shadow-sm" aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link mx-3 my-custom-link shadow-sm" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fas fa-arrow-left"></i></a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active mx-1" aria-current="page"><span class="page-link shadow-sm">{{ $page }}</span></li>
                            @else
                                <li class="page-item mx-1"><a class="page-link shadow-sm" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link mx-3 shadow-sm" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="fas fa-arrow-right"></i></a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link mx-3 shadow-sm" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
