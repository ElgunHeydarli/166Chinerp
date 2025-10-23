@extends('back.layouts.master')

@section('content')
    <div class="editCost-container">
        <a href="{{ route('admin.expense.index') }}" class="backLink">
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
            <p>Düzəliş et</p>
        </div>
        <form action="{{ route('admin.expense.update', $expense->id) }}" method="POST" class="editCost-form">
            @csrf
            @method('PUT')

            <div class="form-line">
                {{-- Kateqoriya --}}
                <div class="form-item">
                    <label for="">Kateqoriya</label>
                    <select name="expense_category_id" onchange="get_sub_categories(this)" class="nice-select">
                        @foreach ($expense_categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $expense->expense_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Alt kateqoriya --}}
                <div class="form-item">
                    <label for="">Alt kateqoriya</label>
                    <select name="expense_sub_category_id" class="nice-select">
                        @foreach ($expense_sub_categories as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                {{ $expense->expense_sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Log ID --}}
                <div class="form-item">
                    <label for="">Log ID</label>
                    <input type="text" name="log_id" oninput="convert_alphanumeric(this)" value="{{ $expense->log_id }}"
                        placeholder="text here">
                </div>

                {{-- Təchizatçı --}}
                <div class="form-item">
                    <label for="">Təhcizatçı</label>
                    <select name="factory" id="" class="nice-select">
                        <option value="">Seçim edin</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->vendor_name }}"
                                {{ old('factory',$expense->factory) == $vendor->vendor_name ? 'selected' : '' }}>
                                {{ $vendor->vendor_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Xərc növü (Enum) --}}
                <div class="form-item">
                    <label for="">Xərc növü</label>
                    <select name="expense_type" class="nice-select">
                        <option value="{{ \App\Enums\ExpenseType::ONETIME }}"
                            {{ $expense->expense_type === \App\Enums\ExpenseType::ONETIME ? 'selected' : '' }}>
                            Birdəfəlik
                        </option>
                        <option value="{{ \App\Enums\ExpenseType::RECURRING }}"
                            {{ $expense->expense_type === \App\Enums\ExpenseType::RECURRING ? 'selected' : '' }}>
                            Təkrarlanan
                        </option>
                    </select>
                </div>

                {{-- Valyuta --}}
                <div class="form-item">
                    <label for="">Valyuta</label>
                    <select name="currency" class="nice-select">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->code }}"
                                {{ $expense->currency == $currency->code ? 'selected' : '' }}>
                                {{ $currency->code }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Cəmi məbləğ --}}
                <div class="form-item">
                    <label for="">Cəmi məbləğ</label>
                    <input type="text" oninput="calculate_remainder()" name="total_price"
                        value="{{ $expense->total_price }}">
                </div>

                {{-- Ödənilmiş məbləğ --}}
                <div class="form-item">
                    <label for="">Ödənilmiş məbləğ</label>
                    <input type="text" oninput="calculate_remainder()" name="pay_price"
                        value="{{ $expense->pay_price }}">
                </div>

                {{-- Qalıq --}}
                <div class="form-item">
                    <label for="">Qalıq</label>
                    <input type="text" oninput="convert_numeric(this)" name="remainder"
                        value="{{ $expense->remainder }}">
                </div>

                {{-- Son ödəmə tarixi --}}
                <div class="form-item">
                    <label for="">Son ödəmə tarixi</label>
                    <input type="text" name="last_payment_date" class="datetimepicker"
                        value="{{ $expense->last_payment_date?->format('d.m.Y') }}">
                </div>
            </div>

            {{-- Qeyd --}}
            <div class="form-item">
                <label for="">Qeyd</label>
                <textarea name="note">{{ $expense->note }}</textarea>
            </div>

            <button class="submitEditCost" type="submit">Yadda saxla</button>
        </form>

    </div>
@endsection

@push('js')
    <script>
        function convert_numeric(item) {
            // Yalnız rəqəmlərə və bir ədəd nöqtəyə icazə ver
            let cleaned = item.value.replace(/[^0-9.]/g, '');

            // Bir dənədən çox nöqtə varsa, yalnız birincisini saxla
            const parts = cleaned.split('.');
            if (parts.length > 2) {
                cleaned = parts[0] + '.' + parts.slice(1).join('');
            }

            // Əgər ədəd onluq DEYİLSƏ və sıfırla başlayırsa, sıfırı sil
            if (!cleaned.includes('.') && cleaned.startsWith('0') && cleaned.length > 1) {
                cleaned = cleaned.replace(/^0+/, '');
            }

            item.value = cleaned;
        }

        function convert_letter(item) {
            item.value = item.value.replace(/[^a-zA-ZğüşıöçĞÜŞİÖÇn ]/g, "");
        }

        function convert_alphanumeric(item) {
            item.value = item.value.replace(/[^a-zA-Z0-9 ]/g, "");
        }
    </script>

    <script>
        function get_sub_categories(item) {
            let id = item.value;
            let url = `/expense-category/${id}/get-sub-categories`;
            let sub_category = document.querySelector('[name="expense_sub_category_id"]');
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    let html = `<option value="" >Seçim edin</option>`;
                    if (data.status == 'success') {
                        data.data.forEach(item => {
                            html += `<option value="${item.id}" >${item.name}</option>`;
                        });
                    }
                    sub_category.innerHTML = html;
                    $(sub_category).niceSelect('update');
                });
        }
    </script>

    <script>
        function calculate_remainder() {
            let total_price = document.querySelector('[name="total_price"]');
            let pay_price = document.querySelector('[name="pay_price"]');
            convert_numeric(total_price);
            convert_numeric(pay_price);
            let remainder = +(total_price.value ?? 0) - +(pay_price.value ?? 0);
            document.querySelector('[name="remainder"]').value = remainder > 0 ? remainder : 0;
        }
    </script>
@endpush
