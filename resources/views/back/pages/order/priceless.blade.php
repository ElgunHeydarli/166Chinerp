@extends('back.layouts.master')

@section('content')
    <div class="orders_tab_content">
        <form action="" class="table-search">
            <input type="text" placeholder="Axtar">
            <button class="submitForm" type="submit">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="11.5" cy="11.5" r="9.5" stroke="#fff" stroke-width="1.5" />
                    <path d="M18.5 18.5L22 22" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </button>
        </form>
        <div class="order_awaitPrice_tabContent">
            <div class="order_awaitPrice_tabContent_head">
                <button class="order_awaitPrice_tab_btn active" type="button" id="awaitPrice">
                    {{ trns('price') }} gözləyən sifarişlər
                    @if (count($orders) > 0)
                        <span>{{ count($orders) }}</span>
                    @endif
                </button>
            </div>
            <div class="sub_awaitPriceTabContent awaitPrice" data-id="awaitPrice">
                <div class="awaitPrice-table">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ trns('tracking_code') }}</th>
                                <th>{{ trns('added_person') }}</th>
                                <th>{{ trns('customer') }}</th>
                                <th>{{ trns('apply_date') }}</th>
                                <th>{{ trns('product') }}</th>
                                <th>{{ trns('cargo_type') }}</th>
                                <th>{{ trns('weight') }}</th>
                                <th>{{ trns('price') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $counter = 0;

                                    $user = auth()->user();
                                    $user_unread_comments = $user
                                        ->comment_reads()
                                        ->whereHas('comment', function ($q) use ($order) {
                                            return $q->where('order_id', $order->id);
                                        })
                                        ->where('status', 0)
                                        ->get();
                                @endphp
                                <tr>
                                    <td>{{ $order->code }}</td>
                                    <td>{{ $order->user?->name ?? ' - ' }}</td>
                                    <td>{{ $order->customer?->name ?? ' - ' }}</td>
                                    <td>{{ $order->apply_date?->format('d/m/Y') ?? ' - ' }}</td>
                                    <td>{{ $order->product_name ?? ' - ' }}</td>
                                    <td>
                                        @switch($order->mix_full)
                                            @case('mix')
                                                Mix
                                            @break

                                            @case('full')
                                                Full
                                            @break

                                            @case('automobile')
                                                Avtomobil
                                            @break

                                            @default
                                                -
                                        @endswitch
                                    </td>
                                    <td>{{ $order->cbm ?? ' - ' }}</td>
                                    <td>{{ !empty($order->price) ? $order->price . ' $' : '0 $' }}
                                    </td>
                                    {{-- <td>{{ $order->about_booking_date?->date->format('d/m/Y') ?? ' - ' }}</td> --}}
                                    <td>
                                        <a href="{{ route('admin.order.show', $order->items()->first()?->id) }}"
                                            class="seeDetail">
                                            Bax
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.12547 14.1399C12.1255 14.1399 14.7205 12.4749 16.0555 10.0149C14.7205 7.55489 12.1255 5.88989 9.12547 5.88989C6.12547 5.88989 3.53047 7.55489 2.19547 10.0149C3.53047 12.4749 6.12547 14.1399 9.12547 14.1399ZM9.12547 5.13989C12.5455 5.13989 15.5005 7.12739 16.8955 10.0149C15.5005 12.9024 12.5455 14.8899 9.12547 14.8899C5.70547 14.8899 2.75047 12.9024 1.35547 10.0149C2.75047 7.12739 5.70547 5.13989 9.12547 5.13989ZM9.12547 6.63989C11.0005 6.63989 12.5005 8.13989 12.5005 10.0149C12.5005 11.8899 11.0005 13.3899 9.12547 13.3899C7.25047 13.3899 5.75047 11.8899 5.75047 10.0149C5.75047 8.13989 7.25047 6.63989 9.12547 6.63989ZM9.12547 7.38989C8.42928 7.38989 7.7616 7.66645 7.26931 8.15874C6.77703 8.65102 6.50047 9.3187 6.50047 10.0149C6.50047 10.7111 6.77703 11.3788 7.26931 11.871C7.7616 12.3633 8.42928 12.6399 9.12547 12.6399C9.82166 12.6399 10.4893 12.3633 10.9816 11.871C11.4739 11.3788 11.7505 10.7111 11.7505 10.0149C11.7505 9.3187 11.4739 8.65102 10.9816 8.15874C10.4893 7.66645 9.82166 7.38989 9.12547 7.38989Z"
                                                    fill="white" />
                                            </svg>
                                            @if (count($user_unread_comments))
                                                <span>{{ count($user_unread_comments) }}</span>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="pagination">
            <a href="" class="prev">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 5L9 12L15 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
            <a href="" class="pagination_item active">1</a>
            <a href="" class="pagination_item">2</a>
            <p class="pagination_item">...</p>
            <a href="" class="pagination_item">10</a>
            <a href="" class="next">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L15 12L9 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>
@endsection
