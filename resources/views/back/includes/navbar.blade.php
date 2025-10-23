<div class="nav-container">
    <div class="nav-menu">
        <a href="{{ route('admin.dashboard') }}" class="navbarLink">{{ trns('control_panel') }}</a>
        @canany(['Bütün Müştərilər page', 'Fiziki Şəxs page', 'Korporativ page'])
            <div class="menu-item">

                <div class="menu-title">
                    {{ trns('our_customers') }}
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.75 7.5L9 11.25L5.25 7.5" stroke="black" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="subMenu">
                    @can('Bütün Müştərilər page')
                        <a href="{{ route('admin.customer.index') }}" class="menuLink">{{ trns('all_customers') }}</a>
                    @endcan
                    @can('Fiziki Şəxs page')
                        <a href="{{ route('admin.customer.index', ['type' => \App\Enums\CustomerType::PHYSICAL]) }}"
                            class="menuLink">{{ trns('physical') }}</a>
                    @endcan
                    @can('Korporativ page')
                        <a href="{{ route('admin.customer.index', ['type' => \App\Enums\CustomerType::LEGAL]) }}"
                            class="menuLink">{{ trns('corporative') }}</a>
                    @endcan
                    {{-- <a href="{{ route('admin.customer.index', ['type' => \App\Enums\CustomerType::OWNER]) }}"
                    class="menuLink">Fərdi sahibkar</a> --}}

                </div>
            </div>
        @endcanany

        @canany(['Bütün sifarişlər page', 'Draft page', 'Təsdiqlənən sifarişlər page', 'İcrada olan sifarişlər page',
            'İmtina olunan sifarişlər page', 'Bitmiş sifarişlər page', 'Qiymət gözləyən sifarişlər page'])
            <div class="menu-item">
                <div class="menu-title">
                    {{ trns('orders') }}
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.75 7.5L9 11.25L5.25 7.5" stroke="black" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="subMenu">
                    @can('Bütün sifarişlər page')
                        <a href="{{ route('admin.order.index') }}" class="menuLink">{{ trns('all_orders') }}</a>
                    @endcan

                    @can('Draft page')
                        <a href="{{ route('admin.order.index', ['status' => 'draft']) }}"
                            class="menuLink">{{ trns('draft') }}</a>
                    @endcan

                    @can('Təsdiqlənən sifarişlər page')
                        <a href="{{ route('admin.order.index', ['status' => 'confirmed']) }}"
                            class="menuLink">{{ trns('confirmed') }}</a>
                    @endcan

                    @can('İcrada olan sifarişlər page')
                        <a href="{{ route('admin.order.index', ['status' => 'execute']) }}"
                            class="menuLink">{{ trns('executing') }}</a>
                    @endcan
                    @can('İmtina olunan sifarişlər page')
                        <a href="{{ route('admin.order.index', ['status' => 'rejected']) }}"
                            class="menuLink">{{ trns('rejected') }}</a>
                    @endcan
                    @can('Bitmiş sifarişlər page')
                        <a href="{{ route('admin.order.index', ['status' => 'finished']) }}"
                            class="menuLink">{{ trns('finished') }}</a>
                    @endcan
                    @can('Qiymət gözləyən sifarişlər page')
                        <a href="{{ route('admin.order.priceless') }}" class="menuLink">{{ trns('price_await_orders') }}</a>
                    @endcan
                </div>
            </div>
        @endcanany

        @canany([
            'Bütün Konteynerlər page',
            'Rezervasiya qiymətləri page',
            'Rezervasiya tarixləri page',
            'Konteyner
            rezervasiyası page',
            ])
            <div class="menu-item">
                <div class="menu-title">
                    {{ trns('containers') }}
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.75 7.5L9 11.25L5.25 7.5" stroke="black" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="subMenu">
                    @can('Bütün Konteynerlər page')
                        <a href="{{ route('admin.container.index') }}" class="menuLink">{{ trns('all_containers') }}</a>
                    @endcan
                    @can('Rezervasiya qiymətləri page')
                        <a href="{{ route('admin.container-price.index') }}" class="menuLink">{{ trns('booking_prices') }}</a>
                    @endcan
                    @can('Rezervasiya tarixləri page')
                        <a href="{{ route('admin.booking-date.index') }}" class="menuLink">{{ trns('booking_dates') }}</a>
                    @endcan
                    @can('Konteyner rezervasiyası page')
                        <a href="{{ route('admin.booking-container.index') }}"
                            class="menuLink">{{ trns('booking_container') }}</a>
                    @endcan
                </div>
            </div>
        @endcanany

        @canany(['Sahibsiz yüklər page'])
            <div class="menu-item">
                <div class="menu-title">
                    {{ trns('abandoned_cargo') }}
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.75 7.5L9 11.25L5.25 7.5" stroke="black" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="subMenu">
                    @can('Sahibsiz yüklər page')
                        <a href="{{ route('admin.abandoned-cargo.index') }}"
                            class="menuLink">{{ trns('all_abandoned_cargo') }}</a>
                    @endcan
                    {{-- <a href="{{ route('admin.order.index', ['status' => 'execute']) }}"
                    class="menuLink">{{ trns('booking_chine') }}</a> --}}
                </div>
            </div>
        @endcanany

        @canany(['Vendor idarəetməsi page'])
            <div class="menu-item">
                <div class="menu-title">
                    {{ trns('other_operations') }}
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.75 7.5L9 11.25L5.25 7.5" stroke="black" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="subMenu">
                    <a href="{{ route('admin.vendor.index') }}" class="menuLink">{{ trns('vendor_management') }}</a>
                </div>
            </div>
        @endcanany
        @canany([
            'Tərcümələr page',
            'Valyutalar page',
            'Şəhərlər page',
            'Mənbələr page',
            'Rayonlar page',
            'Anbarlar
            page',
            'Xidmətlər page',
            'Xərc növləri page',
            'Sənəd növləri page',
            'Rollar page',
            'İcazələr page',
            'Əməkdaşlar
            page',
            'Statuslar page',
            'Yoxlama səbəbləri page',
            ])
            <div class="menu-item">
                <div class="menu-title">
                    {{ trns('settings') }}
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.75 7.5L9 11.25L5.25 7.5" stroke="black" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="subMenu" style="max-height: 450px; overflow-y:auto;">
                    @can('Tərcümələr page')
                        <a href="{{ route('admin.setting.index') }}" class="menuLink">{{ trns('translates') }}</a>
                    @endcan

                    @can('Valyutalar page')
                        <a href="{{ route('admin.currency.index') }}" class="menuLink">{{ trns('currencies') }}</a>
                    @endcan

                    @can('Şəhərlər page')
                        <a href="{{ route('admin.city.index') }}" class="menuLink">{{ trns('cities') }}</a>
                    @endcan

                    @can('Mənbələr page')
                        <a href="{{ route('admin.source.index') }}" class="menuLink">{{ trns('sources') }}</a>
                    @endcan

                    @can('Rayonlar page')
                        <a href="{{ route('admin.district.index') }}" class="menuLink">{{ trns('districts') }}</a>
                    @endcan

                    @can('Anbarlar page')
                        <a href="{{ route('admin.warehouse.index') }}" class="menuLink">{{ trns('warehouses') }}</a>
                    @endcan

                    @can('Xidmətlər page')
                        <a href="{{ route('admin.service.index') }}" class="menuLink">{{ trns('services') }}</a>
                    @endcan

                    @can('Xərc növləri page')
                        <a href="{{ route('admin.expense-type.index') }}" class="menuLink">{{ trns('expense_types') }}</a>
                    @endcan

                    @can('Sənəd növləri page')
                        <a href="{{ route('admin.document-type.index') }}" class="menuLink">{{ trns('document_types') }}</a>
                    @endcan

                    <a href="{{ route('admin.payment-term.index') }}" class="menuLink">Ödəniş şərtləri</a>

                    @can('Rollar page')
                        <a href="{{ route('admin.role.index') }}" class="menuLink">{{ trns('roles') }}</a>
                    @endcan
                    @can('İcazələr page')
                        <a href="{{ route('admin.permission.index') }}" class="menuLink">{{ trns('permissions') }}</a>
                    @endcan
                    @can('Əməkdaşlar page')
                        <a href="{{ route('admin.user.index') }}" class="menuLink">{{ trns('workers') }}</a>
                    @endcan

                    @can('Statuslar page')
                        <a href="{{ route('admin.status.index') }}" class="menuLink">{{ trns('statuses') }}</a>
                    @endcan

                    @can('Yoxlama səbəbləri page')
                        <a href="{{ route('admin.container-check-reason.index') }}"
                            class="menuLink">{{ trns('checking_reasons') }}</a>
                    @endcan
                </div>
            </div>
        @endcanany

        @canany([
            'Alınacaq hesablar',
            'Əməkhaqqı idarəetmə',
            'Xərclər',
            'Ümumi jurnal',
            'Hesablar cədvəli',
            'Mühasibat
            kitabı',
            ])
            <div class="menu-item">
                <div class="menu-title">
                    {{ trns('accountant') }}
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.75 7.5L9 11.25L5.25 7.5" stroke="black" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="subMenu">
                    @can('Alınacaq hesablar')
                        <a href="{{ route('admin.receive.index') }}" class="menuLink">Alınacaq hesablar</a>
                    @endcan

                    @can('Əməkhaqqı idarəetmə')
                        <a href="{{ route('admin.salary.index') }}" class="menuLink">{{ trns('salary_management') }}</a>
                    @endcan

                    @can('Xərclər')
                        <a href="{{ route('admin.expense.index') }}" class="menuLink">{{ trns('expenses') }}</a>
                    @endcan

                    @can('Ümumi jurnal')
                        <a href="{{ route('admin.journal.index') }}" class="menuLink">Ümumi jurnal</a>
                    @endcan

                    @can('Hesablar cədvəli')
                        <a href="{{ route('admin.ledger-accounts.index') }}" class="menuLink">Hesablar cədvəli</a>
                    @endcan

                    @can('Mühasibat kitabı')
                        <a href="{{ route('admin.accountant-book.index') }}" class="menuLink">Mühasibat kitabı</a>
                    @endcan


                </div>

            </div>
        @endcanany
        {{-- <a href="createDraft.html" type="button" class="createDraft">
            Əlavə et
        </a> --}}
    </div>
</div>
