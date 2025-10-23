@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <form method="POST" action="{{ route('admin.expense-type.update', $expense_type->id) }}" class="create-draftOrder">
            @csrf
            @method('PUT')
            <div class="draftOrder-form">
                <div class="form-item">
                    <label for="">
                        Başlıq<span>*</span>
                    </label>
                    <input type="text" name="name" value="{{ $expense_type->name }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">Xidmət növü <span>*</span></label>
                    <select name="service_id" id="" class="nice-select">
                        <option value="">Seçin</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}"
                                {{ $expense_type->service_id == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="">
                        Status<span>*</span>
                    </label>
                    <select name="status" class="nice-select" id="">
                        <option value="1" {{ $expense_type->status == 1 ? 'selected' : '' }}>Aktiv</option>
                        <option value="0" {{ $expense_type->status == 0 ? 'selected' : '' }}>Deaktiv</option>
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
