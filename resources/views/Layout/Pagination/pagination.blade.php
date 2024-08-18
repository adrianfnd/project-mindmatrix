@if ($paginator->hasPages())
    <div class="d-flex flex-row-reverse m-0 p-0">
        <div class="mt-3 mx-3 ">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-dark">
                    <?php
                    $start = $paginator->currentPage() - 2; // show 3 pagination links before current
                    $end = $paginator->currentPage() + 2; // show 3 pagination links after current
                    if ($start < 1) {
                        $start = 1; // reset start to 1
                        $end += 1;
                    }
                    if ($end >= $paginator->lastPage()) {
                        $end = $paginator->lastPage();
                    } // reset end to last page
                    ?>
                    @if ($start > 1)
                        <li class="page-item"><a class="page-link"
                                href="{{ $paginator->appends(['limit_per_page' => 10])->url(1) }}">{{ 1 }}</a></li>
                    @endif
                    @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->appends(['limit_per_page' => 10])->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                </ul>
            </nav>
        </div>
    </div>
@endif