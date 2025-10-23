@extends('back.layouts.master')

@section('content')
    <div class="viewEmployee-container">
        <a href="{{ route('admin.salary.index') }}" class="backLink">
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
            <p>İşçi məlumatları</p>
        </div>
        <div class="viewEmployee-box">
            <div class="viewEmployee-box-item">
                <div class="item">
                    <h2>İşçi İD</h2>
                    <p>{{ $user->id }}</p>
                </div>
                <div class="item">
                    <h2>Ad</h2>
                    <p>{{ $user->firstname ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Soyad</h2>
                    <p>{{ $user->lastname ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>FİN kod</h2>
                    <p>{{ $user->fin ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Rol</h2>
                    <p>Operator</p>
                </div>
            </div>
            <div class="viewEmployee-box-item">
                <div class="item">
                    <h2>Vəzifə</h2>
                    <p>{{ $user->position ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>MMC</h2>
                    <p>{{ $user->mmc ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>E-mail</h2>
                    <p>{{ $user->email ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Mobil nömrə</h2>
                    <p>{{ $user->phone ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Cins</h2>
                    <p>{{ $user->gender ?? ' - ' }}</p>
                </div>
            </div>
            <div class="viewEmployee-box-item">
                <div class="item">
                    <h2>Təhsil</h2>
                    <p>{{ $user->education?->name ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Şöbə</h2>
                    <p>{{ $user->branch?->name ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Ölkə</h2>
                    <p>{{ $user->country?->name ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Gross ə/h</h2>
                    <p>{{ $user->gross_salary ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Nəğd</h2>
                    <p>{{ $user->cash ?? ' - ' }}</p>
                </div>
            </div>
            <div class="viewEmployee-box-item">
                <div class="item">
                    <h2>Bank</h2>
                    <p>{{ $user->bank ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Hökümət ödənişi</h2>
                    <p>{{ $user->government_payment ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Net ə/h</h2>
                    <p>{{ $user->net_salary ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Valyuta</h2>
                    <p>{{ $user->currency ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Müqavilə tarixi</h2>
                    <p>{{ $user->start_date?->format('d/m/Y') ?? ' - ' }}</p>
                </div>
            </div>
            <div class="viewEmployee-box-item">
                <div class="item">
                    <h2>Müqavilə bitmə tarixi</h2>
                    <p>{{ $user->end_date?->format('d/m/Y') ?? ' - ' }}</p>
                </div>
            </div>
        </div>
        <div class="employeeFilesArea">
            <div class="employeeFiles-left">
                <h2>İşçi faylları</h2>
                {{-- <p>Lorem Ipsum</p> --}}
            </div>
            <div class="employeeFiles">
                <div class="employeeFiles-item">
                    <h2 class="fileTitle">Şəkil</h2>
                    <a href="{{ asset($user->image) }}" class="file_link" target="_blank">
                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
