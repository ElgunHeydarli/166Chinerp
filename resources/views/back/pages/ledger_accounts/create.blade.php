@extends('back.layouts.master')
@section('title', 'Yeni Hesab əlavə et')

@section('content')
<div class="addAccount-container">
    <a href="{{ route('admin.ledger-accounts.index') }}" class="backLink">
        ← Geri
    </a>
    <div class="head-title">
        <p>Yeni hesabat əlavə et</p>
    </div>

    <form action="{{ route('admin.ledger-accounts.store') }}" method="POST" class="addAccount-form">
        @csrf
        <div class="form-line">
            <div class="form-item">
                <label>Hesabın nömrəsi</label>
                <input type="text" name="code" placeholder="00000" value="{{ old('code') }}">
            </div>

            <div class="form-item">
                <label>Hesabın adı</label>
                <input type="text" name="title" placeholder="Ad" value="{{ old('title') }}">
            </div>

            <div class="form-item">
                <label>Hesabın növü</label>
                <select name="type" class="nice-select">
                    <option value="">Seçin</option>
                    <option value="aktiv" @selected(old('type') == 'aktiv')>Aktiv</option>
                    <option value="passiv" @selected(old('type') == 'passiv')>Passiv</option>
                    <option value="gəlir" @selected(old('type') == 'gəlir')>Gəlir</option>
                    <option value="xərc" @selected(old('type') == 'xərc')>Xərc</option>
                </select>
            </div>

            <div class="form-item">
                <label>Valyuta</label>
                <select name="currency" class="nice-select">
                    <option value="AZN" @selected(old('currency') == 'AZN')>AZN</option>
                    <option value="USD" @selected(old('currency') == 'USD')>USD</option>
                    <option value="YUAN" @selected(old('currency') == 'YUAN')>YUAN</option>
                </select>
            </div>
        </div>

        <div class="form-item">
            <label>Qeyd</label>
            <textarea name="description" placeholder="Qeyd yazın...">{{ old('description') }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="status" id="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
            <label for="status">Aktiv</label>
        </div>

        <button type="submit" class="submitAddAccount">Təsdiq</button>
    </form>
</div>
@endsection
