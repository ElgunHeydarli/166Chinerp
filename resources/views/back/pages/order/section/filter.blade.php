<div class="order_tabContent_head">
    @can('Bütün sifarişlər page')
        <button onclick="change_status(this)" data-value=""
            class="order_tab_btn {{ empty(request('status')) ? 'active' : '' }}" id="allOrders">{{ trns('all_orders') }}
        </button>
    @endcan
    @can('Draft page')
        <button onclick="change_status(this)" data-value="draft"
            class="order_tab_btn {{ request('status') == 'draft' ? 'active' : '' }}" id="draftOrders">{{ trns('draft') }}
            @if ($order_unread_count > 0)
                <span class="unread-count">{{ $order_unread_count }}</span>
            @endif
        </button>
    @endcan
    @can('Təsdiqlənən sifarişlər page')
        <button onclick="change_status(this)" data-value="confirmed"
            class="order_tab_btn {{ request('status') == 'confirmed' ? 'active' : '' }}"
            id="confirmedOrders">{{ trns('confirmed') }}</button>
    @endcan
    @can('İcrada olan sifarişlər page')
        <button onclick="change_status(this)" class="order_tab_btn {{ request('status') == 'execute' ? 'active' : '' }} "
            id="progressOrders" data-value="execute">{{ trns('executing') }}</button>
    @endcan
    @can('Bitmiş sifarişlər page')
        <button onclick="change_status(this)" class="order_tab_btn {{ request('status') == 'finished' ? 'active' : '' }}"
            id="completedOrders" data-value="finished">{{ trns('finished') }}</button>
    @endcan
    @can('İmtina olunan sifarişlər page')
        <button onclick="change_status(this)" class="order_tab_btn {{ request('status') == 'rejected' ? 'active' : '' }} "
            id="rejectOrders" data-value="rejected">{{ trns('rejected') }}</button>
    @endcan
</div>
@include('back.pages.order.section.all-order', ['order_items' => $order_items])
@include('back.pages.order.section.drafts', ['order_items' => $order_items])
@include('back.pages.order.section.confirms', ['order_items' => $order_items])
@include('back.pages.order.section.executes', [
    'order_items' => $order_items,
    'latestStatus' => $latestStatus,
])
@include('back.pages.order.section.finisheds', ['order_items' => $order_items])
@include('back.pages.order.section.rejecteds', ['order_items' => $order_items])
{{ $order_items->withQueryString()->links('back.section.pagination') }}
