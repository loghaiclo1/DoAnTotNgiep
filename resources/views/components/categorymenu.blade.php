@props(['data', 'tabId', 'tabLabel', 'active' => false])

<div class="tab-pane fade {{ $active ? 'show active' : '' }}" id="{{ $tabId }}" role="tabpanel"
    aria-labelledby="{{ $tabLabel }}">
    <div class="category-layout">
        <div class="categories-section">
            {{-- Hiển thị 4 danh mục cấp 2 --}}
            <div class="category-headers">
                @foreach ($data->take(4) as $parent)
                    <h4>{{ $parent->name }}</h4>
                @endforeach
            </div>

            <div class="category-links">
                @php
                    $columns = [];

                    foreach ($data->take(4) as $parent) {
                        $children = $parent->topChildren->take(6)->values(); // lấy tối đa 6 mục con
                        $columns[] = $children;
                    }

                    $maxRows = collect($columns)->map(fn($col) => $col->count())->max();
                @endphp

                {{-- Hiển thị từng hàng --}}
                @for ($i = 0; $i < $maxRows; $i++)
                    <div class="link-row">
                        @foreach ($columns as $col)
                            @php $cat = $col[$i] ?? null; @endphp
                            @if ($cat)
                                <a href="{{ url('/category/' . $cat->slug) }}">{{ $cat->name }}</a>
                            @else
                                <span></span>
                            @endif
                        @endforeach
                    </div>
                @endfor

                {{-- View all --}}
                <div class="link-row">
                    @foreach ($data->take(4) as $parent)
                        <a href="{{ url('/category/' . $parent->slug) }}">View all</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
