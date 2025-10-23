@extends('back.layouts.master')

@section('content')
    <div class="reservateDate-container">
        <div class="sub_reservateDateTabContent reservateDateContent" data-id="reservateDates">
            <input type="hidden" class="allowed-dates" value="{{ implode(',', $booking_dates) }}">
            @include('back.pages.booking-date.section.booking-date-view', [
                'booking_date' => $booking_date,
            ])
            @include('back.pages.booking-date.section.change-booking-date')
            @include('back.pages.booking-date.section.add-check-modal', [
                'container_check_reasons' => $container_check_reasons,
            ])
        </div>
    </div>
@endsection

@push('css')
    <style>
        .green-day.xdsoft_date {
            background-color: #28a745 !important;
            color: white;
        }

        .yellow-day.xdsoft_date {
            background-color: #ffc107 !important;
            color: black;
        }

        .select2-search__field {
            opacity: 0;
        }

        .nice-select {
            width: 100%;
        }

        .form-note {
            position: relative;
            width: 100%;
        }

        .form-note label {
            font-size: 12px;
            font-weight: 600;
            line-height: 14px;
            text-align: left;
            color: #959595;
            position: absolute;
            padding: 0 2px;
            z-index: 2;
            left: 18px;
            top: -6px;
        }

        .form-note textarea {
            height: 100px;
            resize: none;
            width: 100%;
            padding: 15px 16px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e4e4e4;
            outline: none;
            font-size: 16px;
            font-weight: 400;
            line-height: 22px;
            text-align: left;
            color: #000;
        }
    </style>
@endpush

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script src="{{ asset('back/assets') }}/jquery-nice-select-1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('back/assets/select2/select.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select.nice-select').niceSelect();

            $('select.select2').select2();
        });
    </script>
    <script>
        function get_checked_container_ids() {
            let container_ids = [];
            let container_checks = document.querySelectorAll('[name="container_id[]"]');
            container_checks.forEach(check => {
                if (check.checked) container_ids.push(check.value);
            });
            return container_ids;
        }

        function open_check_modal(id) {
            document.querySelector('#add-check-modal').classList.add('activeModal');
            let container_ids = get_checked_container_ids();
            let action = `/booking-date/${id}/add-check`;
            document.querySelector('#add-check-modal [name="container_ids[]"]').value = container_ids;
            document.querySelector('#add-check-modal form').setAttribute('action', action);
        }

        function close_check_modal() {
            document.querySelector('#add-check-modal').classList.remove('activeModal');
        }

        function add_check(id) {
            let container_ids = get_checked_container_ids();
            let url = `/booking-date/${id}/add-check`;
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        '_token': "{{ csrf_token() }}",
                        'container_ids': container_ids,
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        setInterval(() => {
                            window.location.href = '/booking-date?type=checked_container';
                        }, 1500);
                    } else {
                        toastr.error(data.message);
                    }
                });
        }

        function update_booking_date() {
            event.preventDefault();
            let container_ids = get_checked_container_ids();
            let booking_date = document.querySelector('[name="booking_date"]').value;
            let url = '/booking-date/update-booking-date';
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        'container_ids': container_ids,
                        'booking_date': booking_date,
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        setInterval(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        toastr.error(data.message);
                    }
                });
        }

        function dropCheck() {
            const reservateDateView_submit = document.querySelector(".reservateDateView_submit");
            const containerChecks = document.querySelectorAll('.fortified-containers input[type="checkbox"]');
            reservateDateView_submit.style.display = "block";
            containerChecks.forEach((item) => {
                item.style.display = "block";
            });
        }
    </script>

    <script>
        function formatDateToDMY(date) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}.${month}.${year}`;
        }
        let customDates = {};

        let allowedDates = document.querySelector('.allowed-dates').value.split(',');
        allowedDates.forEach(date => {
            customDates[date] = {
                class: 'green-day',
                'tooltip': 'Aktiv'
            };
        });



        jQuery('.booking-datepicker').datetimepicker({
            timepicker: false,
            format: 'd.m.Y',
            beforeShowDay: function(date) {
                const formattedDate = formatDateToDMY(date);
                if (customDates[formattedDate]) {
                    const {
                        class: className,
                        tooltip
                    } = customDates[formattedDate];
                    // class-ları ayrı-ayrı qaytarırıq, hər biri öz yerində
                    return [true, `true ${className}`, tooltip]; // "true" və "className" arasında boşluq olacaq
                }
                return [false, "", "Bu tarix seçilə bilməz"];
            }
        });
    </script>
@endpush
