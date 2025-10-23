<div class="sub_orderTabContent draftOrders completedOrders" data-id="rejectOrders">
    <div class="draftOrders-table confirmedOrders-table">
        <table>
            <thead>
                <tr>
                    <th>{{ trns('added_person') }}</th>
                    <th>{{ trns('customer') }}</th>
                    <th>{{ trns('apply_date') }}</th>
                    <th>{{ trns('product') }}</th>
                    <th>{{ trns('weight') }}</th>
                    <th>{{ trns('price') }}</th>
                    <th>{{ trns('status') }}</th>
                    <th>{{ trns('reject_reason') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_items as $order_item)
                    @php
                        $order = \App\Models\Order::find($order_item->order_id);
                    @endphp
                    <tr>
                        <td>{{ $order_item->user_name ?? '-' }}</td>
                        <td>{{ $order_item->company_name ? $order_item->company_name : $order_item->customer_name ?? '-' }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order_item->apply_date)?->format('d/m/Y') ?? '-' }}</td>
                        <td>-</td>
                        <td>{{ $order_item->cbm ?? '-' }}</td>
                        <td>{{ ($order_item->price ?? '0') . ' $' }}</td>
                        <td>
                            <!-- Status classlar success, pending, reject -->
                            <div class="status-txt reject">
                                <span></span>
                                <p>{{ trns('reject') }}</p>
                            </div>
                            <p class="time">
                                {{ $order?->status_changes()->where('status', \App\Enums\OrderStatus::REJECTED)->first()?->created_at->format('d.m.Y') ?? '-' }}
                            </p>
                        </td>
                        <td>{{ $order?->reject?->reject_reason->name }}</td>
                        @can('İmtina olunan sifarişlər-Bax')
                            <td>
                                <a href="{{ route('admin.order.show', $order_item->order_item_id) }}" class="seeDetail">
                                    {{ trns('view') }}
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.12547 14.1399C12.1255 14.1399 14.7205 12.4749 16.0555 10.0149C14.7205 7.55489 12.1255 5.88989 9.12547 5.88989C6.12547 5.88989 3.53047 7.55489 2.19547 10.0149C3.53047 12.4749 6.12547 14.1399 9.12547 14.1399ZM9.12547 5.13989C12.5455 5.13989 15.5005 7.12739 16.8955 10.0149C15.5005 12.9024 12.5455 14.8899 9.12547 14.8899C5.70547 14.8899 2.75047 12.9024 1.35547 10.0149C2.75047 7.12739 5.70547 5.13989 9.12547 5.13989ZM9.12547 6.63989C11.0005 6.63989 12.5005 8.13989 12.5005 10.0149C12.5005 11.8899 11.0005 13.3899 9.12547 13.3899C7.25047 13.3899 5.75047 11.8899 5.75047 10.0149C5.75047 8.13989 7.25047 6.63989 9.12547 6.63989ZM9.12547 7.38989C8.42928 7.38989 7.7616 7.66645 7.26931 8.15874C6.77703 8.65102 6.50047 9.3187 6.50047 10.0149C6.50047 10.7111 6.77703 11.3788 7.26931 11.871C7.7616 12.3633 8.42928 12.6399 9.12547 12.6399C9.82166 12.6399 10.4893 12.3633 10.9816 11.871C11.4739 11.3788 11.7505 10.7111 11.7505 10.0149C11.7505 9.3187 11.4739 8.65102 10.9816 8.15874C10.4893 7.66645 9.82166 7.38989 9.12547 7.38989Z"
                                            fill="white" />
                                    </svg>
                                </a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
