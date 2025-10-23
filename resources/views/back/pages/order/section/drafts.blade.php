<div class="sub_orderTabContent draftOrders" data-id="draftOrders">
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
                    <th>{{ trns('') }}</th>
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
                        $order = $order_item->order;
                    @endphp
                    <tr>
                        <td>{{ $order_item->code }}</td>
                        <td>{{ $order_item->user_name ?? ' - ' }}</td>
                        <td>{{ $order_item->company_name ? $order_item->company_name : $order_item->customer_name ?? '-' }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order_item->apply_date)?->format('d/m/Y') ?? ' - ' }}</td>
                        <td>{{ $order_item->product_name ?? ' - ' }}</td>
                        <td>{{ $order_item->weight ?? ' - ' }}</td>
                        <td>{{ $order_item->cbm ?? ' - ' }}</td>
                        <td>{{ $order_item->mix_full == 'mix' ? trns('mix') : ($order_item->mix_full == 'full' ? trns('full') : trns('automobile')) }}
                        </td>
                        <td>{{ ($order_item->price ?? '0') . ' $' }}</td>
                        <td>
                            <!-- Status classlar success, pending, reject -->
                            <div class="status-txt pending">
                                <span></span>
                                <p>{{ trns('draft') }}</p>
                            </div>
                            <p class="time">
                                {{ $latest_status?->created_at?->format('d.m.Y') ?? 'Tarix yoxdur' }}
                            </p>
                        </td>
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
                                    @can('Draft page - Əməliyyatlar -Bax')
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
                                    @can('Draft page - Əməliyyatlar - Təsdiq et')
                                        @if ($order_item->price > 0)
                                            <form action="{{ route('admin.order.confirm', $order_item->order_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button class="draft-operation-link submitOrder" type="submit">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.66609 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.66609 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.66609 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.66609 20.8 12 20.8ZM10.828 14.558L16.637 8.75L17.485 9.599L11.535 15.549C11.3475 15.7365 11.0932 15.8418 10.828 15.8418C10.5628 15.8418 10.3085 15.7365 10.121 15.549L7 12.426L7.849 11.577L10.829 14.557L10.828 14.558Z"
                                                            fill="#534D59" />
                                                    </svg>
                                                    {{ trns('confirm') }}
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
                                    @can('Draft page - Əməliyyatlar -Düzəlişə göndər')
                                        <button class="draft-operation-link editDraftOrder"
                                            data-id="{{ $order_item->order_id }}" onclick="edit_order_price(this)"
                                            type="button">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.5 12C19.5 11.8011 19.579 11.6103 19.7197 11.4697C19.8603 11.329 20.0511 11.25 20.25 11.25C20.4489 11.25 20.6397 11.329 20.7803 11.4697C20.921 11.6103 21 11.8011 21 12V20.25C21 20.4489 20.921 20.6397 20.7803 20.7803C20.6397 20.921 20.4489 21 20.25 21H3.75C3.55109 21 3.36032 20.921 3.21967 20.7803C3.07902 20.6397 3 20.4489 3 20.25V3.75C3 3.55109 3.07902 3.36032 3.21967 3.21967C3.36032 3.07902 3.55109 3 3.75 3H12C12.1989 3 12.3897 3.07902 12.5303 3.21967C12.671 3.36032 12.75 3.55109 12.75 3.75C12.75 3.94891 12.671 4.13968 12.5303 4.28033C12.3897 4.42098 12.1989 4.5 12 4.5H4.5V19.5H19.5V12Z"
                                                    fill="#534D59" />
                                                <path
                                                    d="M11.0145 12.9899L12.252 12.8129L19.854 5.21239C19.9256 5.1432 19.9827 5.06044 20.0221 4.96894C20.0614 4.87744 20.082 4.77902 20.0829 4.67944C20.0838 4.57985 20.0648 4.48109 20.0271 4.38892C19.9894 4.29675 19.9337 4.21301 19.8633 4.14259C19.7929 4.07217 19.7091 4.01648 19.6169 3.97877C19.5248 3.94106 19.426 3.92208 19.3264 3.92295C19.2268 3.92381 19.1284 3.9445 19.0369 3.98381C18.9454 4.02312 18.8627 4.08025 18.7935 4.15189L11.19 11.7524L11.013 12.9899H11.0145ZM20.9145 3.08989C21.1236 3.29884 21.2894 3.54694 21.4026 3.82002C21.5158 4.09309 21.574 4.38579 21.574 4.68139C21.574 4.97698 21.5158 5.26968 21.4026 5.54276C21.2894 5.81583 21.1236 6.06394 20.9145 6.27289L13.137 14.0504C13.0223 14.1655 12.8733 14.2402 12.7125 14.2634L10.2375 14.6174C10.1221 14.634 10.0045 14.6234 9.89395 14.5866C9.78339 14.5498 9.68293 14.4877 9.60053 14.4053C9.51813 14.3229 9.45607 14.2225 9.41926 14.1119C9.38245 14.0013 9.37191 13.8837 9.38848 13.7684L9.74248 11.2934C9.7652 11.1327 9.83942 10.9838 9.95398 10.8689L17.733 3.09139C18.1549 2.66958 18.7271 2.43262 19.3237 2.43262C19.9203 2.43262 20.4925 2.66958 20.9145 3.09139V3.08989Z"
                                                    fill="#534D59" />
                                            </svg>
                                            {{ trns('go_to_edit') }}
                                        </button>
                                    @endcan
                                    @can('Draft page - Əməliyyatlar - İmtina et')
                                        <button class="draft-operation-link reject{{ trns('draft') }}Order"
                                            onclick="reject_order(this)"
                                            data-action="{{ route('admin.order.reject', $order_item->order_id) }}"
                                            type="button">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                                    fill="#534D59" />
                                            </svg>
                                            {{ trns('reject') }}
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
