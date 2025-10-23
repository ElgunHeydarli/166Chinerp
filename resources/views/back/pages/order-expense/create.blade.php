@extends('back.layouts.master')

@section('content')
    <div class="expensesAdd-container">
        <div class="head-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                    fill="#534D59" />
            </svg>
            <p>Xərc əlavə et</p>
        </div>
        <form method="POST" class="expensesAdd-form">
            @csrf
            <div class="form-list">
                @foreach ($order->expenses as $order_expense)
                    @include('back.pages.order.add-expense', [
                        'expense_types' => $expense_types,
                        'payment_types' => $payment_types,
                        'vendors' => $vendors,
                        'order_expense' => $order_expense,
                    ])
                @endforeach
            </div>
            <button class="add_expensesAddForm" onclick="add_expense()" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="#00A3E8" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Yeni xərc əlavə et
            </button>
            <button class="submit-expensesAdd" type="submit">Təsdiq</button>
        </form>

    </div>
@endsection

@push('js')
    <script>
        function add_expense() {
            let expense_container = document.querySelector('.expensesAdd-form .form-list');
            let url = `/order/add-expense`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        expense_container.insertAdjacentHTML('beforeend', data.view);
                        let all_selects = document.querySelectorAll('select');
                        all_selects.forEach(select => {
                            $(select).niceSelect();
                        })
                    }
                });
        }
    </script>
@endpush
