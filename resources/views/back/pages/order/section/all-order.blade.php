<div class="sub_orderTabContent draftOrders" data-id="allOrders">
    <div class="draftOrders-table">
        <table>
            <thead>
                <tr>
                    <th>{{ trns('tracking_code') }}</th>
                    <th>{{ trns('added_person') }}</th>
                    <th>{{ trns('customer') }}</th>
                    <th>{{ trns('apply_date') }}</th>
                    <th>{{ trns('product') }}</th>
                    <th>{{ trns('weight') }}</th>
                    <th>{{ trns('cube') }}</th>
                    <th>{{ trns('cargo_type') }}</th>
                    <th>{{ trns('price') }}</th>
                    <th>{{ trns('status') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_items as $order_item)
                    @php
                        $user = auth()->user();
                        $user_unread_comments = $user
                            ->comment_reads()
                            ->whereHas('comment', function ($q) use ($order_item) {
                                return $q->where('order_id', $order_item->order_id);
                            })
                            ->where('status', 0)
                            ->get();
                        $status_change_ids = explode(',', $order_item->status_change_ids);
                        $latest_status = \App\Models\OrderItemStatusChange::whereIn('id', $status_change_ids)
                            ->orderBy('id', 'desc')
                            ->first();
                    @endphp
                    <tr>
                        <td>{{ $order_item->code }}</td>
                        <td>{{ $order_item->user_name ?? '-' }}</td>
                        <td>{{ $order_item->company_name ? $order_item->company_name : $order_item->customer_name ?? '-' }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order_item->apply_date)?->format('d/m/Y') ?? '-' }}</td>
                        <td>-</td>
                        <td>{{ $order_item->weight ?? '-' }}</td>
                        <td>{{ $order_item->cbm ?? '-' }}</td>
                        <td>{{ $order_item->mix_full == 'mix' ? trns('mix') : ($order_item->mix_full == 'full' ? trns('full') : trns('automobile')) }}
                        </td>
                        <td>{{ ($order_item->price ?? '0') . $order_item->price_currency }}</td>
                        <td>
                            <!-- Status classlar success, pending, reject -->
                            @switch($order_item->order_status)
                                @case('draft')
                                    <div class="status-txt pending">
                                        <span></span>
                                        <p>
                                            {{ trns('draft') }}
                                        </p>
                                    </div>
                                @break

                                @case('confirmed')
                                    <div class="status-txt success">
                                        <span></span>
                                        <p>
                                            {{ trns('confirmed') }}
                                        </p>
                                    </div>
                                @break

                                @case('execute')
                                    <div class="status-txt success">
                                        <span></span>
                                        <p>
                                            {{ trns('executing') }}
                                        </p>
                                    </div>
                                @break

                                @case('finished')
                                    <div class="status-txt success">
                                        <span></span>
                                        <p>
                                            {{ trns('finish') }}
                                        </p>
                                    </div>
                                @break

                                @case('rejected')
                                    <div class="status-txt reject">
                                        <span></span>
                                        <p>
                                            {{ trns('reject') }}
                                        </p>
                                    </div>
                                @break

                                @default
                                    <div class="status-txt reject">
                                        <span></span>
                                        <p>
                                            -
                                        </p>
                                    </div>
                                @break
                            @endswitch
                            <p class="time">
                                {{ $latest_status?->created_at?->format('d.m.Y') ?? '-' }}
                            </p>
                        </td>
                        @canany([
                            'Bütün sifarişlər page - Əməliyyatlar-Bax',
                            'Bütün sifarişlər page -
                            Əməliyyatlar-Sil',
                            ])
                            <td>
                                <div class="draft-operation" onclick="open_operations(this)">
                                    <button class="draft-operation-btn" type="button">
                                        {{ trns('operations') }}
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_22_2058)">
                                                <path d="M5 7.38989L9.5 11.8899L14 7.38989" stroke="black"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_22_2058">
                                                    <rect width="18" height="18" fill="white"
                                                        transform="translate(0.5 0.639893)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </button>
                                    <div class="draft-operation-links">
                                        @can('Bütün sifarişlər page - Əməliyyatlar-Bax')
                                            <a class="draft-operation-link seeDetail"
                                                href="{{ route('admin.order.show', $order_item->order_item_id) }}">
                                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.12547 14.1399C12.1255 14.1399 14.7205 12.4749 16.0555 10.0149C14.7205 7.55489 12.1255 5.88989 9.12547 5.88989C6.12547 5.88989 3.53047 7.55489 2.19547 10.0149C3.53047 12.4749 6.12547 14.1399 9.12547 14.1399ZM9.12547 5.13989C12.5455 5.13989 15.5005 7.12739 16.8955 10.0149C15.5005 12.9024 12.5455 14.8899 9.12547 14.8899C5.70547 14.8899 2.75047 12.9024 1.35547 10.0149C2.75047 7.12739 5.70547 5.13989 9.12547 5.13989ZM9.12547 6.63989C11.0005 6.63989 12.5005 8.13989 12.5005 10.0149C12.5005 11.8899 11.0005 13.3899 9.12547 13.3899C7.25047 13.3899 5.75047 11.8899 5.75047 10.0149C5.75047 8.13989 7.25047 6.63989 9.12547 6.63989ZM9.12547 7.38989C8.42928 7.38989 7.7616 7.66645 7.26931 8.15874C6.77703 8.65102 6.50047 9.3187 6.50047 10.0149C6.50047 10.7111 6.77703 11.3788 7.26931 11.871C7.7616 12.3633 8.42928 12.6399 9.12547 12.6399C9.82166 12.6399 10.4893 12.3633 10.9816 11.871C11.4739 11.3788 11.7505 10.7111 11.7505 10.0149C11.7505 9.3187 11.4739 8.65102 10.9816 8.15874C10.4893 7.66645 9.82166 7.38989 9.12547 7.38989Z"
                                                        fill="#534D59" />
                                                </svg>
                                                {{ trns('view') }}
                                                @if (count($user_unread_comments))
                                                    <span>{{ count($user_unread_comments) }}</span>
                                                @endif
                                            </a>
                                        @endcan
                                        @can('Bütün sifarişlər page - Əməliyyatlar-Sil')
                                            <a class="draft-operation-link seeDetail"
                                                href="{{ route('admin.order.destroy', $order_item->order_id) }}"
                                                onclick="delete_item(this)">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                                        fill="#534D59" />
                                                </svg>
                                                {{ trns('delete') }}
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
