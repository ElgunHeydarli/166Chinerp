@extends('back.layouts.master')
@section('title', 'Hesabı Düzəliş et')

@section('content')
<div class="editAccount-container">
    <a href="{{ route('admin.ledger-accounts.index') }}" class="backLink">
        ← Geri
    </a>
    <div class="head-title">
        <p>Düzəliş et</p>
    </div>

    <form action="{{ route('admin.ledger-accounts.update', $account->id) }}" method="POST" class="editAccount-form">
        @csrf
        @method('PUT')
        <div class="form-line">
            <div class="form-item">
                <label>Hesabın nömrəsi</label>
                <input type="text" name="code" placeholder="00000" value="{{ old('code', $account->code) }}">
            </div>

            <div class="form-item">
                <label>Hesabın adı</label>
                <input type="text" name="title" placeholder="Ad" value="{{ old('title', $account->title) }}">
            </div>

            <div class="form-item">
                <label>Hesabın növü</label>
                <select name="type" class="nice-select">
                    <option value="">Seçin</option>
                    <option value="aktiv" @selected(old('type', $account->type) == 'aktiv')>Aktiv</option>
                    <option value="passiv" @selected(old('type', $account->type) == 'passiv')>Passiv</option>
                    <option value="gəlir" @selected(old('type', $account->type) == 'gəlir')>Gəlir</option>
                    <option value="xərc" @selected(old('type', $account->type) == 'xərc')>Xərc</option>
                </select>
            </div>

            <div class="form-item">
                <label>Valyuta</label>
                <select name="currency" class="nice-select">
                    <option value="AZN" @selected(old('currency', $account->currency) == 'AZN')>AZN</option>
                    <option value="USD" @selected(old('currency', $account->currency) == 'USD')>USD</option>
                    <option value="YUAN" @selected(old('currency', $account->currency) == 'YUAN')>YUAN</option>
                </select>
            </div>
        </div>

        <div class="form-item">
            <label>Qeyd</label>
            <textarea name="description" placeholder="Qeyd yazın...">{{ old('description', $account->description) }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="status" id="status" value="1" {{ old('status', $account->status) ? 'checked' : '' }}>
            <label for="status">Aktiv</label>
        </div>

        <button type="submit" class="submitEditAccount">Yadda saxla</button>
    </form>
</div>
@endsection
