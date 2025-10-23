@extends('back.layouts.master')

@section('content')
    @php
        use App\Enums\CustomerType;

        $order_item->factories->each(function ($factory) {
            $factory->orderFactory->load('products', 'detail');
        });

        $products = [];
        $box_counts = [];
        $palette_counts = [];

        foreach ($order_item->factories as $factory) {
            $order_factory = $factory->orderFactory;
            foreach ($order_factory->products as $factory_product) {
                $products[] = $factory_product->product->name;
            }
            if (!is_null($order_factory->detail) && !is_null($order_factory->detail->box_count)) {
                $box_counts[] = $order_factory->detail->box_count;
            }
            if (!is_null($order_factory->detail) && !is_null($order_factory->detail->palette_count)) {
                $palette_counts[] = $order_factory->detail->palette_count;
            }
        }
    @endphp

    <div class="awaitPrice-view-container">
        <a href="{{ route('admin.order.index', ['status' => $order->status]) }}" class="backLink">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.80442 17.7083L18.0112 25.9136L16.9997 26.9166L7.08301 16.9999L16.9997 7.08325L18.0112 8.08625L9.80301 16.2916H26.9163V17.7083H9.80442Z"
                    fill="black" />
            </svg>
            Geri
        </a>
        <div class="head-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                    fill="#534D59" />
            </svg>
            <p>Sifariş məlumatları</p>
        </div>
        <div class="awaitPrice-main">
            <div class="awaitPrice-details"
                style="max-width: {{ $order->status == \App\Enums\OrderStatus::DRAFT ? '760px' : '100%' }}">
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>{{ trns('customer') }}növü</h2>
                        <p>
                            @switch($order->customer?->type)
                                @case(CustomerType::PHYSICAL)
                                    Fiziki
                                @break

                                @case(CustomerType::LEGAL)
                                    Hüquqi
                                @break

                                @case(CustomerType::OWNER)
                                    Fərdi Sahibkar
                                @break

                                @default
                            @endswitch
                        </p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>{{ trns('customer') }}(Ad, Soyad)</h2>
                        <p>{{ $order->customer?->name ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>FIN/VÖEN</h2>
                        <p>{{ $order->customer?->fin ? $order->customer->fin : $order->customer->voen }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Malın adı</h2>
                        <p>{{ $order->product_name ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Mix/Full</h2>
                        <p>{{ $order->mix_full }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Yükləmə nöqtəsi</h2>
                        <p>{{ $order->loading_point ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>TAX Id</h2>
                        <p>{{ $order->tax_id ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Tədarükçünün ünvanı</h2>
                        <p>{{ $order->supplier_address ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>{{ trns('weight') }}</h2>
                        <p>{{ $order->weight ?? 0 }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>CBM</h2>
                        <p>{{ $order->cbm ?? 0 }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Incoterm</h2>
                        <p>{{ $order->incoterm?->name ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Gömrükləmə</h2>
                        <p>{{ $order->customs_clearance?->name ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Stackable Status</h2>
                        <p>{{ $order->stackable == 1 ? 'Stackable' : 'Non Stackable' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Yer sayı</h2>
                        <p>{{ $order->number_of_places ?? 0 }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>En</h2>
                        <p>{{ $order->width ?? 0 }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Uzunluq</h2>
                        <p>{{ $order->length ?? 0 }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Hündürlük</h2>
                        <p>{{ $order->height ?? 0 }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Təhlükəsizlik statusu</h2>
                        <p>{{ $order->security_mode == 1 ? 'Təhlükəli' : 'Təhlükəsiz' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Tədarükçünün export hüququ var mı?</h2>
                        <p>{{ $order->exportable == 1 ? 'Bəli' : 'Xeyr' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>MSDS</h2>
                        <p>{{ $order->msds ?? ' - ' }}</p>
                    </div>
                </div>
                @if ($order->mix_full == 'full')
                    <div class="detail-box">
                        <div class="detail-item">
                            <h2>Konteyner növü</h2>
                            <p>{{ $order->container_type->name ?? ' - ' }}</p>
                        </div>
                    </div>
                @endif
                @if ($order->mix_full == 'automobile')
                    <div class="detail-box">
                        <div class="detail-item">
                            <h2>Maşın növü</h2>
                            <p>{{ $order->first_car_type->name ?? ' - ' }}</p>
                        </div>
                    </div>
                    <div class="detail-box">
                        <div class="detail-item">
                            <h2>Maşın sayı</h2>
                            <p>{{ $order->first_car_count ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="detail-box">

                        <div class="detail-item">
                            <h2>Maşın növü</h2>
                            <p>{{ $order->second_car_type?->name ?? ' - ' }}</p>
                        </div>
                    </div>
                    <div class="detail-box">

                        <div class="detail-item">
                            <h2>Maşın sayı</h2>
                            <p>{{ $order->second_car_count ?? 0 }}</p>
                        </div>
                    </div>
                @endif
                <div class="detail-box">

                    <div class="detail-item">
                        <h2>{{ trns('price') }}</h2>
                        <p>{{ $order->price . ' ' . $order->price_currency }}</p>
                    </div>
                </div>
                @if (count($order->files))
                    <div class="detail-box">
                        <div class="detail-item">
                            <h2>Fayl</h2>
                            <a href="{{ asset($order->files()->first()->file) }}" target="_blank">
                                <img src="{{ asset('back/assets/images/pdfImg.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                @endif
                <div class="detail-box">

                    <div class="detail-item">
                        <h2>{{ trns('product') }}lar</h2>
                        @foreach ($products as $product)
                            <p>{{ $product }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Zavodun adı</h2>
                        @foreach ($order_item->factories as $factory)
                            <p>{{ $factory->name }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="detail-box">

                    <div class="detail-item">
                        <h2>Zavodun nömrəsi</h2>
                        @foreach ($order_item->factories as $factory)
                            <p>{{ $factory->phone }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="detail-box">

                    <div class="detail-item">
                        <h2>{{ trns('apply_date') }}</h2>
                        <p>{{ $order->apply_date?->format('d/m/Y') ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">

                    <div class="detail-item">
                        <h2>Təhvil verilmə məntəqəsi</h2>
                        <p>{{ $order->loading_point ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Təxmini rezervasiya tarixi</h2>
                        <p>{{ $order->about_booking_date?->date?->format('d/m/Y') ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>{{ trns('added_person') }}</h2>
                        <p>{{ $order->user?->name ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Qutu sayı</h2>
                        @foreach ($box_counts as $box_count)
                            <p>{{ $box_count }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Pallet sayı</h2>
                        @foreach ($palette_counts as $palette_count)
                            <p>{{ $palette_count }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Ünvan</h2>
                        <p>{{ $order->address ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Danışan şəxs</h2>
                        <p>{{ $order->user?->name ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Hazır olma statusu</h2>
                        <p>{{ $order->ready_status == 1 ? 'Bəli' : 'Xeyr' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Rezervasiya tarixi</h2>
                        <p>{{ $order->items()->whereHas('booking')->first()?->booking?->date?->format('d/m/Y') ?? ' - ' }}
                        </p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Konteyner nömrəsi</h2>
                        <p>{{ $order->items()->whereHas('booking')->first()?->booking?->container?->code ?? ' - ' }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <div class="detail-item">
                        <h2>Qeyd</h2>
                        <p>{{ $order->note ?? ' - ' }}
                        </p>
                    </div>
                </div>
                @if (!is_null($order_item->railway_bill))
                    <div class="detail-box">
                        <div class="detail-item">
                            <h2>Railway bill</h2>
                            <a href="{{ asset($order_item->railway_bill->file) }}" target="_blank">
                                <img src="{{ asset('back/assets/images/pdfImg.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                @endif

                @if (!is_null($order_item->declaration))
                    <div class="detail-box">
                        <div class="detail-item">
                            <h2>Declaration</h2>
                            <a href="{{ asset($order_item->declaration->file) }}" target="_blank">
                                <img src="{{ asset('back/assets/images/pdfImg.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                @endif

                @if (!is_null($order_item->handover))
                    <div class="detail-box">
                        <div class="detail-item">
                            <h2>T/T aktı</h2>
                            <a href="{{ asset($order_item->handover) }}" target="_blank">
                                <img src="{{ asset('back/assets/images/pdfImg.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                @endif

                @if ($order->status == \App\Enums\OrderStatus::REJECTED)
                    <div class="detail-box">
                        <div class="detail-item">
                            <h2>Ləğvetmə səbəbi</h2>
                            <p>{{ $order->reject?->reject_reason?->name ?? ' - ' }}
                            </p>
                        </div>
                    </div>
                    <div class="detail-box">
                        <div class="detail-item">
                            <h2>Ləğv edilmə qeydi</h2>
                            <p>{{ $order->reject->note ?? ' - ' }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
            @if ($order->status == \App\Enums\OrderStatus::DRAFT)
                <div class="calculatator-form">
                    <div class="calculatator-box">
                        <h2>Calculator</h2>
                        <div class="calculatator-items">
                            @foreach ($price_types as $price_type)
                                @php
                                    $order_price_type = $order
                                        ->price_types()
                                        ->where('price_type_id', $price_type->id)
                                        ->first();
                                @endphp
                                <div class="calculatator-item">
                                    <p>{{ $price_type->name }} :</p>
                                    <div class="item-main">
                                        <input type="hidden" name="price_type_id[]" value="{{ $price_type->id }}">
                                        {{-- <input type="text" class="price-value" oninput="calculate_total_price()"
                                        placeholder="text here"> --}}
                                        <input type="text" oninput="convert_only_numeric(this)"
                                            class="price-value price-input" value="{{ $order_price_type?->price ?? 0 }}"
                                            placeholder="text here">
                                        <select name="" class="nice-select" id="">
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->symbol }}"
                                                    {{ $order_price_type?->currency == $currency->symbol ? 'selected' : '' }}>
                                                    {{ $currency->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                            <div class="calculatator-item">
                                <p>Cəmi : </p>
                                <div class="item-main">
                                    <input type="text" class="price-value" oninput="convert_only_numeric(this)"
                                        name="total_price" value="{{ $order->price }}">
                                    <select name="currency" onchange="convert_currency(this)" class="nice-select"
                                        id="total_price_currency">
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->symbol }}"
                                                {{ $order->price_currency == $currency->symbol ? 'selected' : '' }}>
                                                {{ $currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
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
                            @can('Qiymət gözləyən sifarişlər page-Bax-Comment')
                                <form method="POST" enctype="multipart/form-data">
                                    @csrf
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
                                                <input type="file" name="file">
                                            </div>
                                        </div>
                                        <button data-url="{{ route('admin.order.send-comment', $order->id) }}"
                                            class="sendComment-btn" onclick="send_comment(this)" type="button">Send</button>
                                    </div>
                                </form>
                            @endcan
                        </div>

                    </div>
                    {{-- <div class="totalBox">
                    <p>Cəmi :</p>
                    <span>{{ $order->price }}</span>
                </div> --}}
                    <div style="display: flex;align-items: center;justify-content: end;gap: 20px;width: 100%;">
                        @can('Qiymət gözləyən sifarişlər page-Bax-Hesabla')
                            <button class="submitCalculator"
                                onclick="calculate_total_price({{ $order->id }})">Hesabla</button>
                        @endcan
                        @can('Qiymət gözləyən sifarişlər page-Bax-Təsdiqlə')
                            <button class="submitCalculator" onclick="submit_order_price({{ $order->id }})">Təsdiq
                                et</button>
                        @endcan
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

@push('js')
    <script>
        function calculate_total_price() {
            let calculator_items = document.querySelectorAll('.calculatator-item .price-input');
            let calculator_currencies = document.querySelectorAll('.calculatator-item select');
            let total_box = document.querySelector('.totalBox span');
            let currency_data = {
                'AZN': 1,
                'USD': 1.7,
                'CNY': 0.23
            }
            let total_price = 0;
            calculator_items.forEach((calculator_item, index) => {
                let currency = calculator_currencies[index].value;
                let currency_index = currency_data[currency] ?? 1;
                let price = +(calculator_item.value ?? 0) * currency_index;
                total_price += price;
            });

            let total_price_currency = document.getElementById('total_price_currency').value;
            let total_price_currency_index = currency_data[total_price_currency] ?? 1;



            document.querySelector('[name="total_price"]').value = (total_price / total_price_currency_index).toFixed(2);
            return total_price;
        }


        function convert_currency(item) {
            let total_price = calculate_total_price();
            let currency_data = {
                'AZN': 1,
                'USD': 1.7,
                'CNY': 0.23
            }
            let currency = item.value;
            let currency_index = currency_data[currency] ?? 1;
            document.querySelector('[name="total_price"]').value = (total_price / currency_index).toFixed(2);
        }
    </script>

    <script>
        function submit_order_price(order_id) {
            event.preventDefault();
            let price_types = [];
            let prices = [];
            let currencies = [];
            let price_type_ids = document.querySelectorAll('[name="price_type_id[]"]');
            let calculator_items = document.querySelectorAll('.calculatator-item .price-input');
            let calculator_currencies = document.querySelectorAll('.calculatator-item select');
            let total_price = document.querySelector('[name="total_price"]').value;
            let total_price_currency = document.getElementById('total_price_currency').value;
            price_type_ids.forEach(price_type => {
                let price_type_id = +price_type.value;
                price_types.push(price_type_id);
            });

            calculator_items.forEach(calculator_item => {
                let price = +calculator_item.value ?? 0;
                prices.push(price);
            });

            calculator_currencies.forEach(currency => {
                currencies.push(currency.value);
            })

            let url = `/order/${order_id}/set-prices`;
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': "{{ csrf_token() }}",
                        'price_type_ids': price_types,
                        'prices': prices,
                        'total_price': total_price,
                        'currency': currencies,
                        'final_currency': total_price_currency,
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // let total_box = document.querySelector('.totalBox span');
                    // let total_price = calculate_total_price();
                    // total_box.innerText = total_price;
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        window.location.href = data.redirect_url;
                    } else {
                        console.log(data);
                        // toastr.error(data.message);
                    }
                });
        }
    </script>

    <script>
        function convert_only_numeric(item) {
            // Yalnız rəqəmlər və nöqtə və ya vergülə icazə verilir
            item.value = item.value.replace(/[^0-9.,]/g, "");

            // Əgər həm nöqtə, həm də vergül varsa – yalnız birini saxla, məsələn nöqtəni
            if (item.value.includes('.') && item.value.includes(',')) {
                // Ən son daxil ediləni sil
                item.value = item.value.slice(0, -1);
                return;
            }

            // Birdən çox nöqtə və ya birdən çox vergül varsa, yalnız birincisini saxla
            let dotCount = (item.value.match(/\./g) || []).length;
            let commaCount = (item.value.match(/,/g) || []).length;

            if (dotCount > 1) {
                let parts = item.value.split('.');
                item.value = parts[0] + '.' + parts.slice(1).join('');
            }

            if (commaCount > 1) {
                let parts = item.value.split(',');
                item.value = parts[0] + ',' + parts.slice(1).join('');
            }

            // Əgər ədəd onluq DEYİLSƏ və sıfırla başlayırsa, sıfırı sil
            if (
                item.value.startsWith("0") &&
                item.value.length > 1 &&
                !item.value.startsWith("0.") &&
                !item.value.startsWith("0,")
            ) {
                item.value = item.value.replace(/^0+/, '');
            }
        }
    </script>

    <script>
        function send_comment(item) {
            event.preventDefault();
            let url = item.getAttribute('data-url');
            let text = document.querySelector('[name="text"]');
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': "{{ csrf_token() }}",
                        'text': text.value,
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        let comment_write_area = document.querySelector('.comment-write-area');
                        let html = `<div class="comment-item">
                                    <h4 class="userName">${data.data.user}</h4>
                                    <div class="comment-txt">
                                        <p>${data.data.text}</p>
                                    </div>
                                    <span class="comment-time">${data.data.time}</span>
                                </div>`;
                        comment_write_area.insertAdjacentHTML('beforeend', html);
                        text.value = '';
                        toastr.success(data.message);
                    }

                });
        }
    </script>
@endpush
