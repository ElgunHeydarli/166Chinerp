@extends('back.layouts.master')

@section('content')
    <div class="orderExecution-container">
        <a href="{{ route('admin.order.index', ['status' => \App\Enums\OrderStatus::CONFIRMED]) }}" class="backLink">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.80442 17.7083L18.0112 25.9136L16.9997 26.9166L7.08301 16.9999L16.9997 7.08325L18.0112 8.08625L9.80301 16.2916H26.9163V17.7083H9.80442Z"
                    fill="black" />
            </svg>
            Geri
        </a>
        <form action="{{ route('admin.order.update', $order_item->id) }}" method="POST" class="orderExecution-form"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="top-selects">
                <div class="form-item">
                    <label for="">Daşınma tipləri</label>
                    <select name="transportation_type_id" class="nice-select" onchange="get_transportation_services(this)"
                        id="">
                        <option value="">Seçin</option>
                        @foreach ($transportation_types as $transportation_type)
                            <option value="{{ $transportation_type->id }}"
                                {{ old('transportation_type_id', 1) == $transportation_type->id ? 'selected' : '' }}>
                                {{ $transportation_type->name }}</option>
                        @endforeach
                    </select>
                    <button class="resetSelectBtn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#FF0000" />
                        </svg>
                    </button>
                </div>
                <div class="form-item" id="transportation-service">
                    <label for="">Daşınma xidməti</label>
                    <select name="transportation_service_id" class="nice-select" onchange="get_transportations(this)"
                        id="">
                        <option value="">Seçin</option>
                        @foreach ($transportation_services as $transportation_service)
                            <option value="{{ $transportation_service->id }}"
                                {{ old('transportation_service_id', 1) == $transportation_service->id ? 'selected' : '' }}>
                                {{ $transportation_service->name }}</option>
                        @endforeach
                    </select>
                    <button class="resetSelectBtn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#FF0000" />
                        </svg>
                    </button>
                </div>
                <div class="form-item" id="transportation">
                    <label for="">Daşınma</label>
                    <select name="transportation_id" class="nice-select" id="">
                        <option value="">Seçin</option>
                        @foreach ($transportations as $transportation)
                            <option value="{{ $transportation->id }}"
                                {{ old('transportation_id', 1) == $transportation->id ? 'selected' : '' }}>
                                {{ $transportation->name }}</option>
                        @endforeach
                    </select>
                    <button class="resetSelectBtn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#FF0000" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="head-title">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                        fill="#534D59" />
                </svg>
                <p>Sifariş məlumatları</p>
            </div>
            <div class="orderInfoForm">
                <div class="form-line">
                    <div class="form-item">
                        <label for="">{{ trns('customer') }}növü</label>
                        <select name="customer_type" class="nice-select" onchange="get_customers(this)" id="">
                            <option value="">Seçin</option>
                            <option value="physical"
                                {{ $order->customer?->type == \App\Enums\CustomerType::PHYSICAL ? 'selected' : '' }}>Fiziki
                            </option>
                            <option value="legal"
                                {{ $order->customer?->type == \App\Enums\CustomerType::LEGAL ? 'selected' : '' }}>Hüquqi
                            </option>
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                    <div class="form-item">
                        <label for="">Müştəri</label>
                        <select name="customer_id" class="select2" onchange="get_fin_voen(this)" id="">
                            <option value="">Seçin</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                    <div class="form-item">
                        <label for="">Vöen/Fin</label>
                        <input type="text" name="voen_fin" oninput="convert_alphanumeric(this)"
                            value="{{ !is_null($order->customer?->fin) ? $order->customer?->fin : $order->customer?->voen }}"
                            placeholder="text here">
                    </div>
                    <div class="form-item">
                        <label for="">{{ trns('customer') }}əlaqə nömrəsi</label>
                        <input type="text" name="customer_phone" oninput="convert_numeric(this)"
                            placeholder="text here" value="{{ $order->customer?->phone }}">
                    </div>
                    <div class="form-item">
                        <label for="">{{ trns('price') }}</label>
                        <input type="text" name="price" oninput="convert_numeric(this)"
                            value="{{ $order->price }}" placeholder="Default">
                    </div>
                    <div class="form-item">
                        <label for="">Valyuta</label>
                        <select name="price_currency" class="nice-select" id="">
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->symbol }}"
                                    {{ $order->price_currency == $currency->symbol ? 'selected' : '' }}>
                                    {{ $currency->code }}</option>
                            @endforeach
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                    <div class="form-item">
                        <label for="">Yükün adı</label>
                        <input type="text" oninput="convert_letter(this)" name="product_name"
                            value="{{ $order->product_name }}" placeholder="text here">
                    </div>
                    <div class="form-item">
                        <label for="">Yükləmə nöqtəsi</label>
                        <input type="text" oninput="convert_letter(this)" name="loading_point"
                            value="{{ $order->loading_point }}" placeholder="text here">
                    </div>
                    <div class="form-item">
                        <label for="">TAX Id</label>
                        <input type="text" oninput="convert_alphanumeric(this)" name="tax_id"
                            value="{{ $order->tax_id }}" placeholder="text here">
                    </div>
                    <div class="form-item">
                        <label for="">Tədarükçünün ünvanı</label>
                        <input type="text" oninput="convert_letter(this)" name="supplier_address"
                            value="{{ $order->supplier_address }}" placeholder="text here">
                    </div>
                    <div class="form-item">
                        <label for="">Təxmini çatdırılma vaxtı</label>
                        <input type="text" class="datetimepicker" name="delivery_date" autocomplete="off"
                            value="{{ $order->delivery_date?->format('d.m.Y') }}" placeholder="Təxmini çatdırılma vaxtı">
                        <div class="calendar-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.5 3.75H4.5C3.25736 3.75 2.25 4.75736 2.25 6V19.5C2.25 20.7426 3.25736 21.75 4.5 21.75H19.5C20.7426 21.75 21.75 20.7426 21.75 19.5V6C21.75 4.75736 20.7426 3.75 19.5 3.75Z"
                                    stroke="#959595" stroke-linejoin="round" />
                                <path
                                    d="M13.875 12C14.4963 12 15 11.4963 15 10.875C15 10.2537 14.4963 9.75 13.875 9.75C13.2537 9.75 12.75 10.2537 12.75 10.875C12.75 11.4963 13.2537 12 13.875 12Z"
                                    fill="#959595" />
                                <path
                                    d="M17.625 12C18.2463 12 18.75 11.4963 18.75 10.875C18.75 10.2537 18.2463 9.75 17.625 9.75C17.0037 9.75 16.5 10.2537 16.5 10.875C16.5 11.4963 17.0037 12 17.625 12Z"
                                    fill="#959595" />
                                <path
                                    d="M13.875 15.75C14.4963 15.75 15 15.2463 15 14.625C15 14.0037 14.4963 13.5 13.875 13.5C13.2537 13.5 12.75 14.0037 12.75 14.625C12.75 15.2463 13.2537 15.75 13.875 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M17.625 15.75C18.2463 15.75 18.75 15.2463 18.75 14.625C18.75 14.0037 18.2463 13.5 17.625 13.5C17.0037 13.5 16.5 14.0037 16.5 14.625C16.5 15.2463 17.0037 15.75 17.625 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M6.375 15.75C6.99632 15.75 7.5 15.2463 7.5 14.625C7.5 14.0037 6.99632 13.5 6.375 13.5C5.75368 13.5 5.25 14.0037 5.25 14.625C5.25 15.2463 5.75368 15.75 6.375 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M10.125 15.75C10.7463 15.75 11.25 15.2463 11.25 14.625C11.25 14.0037 10.7463 13.5 10.125 13.5C9.50368 13.5 9 14.0037 9 14.625C9 15.2463 9.50368 15.75 10.125 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M6.375 19.5C6.99632 19.5 7.5 18.9963 7.5 18.375C7.5 17.7537 6.99632 17.25 6.375 17.25C5.75368 17.25 5.25 17.7537 5.25 18.375C5.25 18.9963 5.75368 19.5 6.375 19.5Z"
                                    fill="#959595" />
                                <path
                                    d="M10.125 19.5C10.7463 19.5 11.25 18.9963 11.25 18.375C11.25 17.7537 10.7463 17.25 10.125 17.25C9.50368 17.25 9 17.7537 9 18.375C9 18.9963 9.50368 19.5 10.125 19.5Z"
                                    fill="#959595" />
                                <path
                                    d="M13.875 19.5C14.4963 19.5 15 18.9963 15 18.375C15 17.7537 14.4963 17.25 13.875 17.25C13.2537 17.25 12.75 17.7537 12.75 18.375C12.75 18.9963 13.2537 19.5 13.875 19.5Z"
                                    fill="#959595" />
                                <path d="M6 2.25V3.75M18 2.25V3.75" stroke="#959595" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M21.75 7.5H2.25" stroke="#959595" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <div class="form-radios">
                        <p>Daxili daşınma var mı</p>
                        <div class="radios">
                            <div class="radio-item">
                                <input type="radio" name="internal_transport"
                                    {{ $order->internal_transport === 1 ? 'checked' : '' }} value="1">
                                <label for="">Bəli</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" name="internal_transport"
                                    {{ $order->internal_transport === 0 ? 'checked' : '' }} value="0">
                                <label for="">Xeyr</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-radios">
                        <p>
                            Təhlükəsizlik statusu
                        </p>
                        <div class="radios">
                            <div class="radio-item">
                                <input type="radio" name="security_mode" id="security_mode_danger"
                                    {{ $order->security_mode === 1 ? 'checked' : '' }} value="1">
                                <label for="security_mode_danger">Təhlükəli</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" name="security_mode" id="security_mode_safe"
                                    {{ $order->security_mode === 0 ? 'checked' : '' }} value="0">
                                <label for="security_mode_safe">Təhlükəsiz</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-radios">
                        <p>Tədarükçünün export hüququ var mı?</p>
                        <div class="radios">
                            <div class="radio-item">
                                <input type="radio" name="exportable" id="exportable_danger"
                                    {{ $order->exportable === 1 ? 'checked' : '' }} value="1">
                                <label for="exportable_danger">Bəli</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" name="exportable" id="exportable_safe"
                                    {{ $order->exportable === 0 ? 'checked' : '' }} value="0">
                                <label for="exportable_safe">Xeyr</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-item" id="msds"
                        style="display: {{ $order->security_mode === 1 ? 'block' : 'none' }}">
                        <label for="">MSDS</label>
                        <input type="text" name="msds" value="{{ $order->msds }}">
                    </div>
                </div>
                <div class="form-line-item">
                    <div class="form-adress">
                        <div class="form-item">
                            <label for="">Ünvan</label>
                            <input type="text" name="address" value="{{ $order->address }}" placeholder="text here">
                        </div>
                        <div class="form-item">
                            <label for="">Rayon</label>
                            <select name="district_id" class="nice-select" id="">
                                <option value="">Seçin</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $order->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-item">
                            <label for="">Şəhər</label>
                            <select name="city_id" class="nice-select" id="">
                                <option value="">Seçin</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $order->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-radios">
                        <p>
                            Hazır olma statusu
                        </p>
                        <div class="radios">
                            <div class="radio-item">
                                <input type="radio" name="ready_status"
                                    {{ $order->ready_status === 1 ? 'checked' : '' }} value="1">
                                <label for="">Bəli</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" name="ready_status"
                                    {{ $order->ready_status === 0 ? 'checked' : '' }} value="0">
                                <label for="">Xeyr</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-item form-item-anbar">
                        <label for="">Anbar seçimi</label>
                        <select class="nice-select" name="warehouse_id" id="">
                            <option value="">Seçin</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}"
                                    {{ $order->warehouse_id == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-line" style="grid-template-columns: repeat(3,1fr);">
                    <div class="form-item">
                        <label for="">{{ trns('apply_date') }}</label>
                        <input type="text" name="apply_date" class="datetimepicker"
                            value="{{ $order->apply_date?->format('d.m.Y') }}" placeholder="{{ trns('apply_date') }}">
                        <div class="calendar-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.5 3.75H4.5C3.25736 3.75 2.25 4.75736 2.25 6V19.5C2.25 20.7426 3.25736 21.75 4.5 21.75H19.5C20.7426 21.75 21.75 20.7426 21.75 19.5V6C21.75 4.75736 20.7426 3.75 19.5 3.75Z"
                                    stroke="#959595" stroke-linejoin="round" />
                                <path
                                    d="M13.875 12C14.4963 12 15 11.4963 15 10.875C15 10.2537 14.4963 9.75 13.875 9.75C13.2537 9.75 12.75 10.2537 12.75 10.875C12.75 11.4963 13.2537 12 13.875 12Z"
                                    fill="#959595" />
                                <path
                                    d="M17.625 12C18.2463 12 18.75 11.4963 18.75 10.875C18.75 10.2537 18.2463 9.75 17.625 9.75C17.0037 9.75 16.5 10.2537 16.5 10.875C16.5 11.4963 17.0037 12 17.625 12Z"
                                    fill="#959595" />
                                <path
                                    d="M13.875 15.75C14.4963 15.75 15 15.2463 15 14.625C15 14.0037 14.4963 13.5 13.875 13.5C13.2537 13.5 12.75 14.0037 12.75 14.625C12.75 15.2463 13.2537 15.75 13.875 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M17.625 15.75C18.2463 15.75 18.75 15.2463 18.75 14.625C18.75 14.0037 18.2463 13.5 17.625 13.5C17.0037 13.5 16.5 14.0037 16.5 14.625C16.5 15.2463 17.0037 15.75 17.625 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M6.375 15.75C6.99632 15.75 7.5 15.2463 7.5 14.625C7.5 14.0037 6.99632 13.5 6.375 13.5C5.75368 13.5 5.25 14.0037 5.25 14.625C5.25 15.2463 5.75368 15.75 6.375 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M10.125 15.75C10.7463 15.75 11.25 15.2463 11.25 14.625C11.25 14.0037 10.7463 13.5 10.125 13.5C9.50368 13.5 9 14.0037 9 14.625C9 15.2463 9.50368 15.75 10.125 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M6.375 19.5C6.99632 19.5 7.5 18.9963 7.5 18.375C7.5 17.7537 6.99632 17.25 6.375 17.25C5.75368 17.25 5.25 17.7537 5.25 18.375C5.25 18.9963 5.75368 19.5 6.375 19.5Z"
                                    fill="#959595" />
                                <path
                                    d="M10.125 19.5C10.7463 19.5 11.25 18.9963 11.25 18.375C11.25 17.7537 10.7463 17.25 10.125 17.25C9.50368 17.25 9 17.7537 9 18.375C9 18.9963 9.50368 19.5 10.125 19.5Z"
                                    fill="#959595" />
                                <path
                                    d="M13.875 19.5C14.4963 19.5 15 18.9963 15 18.375C15 17.7537 14.4963 17.25 13.875 17.25C13.2537 17.25 12.75 17.7537 12.75 18.375C12.75 18.9963 13.2537 19.5 13.875 19.5Z"
                                    fill="#959595" />
                                <path d="M6 2.25V3.75M18 2.25V3.75" stroke="#959595" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M21.75 7.5H2.25" stroke="#959595" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="">Mix/Full <span>*</span></label>
                        <select class="nice-select" onchange="change_mix_full(this)" name="mix_full" id="">
                            <option value="">Seçin</option>
                            @foreach ($mix_fulles as $mix_full)
                                <option value="{{ $mix_full->short_name }}"
                                    {{ $mix_full->short_name == $order->mix_full ? 'selected' : '' }}>
                                    {{ $mix_full->name }}</option>
                            @endforeach
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                    <div class="form-item" id="container_count"
                        style="display:{{ $order->mix_full == 'full' ? 'flex' : 'none' }};">
                        <label for="">{{ trns('container_count') }}</label>
                        <select class="select2" name="container_count" id="">
                            @for ($i = 1; $i <= 50; $i++)
                                <option value="{{ $i }}"
                                    {{ $order->container_count == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                    <div class="form-item" id="cbm"
                        style="display: {{ $order->mix_full == 'full' ? 'none' : 'flex' }};">
                        <label for="">CBM</label>
                        <input type="text" oninput="convert_numeric(this)" name="cbm"
                            value="{{ $order->cbm }}" placeholder="text here...">
                    </div>
                    <div class="form-item">
                        <label for="">Yönləndirən şəxs</label>
                        {{-- <input type="text" oninput="convert_letter(this)" name="referrer"
                            value="{{ $order->referrer }}" placeholder="text here"> --}}
                        <div class="add-referrer-select">
                            <select name="referrer" id="" class="select2">
                                <option value="">Seçin</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->name }}"
                                        {{ $order->referrer == $user->name ? 'selected' : '' }}>{{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="add-referrer-btn" type="button">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 4.16675V15.8334" stroke="#02A3ED" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4.1665 10H15.8332" stroke="#02A3ED" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="">Gömrükləmə</label>
                        <select class="nice-select" name="customs_clearance_id" id="">
                            <option value="">Seçin</option>
                            @foreach ($customs_clearances as $customs_clearance)
                                <option value="{{ $customs_clearance->id }}"
                                    {{ $order->customs_clearance_id == $customs_clearance->id ? 'selected' : '' }}>
                                    {{ $customs_clearance->name }}</option>
                            @endforeach
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                    <div class="form-item" id="weight"
                        style="display : {{ $order->mix_full == 'mix' || $order->mix_full == 'full' ? 'flex' : 'none' }};">
                        <label for="">{{ trns('weight') }}</label>
                        <input type="text" oninput="convert_numeric(this)" name="weight"
                            value="{{ $order->weight }}" placeholder="text here...">
                    </div>
                    {{-- <div class="form-item" id="cube"
                        style="display : {{ $order->mix_full == 'mix' || $order->mix_full == 'full' ? 'flex' : 'none' }};">
                        <label for="">{{ trns('cube') }}</label>
                        <input type="number" oninput="convert_numeric(this)" name="cube"
                            value="{{ $order->cube }}" placeholder="text here...">
                    </div> --}}
                    <div class="form-item" id="first_car_type_id"
                        style="display: {{ $order->mix_full == 'automobile' ? 'flex' : 'none' }}">
                        <label for="">Maşın növü<span>*</span>
                        </label>
                        <select class="nice-select" name="first_car_type_id" id="">
                            <option value="">Seçin</option>
                            @foreach ($car_types as $car_type)
                                <option value="{{ $car_type->id }}"
                                    {{ $order->first_car_type_id == $car_type->id ? 'selected' : '' }}>
                                    {{ $car_type->name }}</option>
                            @endforeach
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                    <div class="form-item" id="first_car_count"
                        style="display: {{ $order->mix_full == 'automobile' ? 'flex' : 'none' }}">
                        <label for="">
                            Say
                        </label>
                        <input type="text" oninput="convert_numeric(this)" name="first_car_count"
                            value="{{ $order->first_car_count }}" placeholder="Text here...">
                    </div>
                    <div class="form-item" id="second_car_type_id"
                        style="display: {{ $order->mix_full == 'automobile' ? 'flex' : 'none' }}">
                        <label for="">Maşın növü<span>*</span></label>
                        <select class="nice-select" name="second_car_type_id" id="">
                            <option value="">Seçin</option>
                            @foreach ($car_types as $car_type)
                                <option value="{{ $car_type->id }}"
                                    {{ $order->second_car_type_id == $car_type->id ? 'selected' : '' }}>
                                    {{ $car_type->name }}</option>
                            @endforeach
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                    <div class="form-item" id="second_car_count"
                        style="display: {{ $order->mix_full == 'automobile' ? 'flex' : 'none' }}">
                        <label for="">Say</label>
                        <input type="text" oninput="convert_numeric(this)" name="second_car_count"
                            value="{{ $order->second_car_count }}" placeholder="Text here...">
                    </div>
                    <div class="form-radios" id="stackable">
                        <p>Stackable</p>
                        <div class="radios">
                            <div class="radio-item">
                                <input type="radio" name="stackable" id="stackable_danger" value="1"
                                    {{ $order->stackable === 1 ? 'checked' : '' }}>
                                <label for="stackable_danger">Stackable</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" name="stackable" value="0" id="stackable_safe"
                                    {{ $order->stackable === 0 ? 'checked' : '' }}>
                                <label for="stackable_safe">Nonstackable</label>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-radios" style="display : {{ $order->mix_full == 'automobile' ? 'flex' : none }};">
                        <p>
                            Qiymətləndirməyə göndərilsin?
                        </p>
                        <div class="radios">
                            <div class="radio-item">
                                <input type="radio" name="is_evaluate" id="is_evaluate_danger" value="1">
                                <label for="is_evaluate_danger">Bəli</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" name="is_evaluate" value="0" id="is_evaluate_safe">
                                <label for="is_evaluate_safe">Xeyr</label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-item" id="number_of_places"
                        style="display : {{ $order->mix_full == 'mix' || $order->mix_full == 'full' ? 'flex' : 'none' }};">
                        <label for="">Yer sayı</label>
                        <input type="text" name="number_of_places" value="{{ $order->number_of_places }}">
                    </div>
                </div>
                <div class="form-line">
                    <div class="form-item">
                        <label for="">Təxmini rezervasiya tarixi</label>
                        <input type="text" class="datetimepicker" name="about_booking_date" autocomplete="off"
                            value="{{ $order->about_booking_date?->date?->format('d.m.Y') }}"
                            placeholder="Təxmini çatdırılma vaxtı">
                        <div class="calendar-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.5 3.75H4.5C3.25736 3.75 2.25 4.75736 2.25 6V19.5C2.25 20.7426 3.25736 21.75 4.5 21.75H19.5C20.7426 21.75 21.75 20.7426 21.75 19.5V6C21.75 4.75736 20.7426 3.75 19.5 3.75Z"
                                    stroke="#959595" stroke-linejoin="round" />
                                <path
                                    d="M13.875 12C14.4963 12 15 11.4963 15 10.875C15 10.2537 14.4963 9.75 13.875 9.75C13.2537 9.75 12.75 10.2537 12.75 10.875C12.75 11.4963 13.2537 12 13.875 12Z"
                                    fill="#959595" />
                                <path
                                    d="M17.625 12C18.2463 12 18.75 11.4963 18.75 10.875C18.75 10.2537 18.2463 9.75 17.625 9.75C17.0037 9.75 16.5 10.2537 16.5 10.875C16.5 11.4963 17.0037 12 17.625 12Z"
                                    fill="#959595" />
                                <path
                                    d="M13.875 15.75C14.4963 15.75 15 15.2463 15 14.625C15 14.0037 14.4963 13.5 13.875 13.5C13.2537 13.5 12.75 14.0037 12.75 14.625C12.75 15.2463 13.2537 15.75 13.875 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M17.625 15.75C18.2463 15.75 18.75 15.2463 18.75 14.625C18.75 14.0037 18.2463 13.5 17.625 13.5C17.0037 13.5 16.5 14.0037 16.5 14.625C16.5 15.2463 17.0037 15.75 17.625 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M6.375 15.75C6.99632 15.75 7.5 15.2463 7.5 14.625C7.5 14.0037 6.99632 13.5 6.375 13.5C5.75368 13.5 5.25 14.0037 5.25 14.625C5.25 15.2463 5.75368 15.75 6.375 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M10.125 15.75C10.7463 15.75 11.25 15.2463 11.25 14.625C11.25 14.0037 10.7463 13.5 10.125 13.5C9.50368 13.5 9 14.0037 9 14.625C9 15.2463 9.50368 15.75 10.125 15.75Z"
                                    fill="#959595" />
                                <path
                                    d="M6.375 19.5C6.99632 19.5 7.5 18.9963 7.5 18.375C7.5 17.7537 6.99632 17.25 6.375 17.25C5.75368 17.25 5.25 17.7537 5.25 18.375C5.25 18.9963 5.75368 19.5 6.375 19.5Z"
                                    fill="#959595" />
                                <path
                                    d="M10.125 19.5C10.7463 19.5 11.25 18.9963 11.25 18.375C11.25 17.7537 10.7463 17.25 10.125 17.25C9.50368 17.25 9 17.7537 9 18.375C9 18.9963 9.50368 19.5 10.125 19.5Z"
                                    fill="#959595" />
                                <path
                                    d="M13.875 19.5C14.4963 19.5 15 18.9963 15 18.375C15 17.7537 14.4963 17.25 13.875 17.25C13.2537 17.25 12.75 17.7537 12.75 18.375C12.75 18.9963 13.2537 19.5 13.875 19.5Z"
                                    fill="#959595" />
                                <path d="M6 2.25V3.75M18 2.25V3.75" stroke="#959595" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M21.75 7.5H2.25" stroke="#959595" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>

                    <div class="form-item" id="container_type_id"
                        style="display:{{ $order->mix_full == 'full' ? 'flex' : 'none' }};">
                        <label for="">Konteyner növləri</label>
                        <select class="nice-select" name="container_type_id" id="">
                            <option value="">Seçin</option>
                            @foreach ($container_types as $container_type)
                                <option value="{{ $container_type->id }}"
                                    {{ $order->container_type_id == $container_type->id ? 'selected' : '' }}>
                                    {{ $container_type->name . ' (' . $container_type->max_size . ')' }}</option>
                            @endforeach
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                    <div class="form-item">
                        <label for="">İncoterms</label>
                        <select class="nice-select" name="incoterm_id" id="">
                            <option value="">Seçin</option>
                            @foreach ($incoterms as $incoterm)
                                <option value="{{ $incoterm->id }}"
                                    {{ $order->incoterm_id == $incoterm->id ? 'selected' : '' }}>{{ $incoterm->name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="resetSelectBtn" type="button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#FF0000" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="form-line" id="sizes"
                    style="display : {{ $order->mix_full == 'mix' || $order->mix_full == 'full' ? 'block' : 'none' }}; gap:10px;">
                    @foreach ($order->sizes as $key => $order_size)
                        @include('back.pages.order.section.sizes', [
                            'order_size' => $order_size,
                            'counter' => $key + 1,
                        ])
                    @endforeach
                    <button class="add-size" type="button" onclick="add_size()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Ölçü əlavə et
                    </button>
                </div>
            </div>
            <div class="factoryHead-title">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                        fill="#534D59" />
                </svg>
                <p>Tədarükçü məlumatları</p>
            </div>
            <div class="factory-area">
                <button class="addFactoryBtn" onclick="add_factory({{ $order->id }})" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tədarükçü əlavə et
                </button>
                <div class="factory-area-forms">
                    @foreach ($order_item->factories as $key => $factory)
                        @php
                            $order_factory = $factory->orderFactory;
                        @endphp
                        @include('back.pages.order.section.add-factory', [
                            'order_factory' => $order_factory,
                            'order' => $order,
                            'product_types' => $product_types,
                            'counter' => $key + 1,
                        ])
                    @endforeach

                </div>
            </div>
            @include('back.pages.order.section.payment', [
                'payment_types' => $payment_types,
                'order' => $order,
            ])
            <div class="formButtons">
                <a href="{{ route('admin.order.index', ['status' => \App\Enums\OrderStatus::EXECUTE]) }}"
                    class="back_link">Geri</a>
                <button class="submit_btn" type="submit">Təsdiq</button>
            </div>
        </form>

        @include('back.pages.order.section.add-referrer')
    </div>
@endsection

@push('css')
    <style>
        .form-line .add-size {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-left: auto;
            width: max-content;
            background: #0E9CF3;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            padding: 5px 10px;
        }

        .form-line .remove-size {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 10px 16px;
            border: 1px solid rgba(255, 0, 0, 0.12);
            border-radius: 8px;
            font-weight: 400;
            font-size: 14px;
            line-height: 22.4px;
            color: #ff0000;
            background: transparent;
        }

        .orderExecution-container .orderExecution-form .factory-area .factory-area-forms .factory-form .factory-inputs .form-line-item .form-products .form-item .nice-select {
            max-width: 100%;
        }

        .add-referrer-select {
            margin-top: 6px;
            max-width: 424px;
            height: 54px;
            width: 100%;
            position: relative;
        }

        .add-referrer-select .add-referrer-btn {
            background: #fff;
            width: 20px;
            height: 20px;
            min-width: 20px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 16px;
        }
    </style>
@endpush


@push('js')
    <script>
        document.querySelector('.add-referrer-btn').addEventListener('click', function() {
            document.querySelector('.addCustomer_modal_container').classList.add('activeModal');
        });

        function add_referrer() {
            event.preventDefault();
            let firstname = document.querySelector('.addCustomer_modal_container [name="firstname"]').value;
            let lastname = document.querySelector('.addCustomer_modal_container [name="lastname"]').value;
            let email = document.querySelector('.addCustomer_modal_container [name="email"]').value;
            let referrer = document.querySelector('[name="referrer"]');
            let url = `/order/add-referrer`;

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': "{{ csrf_token() }}",
                        'firstname': firstname,
                        'lastname': lastname,
                        'email': email,
                    }),
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        let option = `<option value='${data.data.name}' selected >${data.data.name}</option>`;
                        referrer.innerHTML += option;
                        $(referrer).niceSelect('update');
                        document.querySelector('.addCustomer_modal_container').classList.remove('activeModal');
                        toastr.success(data.message);
                    } else {
                        for (let error in data.errors) {
                            let error_message = data.errors[error][0];
                            toastr.error(error_message);
                        }
                    }
                });
        }
    </script>

    <script>
        function get_transportation_services(item) {
            let id = item.value;
            let url = `/transportation-type/${id}/get-transportation-services`;
            let transportation_service = document.querySelector('[name="transportation_service_id"]');
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        transportation_service.innerHTML = `<option value=''>Seçin</option>`;
                        data.data.forEach(item => {
                            transportation_service.innerHTML +=
                                `<option value='${item.id}'>${item.name}</option>`;
                        });
                        $(transportation_service).niceSelect('update');
                    }
                });
        }

        function get_transportations(item) {
            let id = item.value;
            let url = `/transportation-service/${id}/get-transportations`;
            let transportation = document.querySelector('[name="transportation_id"]');
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        transportation.innerHTML = `<option value=''>Seçin</option>`;
                        data.data.forEach(item => {
                            transportation.innerHTML += `<option value='${item.id}'>${item.name}</option>`;
                        });
                        $(transportation).niceSelect('update');
                    }
                });
        }
    </script>

    <script>
        function add_factory(order_id) {
            let counter = Array.from(document.querySelectorAll('.factory-form')).length;
            let factory_area_forms = document.querySelector('.factory-area-forms');
            counter++;
            let url = `/order/add-factory?counter=${counter}&order_id=${order_id}`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        factory_area_forms.insertAdjacentHTML('beforeend', data.view);
                        let product_type_ids = document.querySelectorAll('[name="product_type_id[]"]');
                        product_type_ids.forEach(product_id => {
                            $(product_id).niceSelect();
                        });
                    }
                });
        }
    </script>

    <script>
        function add_product(item, index) {
            let factory_container = item.parentElement.children[0];
            let html = `<div class='productInput'>
                            <div class="form-item">
                                <label for="">{{ trns('product') }}</label>
                                <input type="text" oninput="convert_alphanumeric(this)" name="products[${index}][]" placeholder="text here">
                            </div>
                            <button onclick="delete_product(this)" class="removePro">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                        fill="#FF0000" />
                                </svg>
                            </button>
                        </div>
                        `;
            factory_container.insertAdjacentHTML('beforeend', html);
        }
    </script>

    <script>
        function calculate_remainder() {
            convert_numeric(document.querySelector('[name="percent"]'));
            let price_value = document.querySelector('[name="price"]').value ?? 0;
            let percent_value = document.querySelector('[name="percent"]').value ?? 0;
            let remainder = document.querySelector('[name="remainder"]');
            let remainder_value = price_value - (price_value * percent_value / 100);
            if (!percent_value || percent_value == 0) document.querySelector('[name="first_date"]').disabled = true;
            else document.querySelector('[name="first_date"]').disabled = false;
            remainder.value = remainder_value.toFixed(2);
        }
    </script>

    <script>
        function delete_product(item) {
            item.parentElement.remove();
        }

        function delete_factory(item) {
            item.parentElement.parentElement.remove();
        }
    </script>

    <script>
        function get_customers(item) {
            let customer_type = item.value;
            let customer_id = document.querySelector('[name="customer_id"]');
            let url = `/order/get-customers?type=${customer_type}`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data.status == 'success') {
                        customer_id.innerHTML = `<option value=''>Seçin</option>`;
                        data.data.forEach(item => {
                            if (customer_type == 'legal')
                                customer_id.innerHTML +=
                                `<option value='${item.id}' >${item.company_name}</option>`;
                            else customer_id.innerHTML += `<option value='${item.id}' >${item.name}</option>`;
                        });
                        $(customer_id).niceSelect('update');
                    } else {
                        console.log(data.message);
                    }
                });
        }
    </script>

    <script>
        function get_fin_voen(item) {
            let id = item.value;
            let url = `/customer/${id}`;
            let voen_fin = document.querySelector('[name="voen_fin"]');
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        voen_fin.value = data.voen_fin;
                    } else {
                        console.log(data.message);
                    }
                });
        }
    </script>

    <script>
        let security_modes = document.querySelectorAll('[name="security_mode"]');
        security_modes.forEach(security_mode => {
            security_mode.addEventListener('change', function() {
                if (security_mode.value == 1) {
                    document.querySelector('#msds').style.display = 'block';
                } else {
                    document.querySelector('#msds').style.display = 'none';
                }
            });
        });
    </script>

    <script>
        function change_mix_full(item) {
            let value = item.value;
            if (value == 'mix' || value == 'full') {
                document.querySelector('#sizes').style.display = 'flex';
                document.querySelector('#number_of_places').style.display = 'flex';
                document.querySelector('#stackable').style.display = 'flex';
                document.querySelector('#weight').style.display = 'flex';
                document.querySelector('#cube').style.display = 'flex';
                document.querySelector('#first_car_type_id').style.display = 'none';
                document.querySelector('#second_car_type_id').style.display = 'none';
                document.querySelector('#first_car_count').style.display = 'none';
                document.querySelector('#second_car_count').style.display = 'none';
                if (value == 'full') {
                    document.querySelector('#container_type_id').style.display = 'flex';
                    document.querySelector('#container_count').style.display = 'flex';
                } else {
                    document.querySelector('#container_type_id').style.display = 'none';
                    document.querySelector('#container_count').style.display = 'none';
                }

            } else {
                document.querySelector('#sizes').style.display = 'none';
                document.querySelector('#number_of_places').style.display = 'none';
                document.querySelector('#stackable').style.display = 'none';
                document.querySelector('#weight').style.display = 'none';
                document.querySelector('#cube').style.display = 'none';
                document.querySelector('#first_car_type_id').style.display = 'flex';
                document.querySelector('#second_car_type_id').style.display = 'flex';
                document.querySelector('#first_car_count').style.display = 'flex';
                document.querySelector('#second_car_count').style.display = 'flex';
            }
        }
    </script>

    <script>
        function required_vin_code(item) {
            let value = item.value;
            let parentElement = item.parentElement.parentElement;
            let vin_code = parentElement.querySelector('[name="vin_code[]"]');
            if (value == 1) {
                vin_code.required = true;
                vin_code.parentElement.style.display = 'block';
            } else {
                vin_code.required = false;
                vin_code.parentElement.style.display = 'none';
            }
        }
    </script>

    <script>
        function convert_numeric(item) {
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

        function convert_letter(item) {
            item.value = item.value.replace(/[^a-zA-ZğüşıöçĞÜŞİÖÇn ]/g, "");
        }

        function convert_alphanumeric(item) {
            item.value = item.value.replace(/[^a-zA-Z0-9 ]/g, "");
        }
    </script>

    <script>
        function add_size() {
            let sizes = document.querySelector('#sizes');
            let url = `/order/add-size`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') sizes.insertAdjacentHTML('afterbegin', data.view);
                });
        }

        function remove_size(item) {
            item.parentElement.remove();
            calculate_total_cbm();
        }
    </script>

    <script>
        function calculate_total_cbm() {
            let widths = document.querySelectorAll('[name="width[]"]');
            let lengths = document.querySelectorAll('[name="length[]"]');
            let heights = document.querySelectorAll('[name="height[]"]');
            let total_cbm = 0;
            widths.forEach((width, i) => {
                convert_numeric(width);
                convert_numeric(lengths[i]);
                convert_numeric(heights[i]);
                if (width.value != null && lengths[i].value != null && heights[i].value != null) {
                    total_cbm += (width.value * lengths[i].value * heights[i].value);
                }
            });
            document.querySelector('[name="cbm"]').value = total_cbm.toFixed(2);
        }
    </script>

    <script>
        function add_vin_code(elem) {
            convert_numeric(elem);
            let car_count = elem.value;
            let parentElement = elem.parentElement.parentElement.parentElement;
            let vinCodeArea = parentElement.querySelector('.vin-code-area');
            let counter = 1;

            let url = `/order/add-vin-code?count=${car_count}&counter=${counter}`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') vinCodeArea.innerHTML = data.view;
                });
        }
    </script>
@endpush
