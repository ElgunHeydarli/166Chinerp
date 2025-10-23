<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="{{ asset('back/assets') }}/jquery-nice-select-1.1.0/css/nice-select.css">
<link rel="stylesheet" href="{{ asset('back/assets/select2/style.css') }}">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="{{ asset('back/assets') }}/css/style.css?v={{ time() }}">
<style>
    tbody tr td .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px;
    }

    tbody tr td .switch input[type="checkbox"] {
        opacity: 0;
        width: 0;
        height: 0;
    }

    table tbody tr td .switch .slider::before {}

    tbody tr td .switch .slider.round:before {
        border-radius: 100px;
    }
</style>

@stack('css')
