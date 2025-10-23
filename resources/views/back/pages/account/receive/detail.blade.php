@extends('back.layouts.master')

@section('content')
    <div class="viewReceivable-container">
        <a href="{{ route('admin.receive.index') }}" class="backLink">
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
            <p>Alınacaq hesabların məlumatları</p>
        </div>
        <button class="addViewReceivablePayBtn" type="button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
            Əlavə et
        </button>
        <div class="viewReceivable-main">
            <div class="viewReceivable-box">
                <div class="box-item">
                    <h2>Invoice İD</h2>
                    <p>{{ $receive->invoice_id }}</p>
                </div>
                <div class="box-item">
                    <h2>Müştəri adı</h2>
                    <p>{{ $receive->customer?->name ?? ' - ' }}</p>
                </div>
                <div class="box-item">
                    <h2>Xidmət/əmtəə</h2>
                    <p>{{ $receive->service_name ?? ' - ' }}</p>
                </div>
                {{-- <div class="box-item">
                    <h2>Log 1</h2>
                    <p>Log123456</p>
                </div> --}}
                <!-- Eger bu qaime ile bagli 2 ve daha cox bir log varsa
                                                                                                <div class="box-item">
                                                                                                    <h2>Log 2</h2>
                                                                                                    <p>Log1234567</p>
                                                                                                </div> -->
                <div class="box-item">
                    <h2>İnvoice tarixi</h2>
                    <p>{{ $receive->invoice_date?->format('d/m/Y') ?? ' - ' }}</p>
                </div>
                <div class="box-item">
                    <h2>Avans üçün son tarix</h2>
                    <p>{{ $receive->last_payment_date?->format('d/m/Y') ?? ' - ' }}</p>
                </div>
                {{-- <div class="box-item">
                    <h2>Ödəniş üçün son tarix</h2>
                    <p>25/01/25</p>
                </div> --}}
                <div class="box-item">
                    <h2>Cəmi məbləğ</h2>
                    <p>{{ $receive->total_price ?? ' - ' }}</p>
                </div>
                <div class="box-item">
                    <h2>Qalıq məbləğ</h2>
                    <p>{{ $receive->remainder ?? ' - ' }}</p>
                </div>
            </div>
            <div class="viewReceivable-table">
                <table>
                    <thead>
                        <tr>
                            <th>Tarix</th>
                            <th>Valyuta</th>
                            <th>Məbləğ</th>
                            <th>Ödəniş üsulu</th>
                            <th>File</th>
                            <th>Qeyd</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receive->payments as $receive_payment)
                            <tr>
                                <td>{{ $receive_payment->date?->format('d.m.Y') ?? ' - ' }}</td>
                                <td>{{ $receive_payment->currency ?? ' - ' }}</td>
                                <td>{{ $receive_payment->price }}</td>
                                <td>{{ $receive_payment->payment_method?->label() ?? ' - ' }}</td>
                                <td>
                                    <a href="{{ asset($receive_payment->file) }}" target="_blank"
                                        class="viewReceivableFile">
                                        <img src="{{ asset('back/assets/images/pdfRed.svg') }}" alt="" />
                                    </a>
                                </td>
                                <td>{{ $receive_payment->note ?? ' - ' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('back.pages.account.receive.section.pay', ['receive' => $receive])
@endsection

@push('js')
    <script>
        const closeAddReceivablePayModal = document.querySelector(".closeAddReceivablePayModal")
        const addReceivablePayModal_container = document.querySelector(".addReceivablePayModal_container")
        const addViewReceivablePayBtn = document.querySelector(".addViewReceivablePayBtn")
        addViewReceivablePayBtn?.addEventListener("click", () => {
            addReceivablePayModal_container.classList.add("activeModal")
        })
        closeAddReceivablePayModal?.addEventListener("click", () => {
            addReceivablePayModal_container.classList.remove("activeModal")
        })

        //=======================================================================
        document.querySelectorAll(".addReceivableFile").forEach((receivableFile) => {
            const receivableFileInput = receivableFile.querySelector('input[type="file"]');
            const receivableFileUploadArea = receivableFile.nextElementSibling;
            const fileNameSpan = receivableFileUploadArea.querySelector(".addReceivableFile-FileName");
            const fileSizeP = receivableFileUploadArea.querySelector(".addReceivableFile-fileSize");
            const uploadLine = receivableFileUploadArea.querySelector(".uploadLine");
            const removeAddReceivableFile = receivableFileUploadArea.querySelector(".removeAddReceivableFile");

            receivableFileInput?.addEventListener("change", async function() {
                if (this.files.length > 0) {
                    receivableFileUploadArea.style.display = "flex";
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

            removeAddReceivableFile?.addEventListener("click", () => {
                receivableFileInput.value = "";
                receivableFileUploadArea.style.display = "none";
            });
        });
    </script>
@endpush
