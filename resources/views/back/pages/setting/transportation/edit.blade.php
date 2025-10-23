@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <h2 style="font-size: 28px; margin-bottom:25px;">Daşınma redaktə et</h2>
        <form method="POST" action="{{ route('admin.transportation.update', $transportation->id) }}"
            class="create-draftOrder">
            @csrf
            @method('PUT')
            <div class="draftOrder-form">
                <div class="form-item">
                    <label for="">Başlıq<span>*</span></label>
                    <input type="text" name="name" value="{{ $transportation->name }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Daşınma xidməti<span>*</span></label>
                    <select name="transportation_service_id" id="">
                        <option value="">Seçin</option>
                        @foreach ($transportation_services as $transportation_service)
                            <option value="{{ $transportation_service->id }}"
                                {{ $transportation->transportation_service_id == $transportation_service->id ? 'selected' : '' }}>
                                {{ $transportation_service->name . ' (' . $transportation_service->transporation_type->name . ')' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Status<span>*</span></label>
                    <select name="status" class="nice-select" id="">
                        <option value="1" {{ $transportation->status == 1 ? 'selected' : '' }}>Aktiv</option>
                        <option value="0" {{ $transportation->status == 0 ? 'selected' : '' }}>Deaktiv</option>
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
