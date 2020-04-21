@if ($paginator->hasPages())
    <div class="row">
        <div class="col-sm-12 col-md-5"></div>
        <div class="col-sm-12 col-md-7 d-flex justify-content-end">
            <ul class="pagination" role="navigation">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link my-custom-link d-flex justify-content-lg-around align-items-center my-custom-link" aria-hidden="true"><i class="fas fa-arrow-left"></i>Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link my-custom-link d-flex justify-content-lg-around align-items-center my-custom-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fas fa-arrow-left"></i>Anterior</a>
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
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link d-flex justify-content-lg-around align-items-center my-custom-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Siguiente<i class="fas fa-arrow-right"></i></a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link d-flex justify-content-lg-around align-items-center my-custom-link" aria-hidden="true">Siguiente<i class="fas fa-arrow-right"></i></span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
