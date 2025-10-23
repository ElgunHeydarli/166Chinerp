<div class="factory-form">
    <div class="factory-form-head">
        <h2>Tədarükçü {{ $counter }}</h2>
        <div class="factory-form-toggle">
            <p>Sənədləri müştəri yükləyəcək</p>
            <label class="switch">
                <input type="checkbox" name="is_customer_upload[]"
                    value="{{ isset($order_factory) ? ($order_factory->detail?->is_customer_upload ? 'checked' : '') : '' }}">
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="factory-files">
        <div class="factory-file">
            <div class="factory-file-item">
                <label for="">Müqavilə<span>*</span></label>
                <div class="file-area">
                    <p>
                        Yüklə
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                fill="white" />
                        </svg>
                    </p>
                    <input type="file" onchange="add_file(this)"
                        {{ !isset($order_factory) || is_null($order_factory->file) || is_null($order_factory->file->contract) ? '' : '' }}
                        name="contract[]">
                    <input type="hidden" name="contract_file[]"
                        value="{{ isset($order_factory) ? $order_factory->file?->contract : '' }}">
                    <span class="fileName"></span>
                </div>
            </div>
            <div class="icon">
                @if (isset($order_factory) && !is_null($order_factory->file) && !empty($order_factory->file->contract))
                    <svg width="38" height="39" viewBox="0 0 38 39" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M31.7152 12.362L23.4027 4.04949C23.2923 3.93925 23.1613 3.85184 23.0171 3.79224C22.873 3.73264 22.7185 3.70203 22.5625 3.70215H8.3125C7.68261 3.70215 7.07852 3.95237 6.63312 4.39777C6.18772 4.84317 5.9375 5.44726 5.9375 6.07715V32.2021C5.9375 32.832 6.18772 33.4361 6.63312 33.8815C7.07852 34.3269 7.68261 34.5771 8.3125 34.5771H29.6875C30.3174 34.5771 30.9215 34.3269 31.3669 33.8815C31.8123 33.4361 32.0625 32.832 32.0625 32.2021V13.2021C32.0626 13.0462 32.032 12.8917 31.9724 12.7475C31.9128 12.6034 31.8254 12.4724 31.7152 12.362ZM23.75 26.2646H14.25C13.9351 26.2646 13.633 26.1395 13.4103 25.9168C13.1876 25.6941 13.0625 25.3921 13.0625 25.0771C13.0625 24.7622 13.1876 24.4602 13.4103 24.2375C13.633 24.0148 13.9351 23.8896 14.25 23.8896H23.75C24.0649 23.8896 24.367 24.0148 24.5897 24.2375C24.8124 24.4602 24.9375 24.7622 24.9375 25.0771C24.9375 25.3921 24.8124 25.6941 24.5897 25.9168C24.367 26.1395 24.0649 26.2646 23.75 26.2646ZM23.75 21.5146H14.25C13.9351 21.5146 13.633 21.3895 13.4103 21.1668C13.1876 20.9441 13.0625 20.6421 13.0625 20.3271C13.0625 20.0122 13.1876 19.7102 13.4103 19.4875C13.633 19.2648 13.9351 19.1396 14.25 19.1396H23.75C24.0649 19.1396 24.367 19.2648 24.5897 19.4875C24.8124 19.7102 24.9375 20.0122 24.9375 20.3271C24.9375 20.6421 24.8124 20.9441 24.5897 21.1668C24.367 21.3895 24.0649 21.5146 23.75 21.5146ZM22.5625 13.2021V6.6709L29.0938 13.2021H22.5625Z"
                            fill="#32B558"></path>
                    </svg>
                @endif
            </div>
        </div>
        <div class="factory-file">
            <div class="factory-file-item">
                <label for="">İnvoys<span>*</span></label>
                <div class="file-area">
                    <p>
                        Yüklə
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                fill="white" />
                        </svg>
                    </p>
                    <input type="file"
                        {{ !isset($order_factory) || is_null($order_factory->file) || is_null($order_factory->file->invoice) ? '' : '' }}
                        onchange="add_file(this)" name="invoice[]">
                    <input type="hidden" name="invoice_file[]"
                        value="{{ isset($order_factory) ? $order_factory->file?->invoice : '' }}">
                    <span class="fileName"></span>
                </div>
            </div>
            <div class="icon">
                @if (isset($order_factory) && !is_null($order_factory->file) && !empty($order_factory->file->invoice))
                    <svg width="38" height="39" viewBox="0 0 38 39" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M31.7152 12.362L23.4027 4.04949C23.2923 3.93925 23.1613 3.85184 23.0171 3.79224C22.873 3.73264 22.7185 3.70203 22.5625 3.70215H8.3125C7.68261 3.70215 7.07852 3.95237 6.63312 4.39777C6.18772 4.84317 5.9375 5.44726 5.9375 6.07715V32.2021C5.9375 32.832 6.18772 33.4361 6.63312 33.8815C7.07852 34.3269 7.68261 34.5771 8.3125 34.5771H29.6875C30.3174 34.5771 30.9215 34.3269 31.3669 33.8815C31.8123 33.4361 32.0625 32.832 32.0625 32.2021V13.2021C32.0626 13.0462 32.032 12.8917 31.9724 12.7475C31.9128 12.6034 31.8254 12.4724 31.7152 12.362ZM23.75 26.2646H14.25C13.9351 26.2646 13.633 26.1395 13.4103 25.9168C13.1876 25.6941 13.0625 25.3921 13.0625 25.0771C13.0625 24.7622 13.1876 24.4602 13.4103 24.2375C13.633 24.0148 13.9351 23.8896 14.25 23.8896H23.75C24.0649 23.8896 24.367 24.0148 24.5897 24.2375C24.8124 24.4602 24.9375 24.7622 24.9375 25.0771C24.9375 25.3921 24.8124 25.6941 24.5897 25.9168C24.367 26.1395 24.0649 26.2646 23.75 26.2646ZM23.75 21.5146H14.25C13.9351 21.5146 13.633 21.3895 13.4103 21.1668C13.1876 20.9441 13.0625 20.6421 13.0625 20.3271C13.0625 20.0122 13.1876 19.7102 13.4103 19.4875C13.633 19.2648 13.9351 19.1396 14.25 19.1396H23.75C24.0649 19.1396 24.367 19.2648 24.5897 19.4875C24.8124 19.7102 24.9375 20.0122 24.9375 20.3271C24.9375 20.6421 24.8124 20.9441 24.5897 21.1668C24.367 21.3895 24.0649 21.5146 23.75 21.5146ZM22.5625 13.2021V6.6709L29.0938 13.2021H22.5625Z"
                            fill="#32B558"></path>
                    </svg>
                @endif
            </div>
        </div>
        <div class="factory-file">
            <div class="factory-file-item">
                <label for="">Packing list<span>*</span></label>
                <div class="file-area">
                    <p>
                        Yüklə
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.616 16.577H7.077C5.949 16.577 4.98767 16.1797 4.193 15.385C3.39833 14.5903 3.00067 13.6287 3 12.5C2.99933 11.3713 3.397 10.4097 4.193 9.615C4.989 8.82033 5.95033 8.42266 7.077 8.422H10.616V9.422H7.077C6.23033 9.422 5.506 9.72333 4.904 10.326C4.30133 10.9293 4 11.654 4 12.5C4 13.346 4.30133 14.0703 4.904 14.673C5.50667 15.2757 6.231 15.577 7.077 15.577H10.616V16.577ZM8.5 13V12H15.5V13H8.5ZM13.385 16.577V15.577H16.923C17.7697 15.577 18.494 15.2757 19.096 14.673C19.6987 14.0703 20 13.346 20 12.5C20 11.654 19.6987 10.9297 19.096 10.327C18.4933 9.72433 17.769 9.423 16.923 9.423H13.385V8.423H16.923C18.051 8.423 19.0127 8.82033 19.808 9.615C20.6033 10.4097 21.0007 11.3713 21 12.5C20.9993 13.6287 20.6017 14.5903 19.807 15.385C19.0123 16.1797 18.051 16.5773 16.923 16.578L13.385 16.577Z"
                                fill="white" />
                        </svg>
                    </p>
                    <input type="file"
                        {{ !isset($order_factory) || is_null($order_factory->file) || is_null($order_factory->file->packing_list) ? '' : '' }}
                        onchange="add_file(this)" name="packing_list[]">
                    <input type="hidden" name="packing_list_file[]"
                        value="{{ isset($order_factory) ? $order_factory->file?->packing_list : '' }}">
                    <span class="fileName"></span>
                </div>
            </div>
            <div class="icon">
                @if (isset($order_factory) && !is_null($order_factory->file) && !empty($order_factory->file->packing_list))
                    <svg width="38" height="39" viewBox="0 0 38 39" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M31.7152 12.362L23.4027 4.04949C23.2923 3.93925 23.1613 3.85184 23.0171 3.79224C22.873 3.73264 22.7185 3.70203 22.5625 3.70215H8.3125C7.68261 3.70215 7.07852 3.95237 6.63312 4.39777C6.18772 4.84317 5.9375 5.44726 5.9375 6.07715V32.2021C5.9375 32.832 6.18772 33.4361 6.63312 33.8815C7.07852 34.3269 7.68261 34.5771 8.3125 34.5771H29.6875C30.3174 34.5771 30.9215 34.3269 31.3669 33.8815C31.8123 33.4361 32.0625 32.832 32.0625 32.2021V13.2021C32.0626 13.0462 32.032 12.8917 31.9724 12.7475C31.9128 12.6034 31.8254 12.4724 31.7152 12.362ZM23.75 26.2646H14.25C13.9351 26.2646 13.633 26.1395 13.4103 25.9168C13.1876 25.6941 13.0625 25.3921 13.0625 25.0771C13.0625 24.7622 13.1876 24.4602 13.4103 24.2375C13.633 24.0148 13.9351 23.8896 14.25 23.8896H23.75C24.0649 23.8896 24.367 24.0148 24.5897 24.2375C24.8124 24.4602 24.9375 24.7622 24.9375 25.0771C24.9375 25.3921 24.8124 25.6941 24.5897 25.9168C24.367 26.1395 24.0649 26.2646 23.75 26.2646ZM23.75 21.5146H14.25C13.9351 21.5146 13.633 21.3895 13.4103 21.1668C13.1876 20.9441 13.0625 20.6421 13.0625 20.3271C13.0625 20.0122 13.1876 19.7102 13.4103 19.4875C13.633 19.2648 13.9351 19.1396 14.25 19.1396H23.75C24.0649 19.1396 24.367 19.2648 24.5897 19.4875C24.8124 19.7102 24.9375 20.0122 24.9375 20.3271C24.9375 20.6421 24.8124 20.9441 24.5897 21.1668C24.367 21.3895 24.0649 21.5146 23.75 21.5146ZM22.5625 13.2021V6.6709L29.0938 13.2021H22.5625Z"
                            fill="#32B558"></path>
                    </svg>
                @endif
            </div>
        </div>
    </div>
    <div class="factory-inputs">
        <div class="form-line">
            <div class="form-item">
                <label for="">Zavodun adı</label>
                <input type="text" oninput="convert_alphanumeric(this)" name="factory_name[]"
                    value="{{ isset($order_factory) ? $factory->name : '' }}" placeholder="text here">
            </div>
            <div class="form-item">
                <label for="">Zavodun nömrəsi</label>
                <input type="text" oninput="convert_numeric(this)" name="factory_phone[]"
                    value="{{ isset($order_factory) ? $factory->phone : '' }}" placeholder="text here">
            </div>
            <div class="form-item">
                <label for="">{{ trns('weight') }}(kub)</label>
                <input type="text" oninput="convert_numeric(this)" name="factory_cube[]"
                    value="{{ isset($order_factory) ? $order_factory->detail?->cube : '' }}" placeholder="text here">
            </div>
        </div>
        <div class="form-line">
            <div class="form-item">
                <label for="">Təhvil verilmə məntəqəsi</label>
                <input type="text" oninput="convert_letter(this)" name="factory_delivery_point[]"
                    value="{{ isset($order_factory) ? $order_factory->detail?->delivery_point : '' }}"
                    placeholder="text here">
            </div>
            @if ($order->mix_full != 'automobile')
                <div class="form-item">
                    <label for="">Qutu sayı</label>
                    <input type="text" oninput="convert_numeric(this)" name="box_count[]"
                        value="{{ isset($order_factory) ? $order_factory->detail?->box_count : 0 }}"
                        placeholder="text here">
                </div>
                <div class="form-item">
                    <label for="">Pallet sayı</label>
                    <input type="text" oninput="convert_numeric(this)" name="palette_count[]"
                        value="{{ isset($order_factory) ? $order_factory->detail?->palette_count : 0 }}"
                        placeholder="text here">
                </div>
            @else
                <div class="form-item">
                    <label for="">Maşın sayı</label>
                    <input type="text" oninput="add_vin_code(this)" name="car_count[]"
                        value="{{ isset($order_factory) ? $order_factory->detail?->car_count : '' }}"
                        placeholder="text here">
                </div>
            @endif
        </div>
        <div class="form-line-item">
            <div class="form-products">
                <div class="form-item">
                    <label for="">{{ trns('product') }} növü</label>
                    <select class="nice-select" style="max-width: 100%;" name="product_type_id[]"
                        {{-- onchange="_vin_code(this)" --}} id="">
                        <option value="">Seçin</option>
                        @foreach ($product_types as $product_type)
                            @if ($order->mix_full == 'automobile')
                                <option value="{{ $product_type->id }}"
                                    {{ $product_type->id == 1 ? 'selected' : '' }}>
                                    {{ $product_type->name }}</option>
                            @else
                                <option value="{{ $product_type->id }}"
                                    {{ isset($order_factory) ? ($order_factory->detail?->product_type_id == $product_type->id ? 'selected' : '') : '' }}>
                                    {{ $product_type->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-item"
                    style="display: {{ isset($order_factory) ? ($order_factory->detail?->product_type_id == 1 ? 'block' : 'none') : 'none' }}">
                    <label for="">VİN kod <span>*</span></label>
                    <input type="text" oninput="convert_alphanumeric(this)" name="vin_code[]"
                        {{ isset($order_factory) ? ($order_factory->detail?->product_type_id == 1 ? '' : '') : '' }}
                        value="{{ isset($order_factory) ? $order_factory->detail?->vin_code : '' }}"
                        placeholder="text here">
                </div> --}}
            </div>
            <div class="form-note form-item">
                <label for="">Qeyd</label>
                <input type="text" name="factory_note[]"
                    value="{{ isset($order_factory) ? $order_factory->detail?->note : '' }}" placeholder="text here">
            </div>
        </div>

        <div class="factory-products vin-code-area">
            @if (isset($order_factory))
                @foreach ($order_factory->vin_codes as $key => $factory_vin_code)
                    @include('back.pages.order.section.add-vin-code', [
                        'counter' => $key,
                        'factory_vin_code' => $factory_vin_code,
                    ])
                @endforeach
            @endif
        </div>

        <div class="factory-products">
            <div class="productInputs">
                @if (isset($order_factory))
                    @if (count($order_factory->products))
                        @foreach ($order_factory->products as $key => $factory_product)
                            <div class="productInput">
                                <div class="productInput">
                                    <div class="form-item">
                                        <label for="">{{ trns('product') }}</label>
                                        <input type="text" oninput="convert_alphanumeric(this)"
                                            name="products[{{ $counter - 1 }}][]"
                                            value="{{ $factory_product->product->name }}" placeholder="text here">
                                    </div>
                                    <button onclick="delete_product(this)" type="button" class="removePro">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                                fill="#FF0000" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="productInput">
                            <div class="form-item">
                                <label for="">{{ trns('product') }}</label>
                                <input type="text" oninput="convert_alphanumeric(this)"
                                    name="products[{{ $counter - 1 }}][]" placeholder="text here">
                            </div>
                        </div>
                    @endif
                @else
                    <div class="productInput">
                        <div class="form-item">
                            <label for="">{{ trns('product') }}</label>
                            <input type="text" oninput="convert_alphanumeric(this)"
                                name="products[{{ $counter - 1 }}][]" placeholder="text here">
                        </div>
                    </div>
                @endif
            </div>
            <button onclick="add_product(this,{{ $counter - 1 }})" class="addNewProInput" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                {{ trns('product') }} əlavə et
            </button>
        </div>
        <button type="button" onclick="delete_factory(this)" class="removeInfos">
            Məlumatları sil
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.4 16.308L12 12.708L15.6 16.308L16.308 15.6L12.708 12L16.308 8.4L15.6 7.692L12 11.292L8.4 7.692L7.692 8.4L11.292 12L7.692 15.6L8.4 16.308ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                    fill="#FF0000" />
            </svg>
        </button>
    </div>
</div>
