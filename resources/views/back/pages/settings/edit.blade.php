@extends('back.layouts.master')

@section('content')
    <div class="create-draftOrder-container">
        <form method="POST" action="{{ route('admin.setting.update', $setting->id) }}" class="create-draftOrder">
            @csrf
            @method('PUT')
            <div class="draftOrder-form">
                <div class="form-item">
                    <label for="">
                        Başlıq<span>*</span>
                    </label>
                    <input type="text" name="key" disabled value="{{ $setting->key }}" placeholder="Text here...">
                </div>
                <div class="form-item">
                    <label for="">
                        Dəyər <span>*</span>
                    </label>

                    <div class="tab-wrapper">
                        <div class="tab-buttons">
                            <button type="button" class="tab-btn active" data-tab="az">AZ</button>
                            <button type="button" class="tab-btn" data-tab="en">EN</button>
                            <button type="button" class="tab-btn" data-tab="zh">ZH</button>
                        </div>

                        <div class="tab-contents">
                            <div class="tab-content active" data-tab="az">
                                <input type="text" name="value_az" value="{{ $setting->value_az }}"
                                    placeholder="Text here...">
                            </div>
                            <div class="tab-content" data-tab="en">
                                <input type="text" name="value_en" value="{{ $setting->value_en }}"
                                    placeholder="Text here...">
                            </div>
                            <div class="tab-content" data-tab="zh">
                                <input type="text" name="value_zh" value="{{ $setting->value_zh }}"
                                    placeholder="Text here...">
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

        .tab-buttons {
            display: flex;
            gap: 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .tab-btn {
            background: none;
            border: none;
            padding: 6px 0;
            font-size: 14px;
            color: #3d3d3d;
            cursor: pointer;
            position: relative;
        }

        .tab-btn.active {
            color: #03A9F4;
            font-weight: 500;
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #03A9F4;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
@endpush

@push('js')
    <script>

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const tab = this.dataset.tab;

                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                    if (content.dataset.tab === tab) {
                        content.classList.add('active');
                    }
                });
            });
        });
    </script>
@endpush
