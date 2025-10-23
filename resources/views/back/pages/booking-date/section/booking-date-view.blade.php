<div class="reservateDateView-container">
    <h2>Rezerv olunma tarixi</h2>
    <form class="reservateDateView-box">
        <div class="box-main">
            <input type="hidden" name="booking_date_id">
            <div class="details-items">
                <div class="details-item" id="booking_date">
                    <h3>Tarix:</h3>
                    <p>{{ $booking_date->date?->format('d.m.Y') }}</p>
                </div>
                <div class="details-item" id="total_cbm">
                    <h3>Cəmi CBM:</h3>
                    <p>{{ $booking_date->total_cbm }}</p>
                </div>
                <div class="details-item" id="remainder_cbm">
                    <h3>Qalan CBM:</h3>
                    <p>{{ $booking_date->remainder_cbm }}</p>
                </div>
                <div class="details-item" id="container_count">
                    <h3>Konteyner sayı:</h3>
                    <p>{{ $booking_date->count }}</p>
                </div>
                <div class="details-item" id="remainder_count">
                    <h3>Qalan konteyner sayı:</h3>
                    <p>{{ $booking_date->count - count($booking_date->containers->where('status', 1)) }}</p>
                </div>
            </div>
            <div class="fortified-containers" id="containers">
                <h3>Təhkim olunan konteynerlər:</h3>
                <div class="containers-names">
                    @foreach ($booking_date->containers as $booking_date_container)
                        <div class="containers-name-item">
                            <input type="checkbox" id="{{ $booking_date_container->container->code }}"
                                value="{{ $booking_date_container->container_id }}" name="container_id[]">
                            <h4 class="container-name">
                                <label
                                    for="{{ $booking_date_container->container->code }}">{{ $booking_date_container->container->code }}</label>
                            </h4>
                        </div>
                    @endforeach
                </div>
            </div>
            @canany([
                'Rezervasiya tarixləri page - Əməliyyatlar - Bax - Yoxlamaya at',
                'Rezervasiya tarixləri page - Əməliyyatlar - Bax - Rez.tarixini dəyiş'
                ])
                <div class="reservateDateView-operation">
                    <button class="reservateDateView-operation-btn" type="button">
                        Əməliyyat
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_22_2058)">
                                <path d="M5 7.38989L9.5 11.8899L14 7.38989" stroke="black" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_22_2058">
                                    <rect width="18" height="18" fill="white"
                                        transform="translate(0.5 0.639893)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                    <div class="reservateDateView-operation-links">
                        @can('Rezervasiya tarixləri page - Əməliyyatlar - Bax - Yoxlamaya at')
                            <button class="reservateDateView-operation-link dropToCheck" onclick="dropCheck()" type="button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 18C4 18.5304 4.21071 19.0391 4.58579 19.4142C4.96086 19.7893 5.46957 20 6 20C6.53043 20 7.03914 19.7893 7.41421 19.4142C7.78929 19.0391 8 18.5304 8 18C8 17.4696 7.78929 16.9609 7.41421 16.5858C7.03914 16.2107 6.53043 16 6 16C5.46957 16 4.96086 16.2107 4.58579 16.5858C4.21071 16.9609 4 17.4696 4 18Z"
                                        stroke="#534D59" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M16 18C16 18.5304 16.2107 19.0391 16.5858 19.4142C16.9609 19.7893 17.4696 20 18 20C18.5304 20 19.0391 19.7893 19.4142 19.4142C19.7893 19.0391 20 18.5304 20 18C20 17.4696 19.7893 16.9609 19.4142 16.5858C19.0391 16.2107 18.5304 16 18 16C17.4696 16 16.9609 16.2107 16.5858 16.5858C16.2107 16.9609 16 17.4696 16 18Z"
                                        stroke="#534D59" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M6 12V10C6 8.4087 6.63214 6.88258 7.75736 5.75736C8.88258 4.63214 10.4087 4 12 4C13.5913 4 15.1174 4.63214 16.2426 5.75736C17.3679 6.88258 18 8.4087 18 10V12"
                                        stroke="#534D59" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15 9L18 12L21 9" stroke="#534D59" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Yoxlamaya at
                            </button>
                        @endcan
                        @can('Rezervasiya tarixləri page - Əməliyyatlar - Bax - Rez.tarixini dəyiş')
                            <button class="reservateDateView-operation-link changeReservedTime" type="button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 7C4 6.46957 4.21071 5.96086 4.58579 5.58579C4.96086 5.21071 5.46957 5 6 5H18C18.5304 5 19.0391 5.21071 19.4142 5.58579C19.7893 5.96086 20 6.46957 20 7V19C20 19.5304 19.7893 20.0391 19.4142 20.4142C19.0391 20.7893 18.5304 21 18 21H6C5.46957 21 4.96086 20.7893 4.58579 20.4142C4.21071 20.0391 4 19.5304 4 19V7Z"
                                        stroke="#534D59" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16 3V7" stroke="#534D59" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M8 3V7" stroke="#534D59" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M4 11H20" stroke="#534D59" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M8 15H10V17H8V15Z" stroke="#534D59" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Rezervasiya tarixini dəyiş
                            </button>
                        @endcan
                    </div>
                </div>
            @endcanany
        </div>
        <div class="reservateDateView-buttons">
            <a class="reservateDateView_back" href="{{ route('admin.booking-date.index') }}" type="button">Geri</a>
            <button class="reservateDateView_submit" onclick="open_check_modal({{ $booking_date->id }})"
                type="button">Təsdiq et</button>

        </div>
    </form>
</div>
