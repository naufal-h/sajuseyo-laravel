<div class="orders-filter">
    <a class="orders-filter-label {{ request()->routeIs('orders') ? 'orders-filter-active' : '' }}"
        href="{{ route('orders') }}">
        <span class="orders-filter-text">All</span>
    </a>
    <a class="orders-filter-label {{ Request::is('*orders/sort-by/2') ? 'orders-filter-active' : '' }}"
        href="
    {{ route('orders.sort_by', ['id' => '2']) }}
    ">
        <span class="orders-filter-text">Paid</span>
        @if ($orders->where('order_status_id', '2')->count() > 0)
            <span class="orders-filter-counter">
                ({{ $orders->where('order_status_id', '2')->count() }})
            </span>
        @endif
    </a>
    <a class="orders-filter-label {{ Request::is('*orders/sort-by/3') ? 'orders-filter-active' : '' }}"
        href="{{ route('orders.sort_by', ['id' => '3']) }}">
        <span class="orders-filter-text">Prepared</span>
        @if ($orders->where('order_status_id', '3')->count() > 0)
            <span class="orders-filter-counter">
                ({{ $orders->where('order_status_id', '3')->count() }})
            </span>
        @endif
    </a>
    <a class="orders-filter-label {{ Request::is('*orders/sort-by/4') ? 'orders-filter-active' : '' }}"
        href="{{ route('orders.sort_by', ['id' => '4']) }}">
        <span class="orders-filter-text">
            Delivered
        </span>
        @if ($orders->where('order_status_id', '4')->count() > 0)
            <span class="orders-filter-counter">
                ({{ $orders->where('order_status_id', '4')->count() }})
            </span>
        @endif
    </a>
    <a class="orders-filter-label {{ Request::is('*orders/sort-by/5') ? 'orders-filter-active' : '' }}"
        href="{{ route('orders.sort_by', ['id' => '5']) }}">
        <span class="orders-filter-text">
            Completed
        </span>
        @if ($orders->where('order_status_id', '5')->count() > 0)
            <span class="orders-filter-counter">
                ({{ $orders->where('order_status_id', '5')->count() }})
            </span>
        @endif
    </a>
    <a class="orders-filter-label {{ Request::is('*orders/sort-by/6') ? 'orders-filter-active' : '' }}"
        href="{{ route('orders.sort_by', ['id' => '6']) }}">
        <span class="orders-filter-text">
            Cancelled
        </span>
        @if ($orders->where('order_status_id', '6')->count() > 0)
            <span class="orders-filter-counter">
                ({{ $orders->where('order_status_id', '6')->count() }})
            </span>
        @endif
    </a>
</div>
