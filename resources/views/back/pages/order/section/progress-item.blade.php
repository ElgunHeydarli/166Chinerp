@php
    $products = '';
    $factories = '';
    $factory_phones = '';
    $box_counts = [];
    $palette_counts = [];
    $contract_files = [];
    $invoice_files = [];
    $packing_list_files = [];
    $order_item->factories->each(function ($factory) {
        $factory->orderFactory->load('file', 'detail', 'products');
    });
    $counter = 0;
    foreach ($order_item->factories as $key => $factory) {
        $order_factory = $factory->orderFactory;
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

        if (!is_null($order_factory->detail) && !is_null($order_factory->detail->box_count)) {
            $box_counts[] = $order_factory->detail->box_count;
        }
        if (!is_null($order_factory->detail) && !is_null($order_factory->detail->palette_count)) {
            $palette_counts[] = $order_factory->detail->palette_count;
        }

        $factories .= $key + 1 . " . $factory->name </br>";
        $factory_phones .= $key + 1 . " . $factory->phone </br>";
    }
@endphp
<div class="modalOrderInfoItem">
    <div class="head-title">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                fill="#534D59" />
        </svg>
        <p>Sifariş məlumatları</p>
    </div>
    <div class="orderInfo-box">
        <div class="orderInfo-item">
            <h2 class="item-title">{{ trns('tracking_code') }}</h2>
            <p>{{ $order->code }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">{{ trns('apply_date') }}</h2>
            <p>{{ $order->apply_date?->format('d/m/Y') }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Daxili daşınma var mı?</h2>
            <p>{{ $order->internal_transport == 1 ? 'Bəli' : 'Xeyr' }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">{{ trns('customer') }}nömrəsi</h2>
            <p>{{ $order->customer?->phone }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">{{ trns('weight') }}</h2>
            <p>{{ $order->weight }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">{{ trns('cube') }}</h2>
            <p>{{ $order->cbm }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">{{ trns('product') }}lar</h2>
            <p>{!! $products !!}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Təhlükəsizlik statusu</h2>
            <p>{{ $order->security_mode == 1 ? 'Təhlükəli' : 'Təhlükəsiz' }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Ünvan</h2>
            <p>{{ $order->address }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Zavodun adı</h2>
            <p>{!! $factories !!}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">{{ trns('price') }}</h2>
            <p>{{ $order->price . ' $' }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Rezervasiya tarixi</h2>
            <p>{{ $order->booking?->date->format('d/m/Y') ?? ' - ' }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Qutu sayı</h2>
            @foreach ($box_counts as $box_count)
                <p>{{ $box_count }}</p>
            @endforeach
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Palet sayı</h2>
            @foreach ($palette_counts as $palette_count)
                <p>{{ $palette_count }}</p>
            @endforeach
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Zavodun nömrəsi</h2>
            <p>{!! $factory_phones !!}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Yönləndirən şəxs</h2>
            <p>{{ $order->referrer }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">{{ trns('added_person') }}</h2>
            <p>{{ $order->user?->name }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Çatdırılma vaxtı</h2>
            <p>{{ $order->delivery_date?->format('d/m/Y') ?? ' - ' }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Rezervasiya tarixi</h2>
            <p>{{ $order->items()->whereHas('booking')->first()?->booking?->date?->format('d/m/Y') ?? ' - ' }}</p>
        </div>
        <div class="orderInfo-item">
            <h2 class="item-title">Konteyner nömrəsi</h2>
            <p>{{ $order->items()->whereHas('booking')->first()?->booking?->container?->code ?? ' - ' }}</p>
        </div>
    </div>
    <div class="orderInfo-files-area">
        <div class="orderInfo-files-left">
            <h2>Tracking</h2>
            <p>{{ $order->code }}</p>
        </div>
        <div class="orderInfo-files" style="padding: 80px 45px;">
            <div class="orderInfo-file-item">
                <h2 class="fileTitle">Müqavilə</h2>
                @foreach ($contract_files as $contract_file)
                    <a href="{{ asset($contract_file) }}" class="file_link" target="_blank">
                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                    </a>
                @endforeach
            </div>
            <div class="orderInfo-file-item">
                <h2 class="fileTitle">İnvoys</h2>
                @foreach ($invoice_files as $invoice_file)
                    <a href="{{ asset($invoice_file) }}" class="file_link" target="_blank">
                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                    </a>
                @endforeach
            </div>
            <div class="orderInfo-file-item">
                <h2 class="fileTitle">Packing list</h2>
                @foreach ($packing_list_files as $packing_list_file)
                    <a href="{{ asset($packing_list_file) }}" class="file_link" target="_blank">
                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                    </a>
                @endforeach
            </div>
            <div class="orderInfo-file-item">
                <h2 class="fileTitle">Railway bill</h2>
                @if (!is_null($order_item->railway_bill?->file))
                    <a href="{{ asset($order_item->railway_bill?->file) }}" class="file_link" target="_blank">
                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                    </a>
                @else
                    <a href="#" class="file_link">
                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                    </a>
                @endif
                @if (!is_null($order_item->railway_bill) && $order_item->railway_bill->status == 0)
                    <div class="railway_buttons" style="top: 100px; flex-direction:column">
                        <button class="accept_raleWay"
                            style="width:90px; background: rgba(62, 197, 8, 0.08); display:flex; align-items:center; justify-content:center; color:#3EC508; font-size:12px;border-radius:5px;"
                            onclick="change_railway_status({{ $order_item->id }},1)" type="button">

                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                style="width: initial; margin-right:5px;" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.66609 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.66609 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.66609 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.66609 20.8 12 20.8ZM10.828 14.558L16.637 8.75L17.485 9.599L11.535 15.549C11.3475 15.7365 11.0932 15.8418 10.828 15.8418C10.5628 15.8418 10.3085 15.7365 10.121 15.549L7 12.426L7.849 11.577L10.829 14.557L10.828 14.558Z"
                                    fill="#3EC508" />
                            </svg>
                            Təsdiq et
                        </button>
                        <button class="reject_raleWay" onclick="change_railway_status({{ $order_item->id }},2)"
                            type="button"
                            style="width: 90px; background: rgba(255, 0, 0, 0.08); display:flex; align-items:center; justify-content:center; color:#FF0000; font-size:12px;border-radius:5px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                style="width: initial; margin-right:5px;" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                            Ləğv et
                        </button>
                    </div>
                @endif
                @if ($order_item->railway_bill)
                    @php
                        $status_changes = $order_item->railway_bill
                            ->status_changes()
                            ->orderBy('created_at', 'asc')
                            ->get();
                    @endphp
                    <div class="log-icon" style="position: absolute;top: 30%;left: 80%;z-index: 99;"
                        onclick="open_log_modal()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3a1.25 1.25 0 1 1 0 2.5A1.25 1.25 0 0 1 12 5zm1 14h-2v-6h2v6z" />
                        </svg>
                    </div>
                    @include('back.pages.order.section.railway-progress-item', [
                        'status_changes' => $status_changes,
                    ])
                    {{-- @foreach ($status_changes as $status_change)
                        <p style="color: #444; font-size: 10px;">

                            {{ $status_change?->status . ' : ' . $status_change?->created_at->format('d.m.Y') }}
                        </p>
                    @endforeach --}}
                @endif
            </div>
            <div class="orderInfo-file-item">
                <h2 class="fileTitle">Declaration</h2>
                @if (!is_null($order_item->declaration?->file))
                    <a href="{{ asset($order_item->declaration?->file) }}" class="file_link" target="_blank">
                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                    </a>
                @else
                    <a href="#" class="file_link">
                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                    </a>
                @endif
            </div>
            <div class="orderInfo-file-item">
                <h2 class="fileTitle">Konteyner şəkilləri</h2>
                <a href="#" class="file_link">
                    <img src="{{ asset('back/assets') }}/images/img.svg" alt="">
                </a>
            </div>
        </div>
    </div>
    @if (count($order_item->services))
        <div class="orderInfo-files-area">
            <div class="orderInfo-files-left">
                <h2>Xidmətlər</h2>
            </div>
            <div class="orderInfo-files">
                <div class="orderInfo-file-item">
                    <h2 class="fileTitle">Id</h2>
                    @foreach ($order->services as $order_service)
                        <p>{{ $order_service->id }}</p>
                    @endforeach
                </div>
                <div class="orderInfo-file-item">
                    <h2 class="fileTitle">Xidmət növü</h2>
                    @foreach ($order->services as $order_service)
                        <p>
                            {{ $order_service->service?->name ?? ' - ' }}
                        </p>
                    @endforeach
                </div>
                <div class="orderInfo-file-item">
                    <h2 class="fileTitle">Vendor</h2>
                    @foreach ($order->services as $order_service)
                        <p>{{ $order_service->vendor?->vendor_name }}</p>
                    @endforeach
                </div>
                <div class="orderInfo-file-item">
                    <h2 class="fileTitle">Alış məbləği</h2>
                    @foreach ($order->services as $order_service)
                        <p>{{ $order_service->purchase_price }}</p>
                    @endforeach
                </div>
                <div class="orderInfo-file-item">
                    <h2 class="fileTitle">Tarix</h2>
                    @foreach ($order->services as $order_service)
                        <p>{{ $order_service->date?->format('d.m.Y') }}</p>
                    @endforeach
                </div>
                <div class="orderInfo-file-item">
                    <h2 class="fileTitle">Satış məbləği</h2>
                    @foreach ($order->services as $order_service)
                        <p>{{ $order_service->sale_price }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @can('İcrada olan sifarişlər-Log click -Comment')
        <div class="comment-box">
            <h3>Comment</h3>
            <div class="comment-write-area">
                @foreach ($order->comments as $comment)
                    <div class="comment-item">
                        <h4 class="userName">{{ $comment->user->name }}</h4>
                        <div class="comment-txt">
                            <p>{{ $comment->text }}</p>
                        </div>
                        <span class="comment-time">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="sendComment-box">
                <div class="inputs">
                    <input type="text" name="text" placeholder="Send message">
                    <div class="inputFile">
                        <div class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.616 16.077H7.077C5.949 16.077 4.98767 15.6797 4.193 14.885C3.39833 14.0903 3.00067 13.1287 3 12C2.99933 10.8713 3.397 9.90966 4.193 9.115C4.989 8.32033 5.95033 7.92266 7.077 7.922H10.616V8.922H7.077C6.23033 8.922 5.506 9.22333 4.904 9.826C4.30133 10.4293 4 11.154 4 12C4 12.846 4.30133 13.5703 4.904 14.173C5.50667 14.7757 6.231 15.077 7.077 15.077H10.616V16.077ZM8.5 12.5V11.5H15.5V12.5H8.5ZM13.385 16.077V15.077H16.923C17.7697 15.077 18.494 14.7757 19.096 14.173C19.6987 13.5703 20 12.846 20 12C20 11.154 19.6987 10.4297 19.096 9.827C18.4933 9.22433 17.769 8.923 16.923 8.923H13.385V7.923H16.923C18.051 7.923 19.0127 8.32033 19.808 9.115C20.6033 9.90966 21.0007 10.8713 21 12C20.9993 13.1287 20.6017 14.0903 19.807 14.885C19.0123 15.6797 18.051 16.0773 16.923 16.078L13.385 16.077Z"
                                    fill="#A9A9A9" />
                            </svg>
                        </div>
                        <input type="file">
                    </div>
                </div>
                <button class="sendComment-btn" onclick="send_comment(this)"
                    data-url="{{ route('admin.order.send-comment', $order->id) }}" type="button">Send</button>
            </div>
        </div>
    @endcan
</div>
