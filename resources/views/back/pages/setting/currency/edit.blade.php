@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <h2 style="font-size: 28px; margin-bottom:25px;">Valyuta redaktə et</h2>
        <form method="POST" action="{{ route('admin.currency.update', $currency->id) }}" class="create-draftOrder">
            @csrf
            @method('PUT')
            <div class="draftOrder-form">
                <div class="form-item">
                    <label for="">Ad<span>*</span></label>
                    <input type="text" name="name" value="{{ $currency->name }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Kod<span>*</span></label>
                    <input type="text" name="code" value="{{ $currency->code }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Simvol<span>*</span></label>
                    <input type="text" name="symbol" value="{{ $currency->symbol }}" placeholder="Text here...">
                </div>
            </div>
            <button class="submitDraftOrder" type="submit">Təsdiqlə</button>
        </form>
    </div>
@endsection

@push('css')
    <style>
        .create-draftOrder-container .create-draftOrder .draftOrder-form {
            grid-template-columns: repeat(2, 1fr);
        }
    </style>
@endpush

@push('js')
    <script>
        let resetSelectBtns = document.querySelectorAll('.resetSelectBtn');
        resetSelectBtns.forEach(resetSelectBtn => {
            resetSelectBtn.addEventListener('click', function() {
                let select = resetSelectBtn.previousElementSibling.previousElementSibling;
                select.value = '';
                $(select).niceSelect('update');
            });
        });
    </script>
@endpush
