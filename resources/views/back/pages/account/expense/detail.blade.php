@extends('back.layouts.master')

@section('content')
    <div class="viewCost-container">
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
            <p>Xərc məlumatları</p>
        </div>
        @if ($expense->expense_type == \App\Enums\ExpenseType::ONETIME)
            @if ($expense->remainder > 0)
                <button class="addViewCostBtn" onclick="open_pay_modal()" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Əlavə et
                </button>
            @endif
        @else
            <button class="addViewCostBtn" onclick="open_pay_modal()" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
                Əlavə et
            </button>
        @endif
        <div class="viewCost-main">
            <div class="viewCost-box">
                <div class="box-item">
                    <h2>Kateqoriya</h2>
                    <p>{{ $expense->category->name ?? '-' }}</p>
                </div>
                <div class="box-item">
                    <h2>Sub Kateqoriya</h2>
                    <p>{{ $expense->sub_category->name ?? '-' }}</p>
                </div>
                <div class="box-item">
                    <h2>Log Id</h2>
                    <p>{{ $expense->log_id ?? '-' }}</p>
                </div>
                <div class="box-item">
                    <h2>Təchizatçı</h2>
                    <p>{{ $expense->factory ?? '-' }}</p>
                </div>
                <div class="box-item">
                    <h2>Ödəniş tipi</h2>
                    <p>
                        @if ($expense->expense_type === \App\Enums\ExpenseType::ONETIME)
                            Bir dəfəlik
                        @elseif($expense->expense_type === \App\Enums\ExpenseType::RECURRING)
                            Təkrarlanan
                        @else
                            -
                        @endif
                    </p>
                </div>
                <div class="box-item">
                    <h2>Valyuta</h2>
                    <p>{{ $expense->currency ?? '-' }}</p>
                </div>
                <div class="box-item">
                    <h2>Cəmi</h2>
                    <p>{{ number_format($expense->total_price, 2) }}</p>
                </div>
                <div class="box-item">
                    <h2>Ödənmiş hissə</h2>
                    <p>{{ number_format($expense->pay_price, 2) }}</p>
                </div>
                <div class="box-item">
                    <h2>Qalıq</h2>
                    <p>{{ number_format($expense->remainder, 2) }}</p>
                </div>
                <div class="box-item">
                    <h2>Son ödəmə tarix</h2>
                    <p>{{ optional($expense->last_payment_date)->format('d/m/y') }}</p>
                </div>
            </div>

            <div class="viewCost-table">
                <table>
                    <thead>
                        <tr>
                            <th>Tarix</th>
                            <th>Valyuta</th>
                            <th>Məbləğ</th>
                            <th>Ödəniş üsulu</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expense->payments as $payment)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($payment->date)->format('d.m.Y') }}</td>
                                <td>{{ $payment->currency }}</td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->payment_method->label() ?? ' - ' }}</td>
                                <td>
                                    @if ($payment->file)
                                        <a href="{{ asset('storage/' . $payment->file) }}" target="_blank"
                                            class="viewReceivableFile">
                                            <img src="{{ asset('back/assets/images/pdfRed.svg') }}" alt="file" />
                                        </a>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Ödəniş məlumatı yoxdur.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @include('back.pages.account.expense.pay-modal', ['expense' => $expense])
@endsection

@push('js')
    <script>
        function open_pay_modal() {
            let viewCostPayModal_container = document.querySelector('.viewCostPayModal_container');
            viewCostPayModal_container.classList.add('activeModal');
        }

        function close_pay_modal() {
            let viewCostPayModal_container = document.querySelector('.viewCostPayModal_container');
            viewCostPayModal_container.classList.remove('activeModal');
        }
    </script>

    <script>
        document.querySelectorAll(".addCostFile").forEach((costFile) => {
            const costFileInput = costFile.querySelector('input[type="file"]');
            const costFileUploadArea = costFile.nextElementSibling;
            const fileNameSpan = costFileUploadArea.querySelector(".addCostFile-FileName");
            const fileSizeP = costFileUploadArea.querySelector(".addCostFile-fileSize");
            const uploadLine = costFileUploadArea.querySelector(".uploadLine");
            const removeAddCostFile = costFileUploadArea.querySelector(".removeAddCostFile");

            costFileInput?.addEventListener("change", async function() {
                if (this.files.length > 0) {
                    costFileUploadArea.style.display = "flex";
                    const file = this.files[0];

                    fileNameSpan.textContent = file.name;
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    fileSizeP.textContent = `${fileSizeMB} MB`;

                    // Yükleme çubuğunu sıfırla ve animasyonu başlat
                    uploadLine.style.transition = "none";
                    uploadLine.style.width = "0%";
                    await new Promise((resolve) => setTimeout(resolve, 100));
                    uploadLine.style.transition = "width 0.5s linear";
                    uploadAnimation(uploadLine);
                } else {
                    fileNameSpan.textContent = "";
                    fileSizeP.textContent = "";
                    uploadLine.style.width = "0%";
                }
            });

            removeAddCostFile?.addEventListener("click", () => {
                costFileInput.value = "";
                costFileUploadArea.style.display = "none";
            });
        });
    </script>

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
@endpush
