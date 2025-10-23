@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <form method="POST" action="{{ route('admin.order.store') }}" enctype="multipart/form-data" class="create-draftOrder">
            @csrf
            <div class="draftOrder-form">
                <div class="form-item mix full automobile">
                    <label for="">
                        <div class="order">
                            1.
                        </div>
                        {{ trns('customer_type') }}<span>*</span>
                    </label>
                    <div class="error-message"></div>
                    <select class="nice-select important required" data-message="{{ trns('customer') }}növünü seçin"
                        name="customer_type" onchange="get_customers(this)" id="">
                        <option value="">{{ trns('choose') }}</option>
                        <option value="physical" {{ old('customer_type') == 'physical' ? 'selected' : '' }}>
                            {{ trns('physical') }}</option>
                        <option value="legal" {{ old('customer_type') == 'legal' ? 'selected' : '' }}>{{ trns('legal') }}
                        </option>
                    </select>
                </div>
                <div class="addCustomerSelect">
                    <div class="form-item mix full automobile">
                        <label for="">
                            <div class="order">
                                2.
                            </div>
                            {{ trns('customer_name') }}<span>*</span>
                        </label>
                        <div class="error-message"></div>
                        <select name="customer_id" data-message="Müştərini seçin" class="select2 required important"
                            onchange="get_customer(this)" id="">
                            <option value="">Select</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="addCustomerBtn" type="button">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 4.16675V15.8334" stroke="#02A3ED" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M4.1665 10H15.8332" stroke="#02A3ED" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="form-item" id="customer_phone">
                    <label for="" class="form-label">{{ trns('phone') }}<span>*</span></label>
                    <input type="text" placeholder="Text here...">
                </div>
                <div class="form-item" id="customer_fin">
                    <label for="" class="form-label">{{ trns('fin') }}<span>*</span></label>
                    <input type="text" placeholder="Text here...">
                </div>
                <div class="form-item" id="customer_voen">
                    <label for="" class="form-label">{{ trns('voen') }}<span>*</span></label>
                    <input type="text" placeholder="Text here...">
                </div>
                <div class="form-item mix full automobile">
                    <label for="">
                        <div class="order">
                            3.
                        </div>
                        {{ trns('product_name') }}
                    </label>
                    <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="Text here...">
                </div>
                <div class="form-item mix full automobile">
                    <label for="">
                        <div class="order">
                            4.
                        </div>
                        {{ trns('mix_full') }}<span>*</span>
                    </label>
                    <div class="error-message"></div>
                    <select class="nice-select important required" data-message="Sifarişin mix/full olacağını seçin."
                        name="mix_full" onchange="get_inputs(this)" id="">
                        <option value="">{{ trns('choose') }}</option>
                        @foreach ($mix_fulles as $mix_full)
                            <option value="{{ $mix_full->short_name }}" {{ old('mix_full') == $mix_full->short_name }}>
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
                <div class="form-item selectable full">
                    <label for="">{{ trns('container_type') }}<span>*</span></label>
                    <div class="error-message"></div>
                    <select class="nice-select important" data-message="Konteyner növünü daxil edin"
                        name="container_type_id" id="">
                        <option value="">{{ trns('choose') }}</option>
                        @foreach ($container_types as $container_type)
                            <option value="{{ $container_type->id }}"
                                {{ old('container_type_id') == $container_type->id }}>
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
                <div class="form-item selectable full">
                    <label for="">{{ trns('container_count') }}<span>*</span></label>
                    <div class="error-message"></div>
                    <select class="select2 important" data-message="Konteyner sayını daxil edin" name="container_count"
                        id="">
                        @for ($i = 1; $i <= 50; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
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
                <div class="form-item mix full automobile">
                    <label for="">
                        <div class="order">
                            5.
                        </div>
                        {{ trns('loading_point') }}<span>*</span>
                    </label>
                    <div class="error-message"></div>
                    <input type="text" class="required important" data-message="{{ trns('enter_loading_point') }}"
                        name="loading_point" value="{{ old('loading_point') }}" placeholder="Text here...">

                </div>
                <div class="form-item automobile selectable d-none">
                    <label for="">
                        <div class="order">
                            8.
                        </div>
                        {{ trns('car_type') }}<span>*</span>
                    </label>
                    <select class="nice-select important" data-message="{{ trns('enter_car_type') }}"
                        name="first_car_type_id" id="">
                        <option value="">{{ trns('choose') }}</option>
                        @foreach ($car_types as $car_type)
                            <option value="{{ $car_type->id }}"
                                {{ old('first_car_type_id') == $car_type->id ? 'selected' : '' }}>
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
                <div class="form-item automobile selectable d-none">
                    <label for="">
                        <div class="order">
                            9.
                        </div>
                        {{ trns('car_count') }}
                    </label>
                    <input type="text" class="important" data-message="{{ trns('enter_car_count') }}"
                        name="first_car_count" value="{{ old('first_car_count') }}" placeholder="Text here...">
                </div>
                <div class="form-item automobile selectable d-none">
                    <label for="">
                        <div class="order">
                            10.
                        </div> {{ trns('car_type') }}
                    </label>
                    <select class="nice-select" name="second_car_type_id" id="">
                        <option value="">{{ trns('choose') }}</option>
                        @foreach ($car_types as $car_type)
                            <option value="{{ $car_type->id }}"
                                {{ old('second_car_type_id') == $car_type->id ? 'selected' : '' }}>
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
                <div class="form-item automobile selectable d-none">
                    <label for="">
                        <div class="order">11.</div>
                        {{ trns('car_count') }}
                    </label>
                    <input type="text" name="second_car_count" value="{{ old('second_car_count') }}"
                        placeholder="Text here...">
                </div>
                <div class="form-item mix full selectable d-none">
                    <label for="">
                        <div class="order">6.</div> {{ trns('weight') }}<span>*</span>
                    </label>
                    <div class="error-message"></div>
                    <input type="text" min="0" data-message="{{ trns('enter') }}" name="weight"
                        value="{{ old('weight') }}" class="important" placeholder="Text here...">
                </div>
                <div class="form-item mix full selectable d-none">
                    <label for="">
                        <div class="order">7.</div> {{ trns('cube') }}<span>*</span>
                    </label>
                    <div class="error-message"></div>
                    <input type="text" min="0" data-message="{{ trns('enter') }}" name="cbm"
                        value="{{ old('cbm') }}" class="important" placeholder="Text here...">
                </div>
                <div class="form-item mix full automobile selectable d-none">
                    <label for="">
                        <div class="order">
                            8.</div> {{ trns('incoterm') }}<span>*</span>
                    </label>
                    <div class="error-message"></div>
                    <select class="nice-select important required" data-message="{{ trns('choose') }}"
                        name="incoterm_id" onchange="get_incoterm(this)" id="">
                        <option value="">{{ trns('choose') }}</option>
                        @foreach ($incoterms as $incoterm)
                            <option value="{{ $incoterm->id }}"
                                {{ old('incoterm_id') == $incoterm->id ? 'selected' : '' }}>{{ $incoterm->name }}</option>
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
                <div class="form-item mix full automobile selectable d-none">
                    <label for="">9. {{ trns('customs_clearance') }}<span>*</span></label>
                    <div class="error-message"></div>
                    <select name="customs_clearance_id" data-message="{{ trns('choose') }}"
                        class="nice-select important required" id="">
                        <option value="">{{ trns('choose') }}</option>
                        @foreach ($customs_clearances as $customs_clearance)
                            <option value="{{ $customs_clearance->id }}"
                                {{ old('customs_clearance_id') == $customs_clearance->id ? 'selected' : '' }}>
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
                <div class="form-radios mix full selectable d-none">
                    <p>
                        <span class="order">
                            10.
                        </span>
                        {{ trns('stackable') }}
                    </p>
                    <div class="radios">
                        <div class="radio-item">
                            <input type="radio" name="stackable" id="stackable_danger" value="1"
                                {{ old('stackable') == 1 ? 'checked' : '' }}>
                            <label for="stackable_danger">{{ trns('stackable') }}</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="stackable" value="0" id="stackable_safe"
                                {{ old('stackable') == 0 ? 'checked' : '' }}>
                            <label for="stackable_safe">{{ trns('non_stackable') }}</label>
                        </div>
                    </div>
                </div>
                <div class="form-radios mix automobile selectable d-none">
                    <p>
                        <span class="order">
                            12.
                        </span>
                        {{ trns('send_to_evaluation') }}?
                    </p>
                    <div class="radios">
                        <div class="radio-item">
                            <input type="radio" name="is_evaluate" id="is_evaluate_danger" value="1">
                            <label for="is_evaluate_danger">{{ trns('yes') }}</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="is_evaluate" value="0" id="is_evaluate_safe">
                            <label for="is_evaluate_safe">{{ trns('no') }}</label>
                        </div>
                    </div>
                </div>
                <div class="form-item mix full selectable d-none">
                    <label for="">
                        <div class="order">
                            11.
                        </div>
                        {{ trns('place_count') }}
                    </label>
                    <input type="text" name="number_of_places" value="{{ old('number_of_places') }}"
                        placeholder="Text here...">
                </div>
                <div class="form-item mix full selectable d-none" style="gap:10px;">
                    {{-- <label for="">
                        <div class="order">
                            12.
                        </div>
                        Ölçülər<span>*</span>
                    </label> --}}
                    <div class="form-item">
                        <div class="error-message"></div>
                        <label for="">{{ trns('width') }} (M)</label>
                        <input min="0" data-message="{{ trns('required') }}" name="width"
                            oninput="calculate_cbm()" value="{{ old('width') }}" class="important"
                            placeholder="{{ trns('width') }}...">
                    </div>
                    <div class="form-item">
                        <div class="error-message"></div>
                        <label for="">{{ trns('length') }} (M)</label>
                        <input min="0" data-message="{{ trns('required') }}" name="length"
                            oninput="calculate_cbm()" value="{{ old('length') }}" class="important"
                            placeholder="{{ trns('length') }}...">
                    </div>
                    <div class="form-item">
                        <div class="error-message"></div>
                        <label for="">{{ trns('height') }} (M)</label>
                        <input min="0" data-message="{{ trns('required') }}" name="height"
                            oninput="calculate_cbm()" value="{{ old('height') }}" class="important"
                            placeholder="{{ trns('height') }}...">
                    </div>
                </div>
                <div class="form-radios mix full selectable d-none">
                    <p>
                        <span class="order">
                            13.
                        </span> {{ trns('security_mode') }}
                    </p>
                    <div class="radios">
                        <div class="radio-item">
                            <input type="radio" name="security_mode" id="security_mode_danger" value="1"
                                {{ old('security_mode') == 1 ? 'checked' : '' }}>
                            <label for="security_mode_danger">{{ trns('dangerous') }}</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="security_mode" value="0" id="security_mode_safe"
                                {{ old('security_mode') == 0 ? 'checked' : '' }}>
                            <label for="security_mode_safe">{{ trns('safe') }}</label>
                        </div>
                    </div>
                </div>
                <div class="form-radios mix full automobile selectable d-none">
                    <p>
                        <span class="order">
                            14.
                        </span> {{ trns('has_export_right') }}?
                    </p>
                    <div class="radios">
                        <div class="radio-item">
                            <input type="radio" name="exportable" id="exportable_danger" value="1"
                                {{ old('exportable') === 1 ? 'checked' : '' }}>
                            <label for="exportable_danger">{{ trns('yes') }}</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="exportable" value="0" id="exportable_safe"
                                {{ old('exportable') === 0 ? 'checked' : '' }}>
                            <label for="exportable_safe">{{ trns('no') }}</label>
                        </div>
                    </div>
                </div>
                <div class="form-item" id="msds">
                    <label for="">
                        <div class="order">15.</div>
                        {{ trns('msds') }}
                    </label>
                    <div class="error-message"></div>
                    <input type="text" class="important" name="msds" data-message="{{ trns('enter') }}"
                        value="{{ old('msds') }}" placeholder="Text here...">
                </div>
                <div class="form-item mix full automobile">
                    <div class="file-area">
                        <p>
                            {{ trns('choose_file') }}
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                    fill="white" />
                            </svg>
                        </p>
                        <input type="file" name="file" onchange="add_file(this)">
                        <span class="fileName"></span>
                    </div>
                </div>
                <div class="form-item selectable d-none automobile mix" id="price">
                    <label for="">
                        <div class="order">
                            16.
                        </div>
                        {{ trns('price') }}
                    </label>
                    <input type="text" name="price" value="{{ old('price') }}" placeholder="Text here...">
                    <select name="price_currency" class="nice-select" id="">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->symbol }}"
                                {{ old('price_currency') == $currency->symbol ? 'selected' : '' }}>
                                {{ $currency->code }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="form-note">
                <label for="">
                    {{ trns('note') }}
                </label>
                <textarea name="note" id="" placeholder="Text here...">{{ old('note') }}</textarea>
            </div>
            <button class="submitDraftOrder" type="submit">{{ trns('create_draft_order') }}</button>
        </form>
    </div>

    @include('back.pages.order.section.add-customer')
    @include('back.pages.order.section.warning-modal')
@endsection

@push('css')
    <style>
        #cbm,
        #customer_fin,
        #customer_voen,
        #customer_phone,
        #msds,
        .create-draftOrder-container .create-draftOrder .draftOrder-form .form-radios.selectable,
        .selectable {
            display: none;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .order {
            display: inline-block;
        }

        .form-item .file-area {
            position: relative;
            width: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 5px;
            border-radius: 8px;
            background: #0BB7AF;
        }

        .form-item .file-area p {
            display: flex;
            align-items: center;
            gap: 4px;
            color: #fff;
            font-size: 14px;
            line-height: 16px;
            font-weight: 400;
        }

        .form-item .file-area input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .form-item .file-area .fileName {
            display: none;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            width: 100%;
            color: #fff;
            font-size: 14px;
            line-height: 24px;
            font-weight: 400;
            text-align: center;
        }

        .error-message {
            color: white;
            background: red;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            position: absolute;
            top: 100%;
            left: 0;
            white-space: nowrap;
            margin-top: 5px;
            display: none;
            z-index: 10;
        }

        .form-item .error-border {
            border: 1px solid red !important;
        }
    </style>
@endpush

@push('js')
    <script>
        function get_customers(item) {
            let customer_type = item.value;
            let customer_id = document.querySelector('[name="customer_id"]');
            let fin = document.getElementById('fin');
            let voen = document.getElementById('voen');
            let customer_fin = document.querySelector('#customer_fin');
            let customer_voen = document.querySelector('#customer_voen');
            let customer_phone = document.querySelector('#customer_phone');
            let modal_customer_type = document.querySelector('.addCustomer_modal_container [name="type"]');
            let customer_select_label = document.querySelector('.addCustomerSelect label');
            let modal_select_label = document.querySelector('.addCustomer_modal [name="customer_name"]')
                .previousElementSibling;
            let url = `/order/get-customers?type=${customer_type}`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        console.log(data);
                        customer_id.innerHTML = `<option value=''>{{ trns('choose') }}</option>`;
                        data.data.forEach(item => {
                            if (customer_type == 'legal') customer_id.innerHTML +=
                                `<option value='${item.id}' >${item.company_name}</option>`;
                            else customer_id.innerHTML += `<option value='${item.id}' >${item.name}</option>`;
                        });
                        $(customer_id).niceSelect('update');
                        modal_customer_type.value = customer_type;
                        $(modal_customer_type).niceSelect('update');
                        if (customer_type == 'physical') {
                            fin.style.display = 'block';
                            voen.style.display = 'none';
                            customer_select_label.innerHTML = "{{ trns('customer_name') }} <span>*</span>";
                            modal_select_label.innerHTML = "{{ trns('customer_name') }} <span>*</span>";
                            customer_fin.style.display = 'block';
                            customer_voen.style.display = 'none';
                            customer_phone.style.display = 'block';
                        } else if (customer_type == 'legal') {
                            fin.style.display = 'none';
                            voen.style.display = 'block';
                            customer_select_label.innerHTML = "{{ trns('company_name') }} <span>*</span>";
                            modal_select_label.innerHTML = "{{ trns('company_name') }} <span>*</span>";
                            customer_fin.style.display = 'none';
                            customer_voen.style.display = 'block';
                            customer_phone.style.display = 'block';
                        } else {
                            fin.style.display = 'none';
                            voen.style.display = 'none';
                            customer_select_label.innerHTML = "{{ trns('customer') }}<span>*</span>";
                            modal_select_label.innerHTML = "{{ trns('customer') }}<span>*</span>";
                            customer_fin.style.display = 'none';
                            customer_voen.style.display = 'none';
                            customer_phone.style.display = 'none';
                        }

                    } else {
                        console.log(data.message);
                    }
                });
        }
    </script>

    <script>
        function get_customer_type(item) {
            let customer_type = item.value;
            let customer_select_label = document.querySelector('.addCustomerSelect label');
            let modal_select_label = document.querySelector('.addCustomer_modal [name="customer_name"]')
                .previousElementSibling;
            if (customer_type == 'physical') {
                document.querySelector('#fin').style.display = 'block';
                document.querySelector('#voen').style.display = 'none';
                customer_select_label.innerHTML = "{{ trns('customer_name') }} <span>*</span>";
                modal_select_label.innerHTML = "{{ trns('customer_name') }} <span>*</span>";

            } else if (customer_type == 'legal') {
                document.querySelector('#fin').style.display = 'none';
                document.querySelector('#voen').style.display = 'block';
                customer_select_label.innerHTML = "{{ trns('company_name') }} <span>*</span>";
                modal_select_label.innerHTML = "{{ trns('company_name') }} <span>*</span>";
            } else {
                document.querySelector('#fin').style.display = 'none';
                document.querySelector('#voen').style.display = 'none';
                customer_select_label.innerHTML = "{{ trns('customer') }}<span>*</span>";
                modal_select_label.innerHTML = "{{ trns('customer') }}<span>*</span>";
            }
        }
    </script>

    <script>
        function add_customer() {
            event.preventDefault();
            let customer_type = document.querySelector('[name="customer_type"]');
            let customer_name = document.querySelector('[name="customer_name"]');
            let customer_phone = document.querySelector('.addCustomer_modal [name="customer_phone"]');
            let fin = document.querySelector('.addCustomer_modal [name="fin"]');
            let voen = document.querySelector('.addCustomer_modal [name="voen"]');
            let customer_id = document.querySelector('[name="customer_id"]');
            let url = '/order/add-customer';
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': "{{ csrf_token() }}",
                        'type': customer_type.value,
                        'name': customer_name.value,
                        'phone': customer_phone.value,
                        'fin': fin?.value ?? '',
                        'voen': voen?.value ?? '',
                    }),
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        let option = `<option value='${data.data.id}' selected >${data.data.name}</option>`;
                        customer_id.innerHTML += option;
                        $(customer_id).niceSelect('update');
                        document.querySelector('.addCustomer_modal_container').style.display = 'none';
                        document.querySelector('[name="customer_phone"]').value = data.data.phone;
                        document.querySelector('[name="fin"]').value = data.data.fin;
                        document.querySelector('[name="voen"]').value = data.data.voen;
                        document.querySelector('#customer_fin input').value = data.data.fin;
                        document.querySelector('#customer_voen input').value = data.data.voen;
                        document.querySelector('#customer_phone input').value = data.data.phone;
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
        function get_cbm(item) {
            if (item.value == 'mix') {
                document.getElementById('cbm').style.display = 'block';
            } else {
                document.getElementById('cbm').style.display = 'none';
            }
        }
    </script>

    <script>
        function get_customer(item) {
            let id = item.value;
            let url = `/customer/${id}`;
            let fin = document.querySelector('#customer_fin');
            let voen = document.querySelector('#customer_voen');
            let customer_phone = document.querySelector('#customer_phone');
            let customer_type = document.querySelector('[name="customer_type"]');
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        if (customer_type.value == 'physical') {
                            fin.querySelector('input').value = data.voen_fin;
                        } else if (customer_type.value == 'legal') {
                            voen.querySelector('input').value = data.voen_fin;
                        }
                        customer_phone.querySelector('input').value = data.phone;
                        customer_phone.style.display = 'block';
                    } else {
                        customer_phone.style.display = 'none';
                        fin.style.display = 'none';
                        voen.style.display = 'none';
                    }
                });
        }
    </script>

    <script>
        // enumerate();

        function enumerate() {
            let forms = document.querySelectorAll('.form-item,.form-radios');
            let count = 0;
            forms.forEach(form => {
                if (form.classList.contains('d-none')) {
                    count++;
                    form.children[0].children[0].innerText = count;
                }
            })
        }

        function get_inputs(item) {
            event.preventDefault();
            let value = item.value;
            let form_items = document.querySelectorAll('.selectable');
            form_items.forEach(form_item => {
                let inputs = form_item.querySelectorAll('.important');
                if (form_item.classList.contains(value)) {
                    form_item.style.display = 'flex';
                    inputs.forEach(input => {
                        input.classList.add('required');
                    })
                } else {
                    form_item.style.display = 'none';
                    inputs.forEach(input => {
                        input.classList.remove('required');
                    });
                }
            });
        }

        // let customer_type = document.querySelector('[name="customer_type"]');
        // get_inputs(customer_type);
    </script>

    <script>
        let security_modes = document.querySelectorAll('[name="security_mode"]');
        let is_evaluates = document.querySelectorAll('[name="is_evaluate"]');
        security_modes.forEach(security_mode => {
            security_mode.addEventListener('change', function() {
                if (security_mode.value == 1) {
                    document.querySelector('#msds').style.display = 'block';
                    document.querySelector('[name="msds"]').required = true;
                } else {
                    document.querySelector('#msds').style.display = 'none';
                    document.querySelector('[name="msds"]').required = false;
                }
            });
        });

        is_evaluates.forEach(is_evaluate => {
            is_evaluate.addEventListener('change', function() {
                if (is_evaluate.value == 1) document.querySelector('#price').style.display = 'none';
                else document.querySelector('#price').style.display = 'flex';
            })
        });
    </script>

    <script>
        function add_file() {
            let file = event.target.files[0];
            document.querySelector('.file-area p').innerHTML = '';
            document.querySelector('.fileName').innerText = file.name;
            document.querySelector('.fileName').style.display = 'block';
        }
    </script>

    <script>
        function get_incoterm(item) {
            let value = item.value;
            if (value == 2 || value == 3) document.querySelector('#price').style.display = 'block';
            else document.querySelector('#price').style.display = 'none';
        }
    </script>

    <script>
        let letter_inputs = document.querySelectorAll('[name="product_name"],[name="loading_point"]');
        let numeric_inputs = document.querySelectorAll(
            '#customer_phone input,[name="weight"],[name="cube"],[name="number_of_places"],[name="first_car_count"],[name="second_car_count"],[name="width"],[name="height"],[name="length"],[name="cbm"],[name="voen"],[name="customer_phone"]'
        );
        let alphanumeric_inputs = document.querySelectorAll('#customer_fin input,#customer_voen input,[name="fin"]');


        numeric_inputs.forEach(input => {
            input.addEventListener("input", function(e) {
                // Yalnız rəqəmlərə və bir ədəd nöqtəyə icazə ver
                let cleaned = this.value.replace(/[^0-9.]/g, '');

                // Bir dənədən çox nöqtə varsa, yalnız birincisini saxla
                const parts = cleaned.split('.');
                if (parts.length > 2) {
                    cleaned = parts[0] + '.' + parts.slice(1).join('');
                }

                // Əgər ədəd onluq DEYİLSƏ və sıfırla başlayırsa, sıfırı sil
                if (!cleaned.includes('.') && cleaned.startsWith('0') && cleaned.length > 1) {
                    cleaned = cleaned.replace(/^0+/, '');
                }

                this.value = cleaned;
            });
        });


        letter_inputs.forEach(input => {
            input.addEventListener("input", function(event) {
                this.value = this.value.replace(/[^a-zA-ZğüşıöçĞÜŞİÖÇn ]/g, "");
            });
        });

        alphanumeric_inputs.forEach(input => {
            input.addEventListener("input", function(e) {
                this.value = this.value.replace(/[^a-zA-Z0-9]/g, "");
            });
        })
    </script>

    <script>
        document.querySelector('.create-draftOrder').addEventListener('submit', function(e) {
            let required_fields = document.querySelectorAll('select.required,input.required');
            required_fields.forEach(field => {
                let error_message = field.previousElementSibling;
                if (!field.value) {
                    let message = field.getAttribute('data-message');
                    error_message.style.display = 'block';
                    error_message.innerText = message;
                    field.classList.add('error-border');
                    e.preventDefault();
                } else {
                    error_message.style.display = 'none';
                    field.classList.remove('error-border');
                }
            });

            let weight_value = document.querySelector('[name="weight"]').value ?? 0;
            let cbm_value = document.querySelector('[name="cbm"]').value ?? 1;

            if (weight_value / cbm_value > 320) {
                e.preventDefault();
                document.getElementById('create-order-modal').classList.add('activeModal');
            }
        });
    </script>

    <script>
        function calculate_cbm() {
            let width = document.querySelector('[name="width"]').value;
            let length = document.querySelector('[name="length"]').value;
            let height = document.querySelector('[name="height"]').value;
            let cbm = document.querySelector('[name="cbm"]');
            if (width != null && height != null && length != null) {
                let calculated_cbm = width * height * length;
                cbm.value = calculated_cbm.toFixed(2);
            }
        }
    </script>

    <script>
        document.querySelector('[name="cbm"]').addEventListener('input', function() {
            let cbm_value = this.value;
            if (cbm_value) {
                document.querySelector('[name="width"]').classList.remove('required');
                document.querySelector('[name="height"]').classList.remove('required');
                document.querySelector('[name="length"]').classList.remove('required');
            } else {
                document.querySelector('[name="width"]').classList.add('required');
                document.querySelector('[name="height"]').classList.add('required');
                document.querySelector('[name="length"]').classList.add('required');
            }
        });
    </script>

    <script>
        // function create_order() {
        //     let weight_value = document.querySelector('[name="weight"]').value ?? 0;
        //     let cbm_value = document.querySelector('[name="cbm"]').value ?? 1;
        //     if (weight_value / cbm_value > 320) {
        //         event.preventDefault();
        //         document.getElementById('create-order-modal').classList.add('activeModal');
        //     } else {
        //         submit_order();
        //     }
        // }

        function submit_order() {
            document.querySelector('.create-draftOrder').submit();
        }

        function close_create_order_modal() {
            document.getElementById('create-order-modal').classList.remove('activeModal');
        }
    </script>
@endpush
