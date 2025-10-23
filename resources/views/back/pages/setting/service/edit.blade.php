@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <form method="POST" action="{{ route('admin.service.update', $service->id) }}" class="create-draftOrder">
            @csrf
            @method('PUT')
            <div class="draftOrder-form">
                <div class="form-item">
                    <label for="">
                        Başlıq<span>*</span>
                    </label>
                    <input type="text" name="name" value="{{ $service->name }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">
                        Status<span>*</span>
                    </label>
                    <select name="status" class="nice-select" id="">
                        <option value="1" {{ $service->status == 1 ? 'selected' : '' }}>Aktiv</option>
                        <option value="0" {{ $service->status == 0 ? 'selected' : '' }}>Deaktiv</option>
                    </select>
                </div>
                <div class="group-wrapper">
                    <div class="group-wrapper-title">Əlavə punktlar</div>
                    <div class="group-container">
                        <div class="group">
                            <div class="group-title">
                                <input type="checkbox" name="detail_name[]"
                                    {{ $service->details()->where('name', 'expense_type')->exists() ? 'checked' : '' }}
                                    value="expense_type" id="expense_type">
                                <label for="expense_type">Xərc növü</label>
                            </div>
                        </div>
                        <div class="group">
                            <div class="group-title">
                                <input type="checkbox" name="detail_name[]"
                                    {{ $service->details()->where('name', 'document_type')->exists() ? 'checked' : '' }}
                                    value="document_type" id="document_type">
                                <label for="document_type">Sənəd növü</label>
                            </div>
                        </div>
                        <div class="group">
                            <div class="group-title">
                                <input type="checkbox" name="detail_name[]"
                                    {{ $service->details()->where('name', 'start_date')->exists() ? 'checked' : '' }}
                                    value="start_date" id="start_date">
                                <label for="start_date">Başlama tarixi</label>
                            </div>
                        </div>
                        <div class="group">
                            <div class="group-title">
                                <input type="checkbox" name="detail_name[]"
                                    {{ $service->details()->where('name', 'end_date')->exists() ? 'checked' : '' }}
                                    value="end_date" id="end_date">
                                <label for="end_date">Bitmə tarixi</label>
                            </div>
                        </div>
                        <div class="group">
                            <div class="group-title">
                                <input type="checkbox"
                                {{ $service->details()->where('name', 'note')->exists() ? 'checked' : '' }}
                                name="detail_name[]" value="note" id="note">
                                <label for="note">Qeyd</label>
                            </div>
                        </div>
                    </div>
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

        .group-wrapper-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .group-container {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .group {
            display: flex;
            align-items: center;
            padding: 6px 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }

        .group-title {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }

        .group-title input[type="checkbox"] {
            width: 16px;
            height: 16px;
        }

        .group-title label {
            font-weight: 500;
            cursor: pointer;
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
