<div class="sub_orderTabContent completedOrders" data-id="completedOrders">
    <div class="confirmedOrders-table">
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
                    <th>{{ trns('booking_date') }}</th>
                    <th>{{ trns('container_code') }}</th>
                    <th>{{ trns('declaration') }}</th>
                    <th>{{ trns('handover') }}</th>
                    <th>{{ trns('date_of_delivery') }}</th>
                    @can('Bitmiş sifarişlər-Bax')
                        <th>&nbsp;</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($order_items as $order_item)
                    @php
                        $products = '';
                        $contract_files = [];
                        $invoice_files = [];
                        $packing_list_files = [];
                        $counter = 0;

                        $order_factory_ids = explode(',', $order_item->order_factory_ids);
                        $order_factories = \App\Models\OrderFactory::whereIn('id', $order_factory_ids)->get();
                        foreach ($order_factories as $order_factory) {
                            foreach ($order_factory->products as $factory_product) {
                                $counter++;
                                $products .= "$counter . " . $factory_product->product->name . '</br>';
                            }

                            if (!is_null($order_factory->file) && !empty($order_factory->file->contract)) {
                                $contract_files[] = $order_factory->file->contract;
                            } else {
                                $contract_files[] = '';
                            }

                            if (!is_null($order_factory->file) && !empty($order_factory->file->invoice)) {
                                $invoice_files[] = $order_factory->file->invoice;
                            } else {
                                $invoice_files[] = '';
                            }

                            if (!is_null($order_factory->file) && !empty($order_factory->file->packing_list)) {
                                $packing_list_files[] = $order_factory->file->packing_list;
                            } else {
                                $packing_list_files[] = '';
                            }
                        }

                        $status_change_ids = explode(',', $order_item->status_change_ids);
                        $latest_status = \App\Models\OrderItemStatusChange::whereIn('id', $status_change_ids)
                            ->orderBy('id', 'desc')
                            ->first();

                        $order = \App\Models\Order::where('id', $order_item->order_id)->first();

                        $image_ids = explode(',', $order_item->image_ids);
                        $order_item_images = \App\Models\OrderItemImage::whereIn('id', $image_ids)->get();
                    @endphp
                    <tr>
                        <td>{{ $order_item->code }}</td>
                        <td>{{ $order_item->user_name }}</td>
                        <td>{{ $order_item->company_name ? $order_item->company_name : $order_item->customer_name ?? '-' }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order_item->apply_date)?->format('d/m/Y') }}</td>
                        <td>{!! $products !!}</td>
                        <td>{{ $order_item->weight }}</td>
                        <td>{{ $order_item->cbm }}</td>
                        <td>{{ $order_item->mix_full == 'mix' ? trns('mix') : ($order_item->mix_full == 'full' ? trns('full') : trns('automobile')) }}
                        </td>
                        <td>
                            <!-- Rezervasiya tarixi olmasa svg gorunsun. -->
                            <div class="reservateDate">
                                @if (is_null($order_item->booking_date))
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 4.77979L5 18.7798M5 4.77979L19 18.7798" stroke="#FF0000"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                @else
                                    <p>{{ \Carbon\Carbon::parse($order_item->booking_date)->format('d.m.Y') }}</p>
                                @endif
                            </div>
                        </td>
                        <td>
                            <!-- Rezervasiya tarixi olmasa svg gorunsun. -->
                            <div class="reservateDate">
                                @if (is_null($order_item->container_name))
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 4.77979L5 18.7798M5 4.77979L19 18.7798" stroke="#FF0000"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                @else
                                    <p>{{ $order_item->container_name }}</p>
                                @endif
                            </div>
                        </td>
                        <td>
                            <!-- arrived, reject, waiting kimi classlar statusa gore,
                                                                                                                                                                                                                                                                                                                                                        verilecek, reng meselesine gore -->
                            <div class="decleration-txt arrived">
                                <span></span>
                                <p>{{ trns('arrived_in_baku') }}</p>
                            </div>
                        </td>
                        <td>
                            <a href="{{ asset($order_item->handover) }}" target="_blank" class="download-file">
                                <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M32.2152 12.0021L23.9027 3.68963C23.7923 3.57939 23.6613 3.49197 23.5171 3.43237C23.373 3.37278 23.2185 3.34216 23.0625 3.34229H8.8125C8.18261 3.34229 7.57852 3.59251 7.13312 4.03791C6.68772 4.48331 6.4375 5.0874 6.4375 5.71729V31.8423C6.4375 32.4722 6.68772 33.0763 7.13312 33.5217C7.57852 33.9671 8.18261 34.2173 8.8125 34.2173H30.1875C30.8174 34.2173 31.4215 33.9671 31.8669 33.5217C32.3123 33.0763 32.5625 32.4722 32.5625 31.8423V12.8423C32.5626 12.6863 32.532 12.5318 32.4724 12.3877C32.4128 12.2435 32.3254 12.1125 32.2152 12.0021ZM24.25 25.9048H14.75C14.4351 25.9048 14.133 25.7797 13.9103 25.557C13.6876 25.3343 13.5625 25.0322 13.5625 24.7173C13.5625 24.4023 13.6876 24.1003 13.9103 23.8776C14.133 23.6549 14.4351 23.5298 14.75 23.5298H24.25C24.5649 23.5298 24.867 23.6549 25.0897 23.8776C25.3124 24.1003 25.4375 24.4023 25.4375 24.7173C25.4375 25.0322 25.3124 25.3343 25.0897 25.557C24.867 25.7797 24.5649 25.9048 24.25 25.9048ZM24.25 21.1548H14.75C14.4351 21.1548 14.133 21.0297 13.9103 20.807C13.6876 20.5843 13.5625 20.2822 13.5625 19.9673C13.5625 19.6523 13.6876 19.3503 13.9103 19.1276C14.133 18.9049 14.4351 18.7798 14.75 18.7798H24.25C24.5649 18.7798 24.867 18.9049 25.0897 19.1276C25.3124 19.3503 25.4375 19.6523 25.4375 19.9673C25.4375 20.2822 25.3124 20.5843 25.0897 20.807C24.867 21.0297 24.5649 21.1548 24.25 21.1548ZM23.0625 12.8423V6.31104L29.5938 12.8423H23.0625Z"
                                        fill="#32B558" />
                                </svg>
                            </a>
                        </td>
                        <td>{{ $latest_status?->created_at?->format('d.m.Y') ?? '-' }}
                        </td>
                        @can('Bitmiş sifarişlər-Bax')
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
