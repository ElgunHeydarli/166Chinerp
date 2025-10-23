<div class="viewVendor_modal">
    <button class="closeViewVendorModal" onclick="close_vendor_view_modal(this)" type="button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </button>
    <div class="head-title">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                fill="#534D59" />
        </svg>
        <p>Vendor məlumatları</p>
    </div>
    <div class="viewVendor-main">
        <div class="viewVendor-box">
            <div class="viewVendor-item">
                <h2 class="item-title">Müştəri növü</h2>
                <p>{{ $vendor->customer_type }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Faktiki ünvan</h2>
                <p>{{ $vendor->factical_address }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Chinese name</h2>
                <p>{{ $vendor->chinese_name }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Bank</h2>
                <p>{{ $vendor->bank }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Vendor name</h2>
                <p>{{ $vendor->vendor_name }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Bank VÖEN</h2>
                <p>{{ $vendor->bank_voen }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Role</h2>
                <p>{{ $vendor->role }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Kod</h2>
                <p>{{ $vendor->code }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Contract start date</h2>
                <p>{{ $vendor->start_date?->format('d/m/Y') ?? 'Yoxdur' }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Hesablaşma hesabı</h2>
                <p>{{ $vendor->account }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Contract end date</h2>
                <p>{{ $vendor->end_date?->format('d/m/Y') ?? 'Yoxdur' }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Müxbir hesab</h2>
                <p>{{ $vendor->agent_account }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">VÖEN</h2>
                <p>{{ $vendor->voen }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">SWIFT</h2>
                <p>{{ $vendor->swift }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Hüquqi ünvan</h2>
                <p>{{ $vendor->legal_address }}</p>
            </div>
            <div class="viewVendor-item">
                <h2 class="item-title">Direktor</h2>
                <p>{{ $vendor->director }}</p>
            </div>

        </div>
        <div class="viewVendor-files-area">
            <div class="viewVendor-files-left">
                <h2>Əlavə edilən sənədlər</h2>
                {{-- <p>{{ !is_null($vendor->file) && !empty($vendor->file->file) ? explode('/',$vendor->file->file)[2] :  }}</p> --}}
            </div>
            <div class="viewVendor-files">
                <div class="viewVendor-file-item">
                    <h2 class="fileTitle">Müqavilə</h2>
                    @if (!is_null($vendor->file) && !empty($vendor->file->file))
                        <a href="{{ asset($vendor->file->file) }}" class="file_link" target="_blank">
                            <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                        </a>
                    @else
                        <a href="#" class="file_link" target="_blank">
                            <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
