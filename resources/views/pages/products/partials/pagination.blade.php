@if ($products->hasPages())
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
        <!-- Results Count -->
        <p class="font-worksans text-dark fw-5 mb-0">
            Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}
            of {{ $products->total() }} results
        </p>

        <!-- Pagination -->
        <div class="tf-page-pagination">
            <ul class="mb-0 d-flex align-items-center">
                @if ($products->onFirstPage())
                    <li class="disabled">
                        <a class="prev"><i class="fas fa-angle-double-left"></i></a>
                    </li>
                @else
                    <li>
                        <a href="{{ $products->appends(request()->query())->previousPageUrl() }}"
                            class="prev pagination-link">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                    </li>
                @endif

                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    <li>
                        <a class="{{ $page == $products->currentPage() ? 'active' : '' }} pagination-link"
                            href="{{ $products->appends(request()->query())->url($page) }}">
                            {{ $page }}
                        </a>
                    </li>
                @endforeach

                @if ($products->hasMorePages())
                    <li>
                        <a href="{{ $products->appends(request()->query())->nextPageUrl() }}"
                            class="next pagination-link">
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </li>
                @else
                    <li class="disabled">
                        <a class="next"><i class="fas fa-angle-double-right"></i></a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
