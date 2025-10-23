@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <h2 style="font-size: 28px; margin-bottom:25px;">Hüquqi müştəri redaktə et</h2>
        <form method="POST" action="{{ route('admin.customer.update', $customer->id) }}" class="create-draftOrder">
            @csrf
            @method('PUT')
            <div class="draftOrder-form">
                <input type="hidden" name="type" value="{{ \App\Enums\CustomerType::LEGAL }}">
                <div class="form-item">
                    <label for="">Ad<span>*</span></label>
                    <input type="text" name="name" value="{{ $customer->name }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Telefon nömrəsi<span>*</span></label>
                    <input type="text" name="phone" value="{{ $customer->phone }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Vöen<span>*</span></label>
                    <input type="text" name="voen" value="{{ $customer->voen }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Email</label>
                    <input type="text" name="email" value="{{ $customer->email }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Ünvan</label>
                    <input type="text" name="address" value="{{ $customer->address }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Mənbə</label>
                    <select name="source_id" id="">
                        <option value="">Seçin</option>
                        @foreach ($sources as $source)
                            <option value="{{ $source->id }}" {{ $customer->source_id == $source->id ? 'selected' : '' }}>
                                {{ $source->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">Status</label>
                    <select name="status" id="">
                        <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>Aktiv</option>
                        <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}>Deaktiv</option>
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
