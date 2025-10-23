@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <h2 style="margin-bottom:25px; font-size:28px;">Hüquqi müştəri əlavə et</h2>
        <form method="POST" action="{{ route('admin.customer.store') }}" class="create-draftOrder">
            @csrf
            <div class="draftOrder-form">
                <input type="hidden" name="type" value="{{ \App\Enums\CustomerType::LEGAL }}">
                <div class="form-item">
                    <label for="">Ad<span>*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Telefon nömrəsi<span>*</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Vöen<span>*</span></label>
                    <input type="text" name="voen" value="{{ old('voen') }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Ünvan</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Mənbə</label>
                    <select name="source_id" id="">
                        <option value="">Seçin</option>
                        @foreach ($sources as $source)
                            <option value="{{ $source->id }}" {{ old('source_id') == $source->id ? 'selected' : '' }}>
                                {{ $source->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Status</label>
                    <select name="status" id="">
                        <option value="1">Aktiv</option>
                        <option value="0">Deaktiv</option>
                    </select>
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
