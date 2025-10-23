@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <h2 style="margin-bottom:25px; font-size:28px;">Daşınma xidməti əlavə et</h2>
        <form method="POST" action="{{ route('admin.transportation-service.store') }}" class="create-draftOrder">
            @csrf
            <div class="draftOrder-form">
                <div class="form-item">
                    <label for="">Başlıq<span>*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Daşınma növü<span>*</span></label>
                    <select name="transportation_type_id" id="">
                        <option value="">Seçin</option>
                        @foreach ($transportation_types as $transportation_type)
                            <option value="{{ $transportation_type->id }}"
                                {{ old('transportation_type_id') == $transportation_type->id ? 'selected' : '' }}>
                                {{ $transportation_type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Status<span>*</span></label>
                    <select name="status" class="nice-select" id="">
                        <option value="1" {{ old('status') === 1 ? 'selected' : '' }}>Aktiv</option>
                        <option value="0" {{ old('status') === 0 ? 'selected' : '' }}>Deaktiv</option>
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
