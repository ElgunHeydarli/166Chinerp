@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <form method="POST" action="{{ route('admin.price-type.store') }}" class="create-draftOrder">
            @csrf
            <div class="draftOrder-form">
                <div class="form-item">
                    <label for="">Başlıq<span>*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Status<span>*</span></label>
                    <select name="status" class="nice-select" id="">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktiv</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Deaktiv</option>
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
