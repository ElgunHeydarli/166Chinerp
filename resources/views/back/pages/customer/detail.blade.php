@extends('back.layouts.master')

@section('content')
    <div class="viewCLient-container">
        <a href="{{ route('admin.customer.index', ['type' => $customer->customer_type]) }}" class="backLink">
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
            <p>Müştəri məlumatları</p>
        </div>
        <div class="viewCLient-box" style="grid-template-columns: repeat(1,1fr);">
            <div class="viewCLient-box-item" style="display:grid; grid-template-columns: repeat(5,1fr);">
                <div class="item">
                    <h2>Müştəri İD</h2>
                    <p>{{ $customer->id }}</p>
                </div>
                <div class="item">
                    <h2>Müqavilə nömrəsi</h2>
                    <p>{{ $customer->contract_number ?? ' - ' }}</p>
                </div>
                <div class="item">
                    <h2>Ödəniş şərti</h2>
                    <p>{{ $customer->payment_term?->name ?? ' - ' }}</p>
                </div>
                <div class="item">
                    @if ($customer->type == \App\Enums\CustomerType::PHYSICAL)
                        <h2>Ad soyad</h2>
                        <p>{{ $customer->name ?? ' - ' }}</p>
                    @else
                        <h2>Şirkət adı</h2>
                        <p>{{ $customer->company_name ?? ' - ' }}</p>
                    @endif
                </div>
                <div class="item">
                    @if ($customer->type == \App\Enums\CustomerType::LEGAL)
                        <h2>Direktor</h2>
                        <p>{{ $customer->name ?? ' - ' }}</p>
                    @endif
                </div>
                @if ($customer->type == \App\Enums\CustomerType::PHYSICAL)
                    <div class="item">
                        <h2>Cins</h2>
                        <p>{{ $customer->gender == 'male' ? 'Kişi' : 'Qadın' }}</p>
                    </div>
                    <div class="item">
                        <h2>FİN kod</h2>
                        <p>{{ $customer->fin }}</p>
                    </div>
                    <div class="item">
                        <h2>Ş.V Seriya və nömrəsi</h2>
                        <p>{{ $customer->serial_number }}</p>
                    </div>
                @else
                    <div class="item">
                        <h2>VÖEN</h2>
                        <p>{{ $customer->voen }}</p>
                    </div>
                    <div class="item">
                        <h2>Hüquqi ünvan</h2>
                        <p>{{ $customer->property?->legal_address ?? 'Yoxdur' }}</p>
                    </div>
                    <div class="item">
                        <h2>Faktiki ünvan</h2>
                        <p>{{ $customer->property?->factical_address ?? 'Yoxdur' }}</p>
                    </div>
                    <div class="item">
                        <h2>Bank vöeni</h2>
                        <p>{{ $customer->property?->bank_voen ?? 'Yoxdur' }}</p>
                    </div>
                @endif
                <div class="item">
                    <h2>Əlaqə nömrəsi</h2>
                    <p>{{ $customer->phone }}</p>
                </div>
                <div class="item">
                    <h2>Email</h2>
                    <p>{{ $customer->email }}</p>
                </div>
                <div class="item">
                    <h2>Mənbə</h2>
                    <p>{{ $customer->source?->name ?? 'Yoxdur' }}</p>
                </div>
                <div class="item">
                    <h2>Müqavilə bağlanma tarixi</h2>
                    <p>{{ $customer->contract_start_date?->format('d.m.Y') }}</p>
                </div>
                <div class="item">
                    <h2>Müqavilə bitmə tarixi</h2>
                    <p>{{ $customer->contract_end_date?->format('d.m.Y') }}</p>
                </div>
                @if ($customer->type == \App\Enums\CustomerType::LEGAL)
                    <div class="item">
                        <h2>Bank adı</h2>
                        <p>{{ $customer->property?->bank_name ?? 'Yoxdur' }}</p>
                    </div>
                @endif
                <div class="item">
                    <h2>Biz tərəfdən kurator</h2>
                    <p>{{ $customer->user?->name }}</p>
                </div>
                <div class="item">
                    <h2>Müştərinin yaranma tarixi</h2>
                    <p>{{ $customer->date?->format('d.m.Y') }}</p>
                </div>
                <div class="item">
                    <h2>Müştəri növü</h2>
                    <p>
                        @switch($customer->type)
                            @case(\App\Enums\CustomerType::PHYSICAL)
                                Fiziki
                            @break

                            @case(\App\Enums\CustomerType::LEGAL)
                                Korporativ
                            @break

                            @case(\App\Enums\CustomerType::OWNER)
                                Fərdi sahibkar
                            @break
                        @endswitch
                    </p>
                </div>
                @if ($customer->type == \App\Enums\CustomerType::LEGAL)
                    <div class="item">
                        <h2>Kod</h2>
                        <p>{{ $customer->property?->code }}</p>
                    </div>
                @endif
                @if ($customer->type == \App\Enums\CustomerType::LEGAL)
                    <div class="item">
                        <h2>Hesablaşma hesabı</h2>
                        <p>{{ $customer->property?->account ?? 'Yoxdur' }}</p>
                    </div>
                    <div class="item">
                        <h2>Müxbir hesab</h2>
                        <p>{{ $customer->property?->agent_account ?? 'Yoxdur' }}</p>
                    </div>
                    <div class="item">
                        <h2>Swift</h2>
                        <p>{{ $customer->property?->swift ?? 'Yoxdur' }}</p>
                    </div>
                    <div class="item">
                        <h2>Direktor</h2>
                        <p>{{ $customer->property?->director ?? 'Yoxdur' }}</p>
                    </div>
                    <div class="item">
                        <h2>Sektor</h2>
                        <p>{{ $customer->property->sector?->name ?? 'Yoxdur' }}</p>
                    </div>
                @endif
            </div>
            <div class="note-box">
                <h2>Qeyd</h2>
                <div class="notes">
                    <div class="note-item">
                        <h3>{{ $customer->user?->name }} :</h3>
                        <p>{{ $customer->note }}</p>
                    </div>
                </div>
            </div>
            @if (!is_null($customer->property))
                <h2 class="responsible_person_title">Məsul şəxslər</h2>
                <div class="responsible_person_veiws">
                    @foreach ($customer->property->responsible_persons as $responsible_person)
                        <div class="responsible_person_veiw-item">
                            <h3>{{ $responsible_person->name }}</h3>
                            <a href="tel:{{ $responsible_person->phone }}">{{ $responsible_person->phone }}</a>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="CLientFilesArea">
                <div class="CLientFiles-left">
                    <h2>Müştəri faylları</h2>
                </div>
                <div class="CLientFiles">
                    <div class="CLientFiles-item">
                        <h2 class="fileTitle">Müqavilə</h2>
                        <a href="{{ asset($customer->contract) }}" class="file_link" target="_blank">
                            <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                        </a>
                        <span>Tarix : {{ $customer->contract_add_date?->format('d.m.Y') ?? ' - ' }}</span>
                    </div>
                    <div class="CLientFiles-item">
                        <h2 class="fileTitle">Hesab faktura</h2>
                        <a href="{{ asset($customer->bill_invoice) }}" class="file_link" target="_blank">
                            <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                        </a>
                    </div>
                    <div class="CLientFiles-item">
                        <h2 class="fileTitle">Təhvil-təslim aktı</h2>
                        <a href="{{ asset($customer->handover) }}" class="file_link" target="_blank">
                            <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                        </a>
                    </div>
                    <div class="CLientFiles-item">
                        <h2 class="fileTitle">Qiymət razılaşması protokolu</h2>
                        <a href="{{ asset($customer->price_agreement_protocol) }}" class="file_link" target="_blank">
                            <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                        </a>
                    </div>
                    @foreach ($customer->files as $customer_file)
                        <div class="CLientFiles-item">
                            <h2 class="fileTitle">
                                {{ isset(explode('/', $customer_file->file)[2]) ? explode('/', $customer_file->file)[2] : '' }}
                            </h2>
                            <a href="{{ asset($customer_file->file) }}" class="file_link" target="_blank">
                                <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endsection
