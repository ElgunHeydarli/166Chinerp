@csrf

<div class="mb-3">
    <label for="code" class="form-label">Kod</label>
    <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $account->code ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label for="title" class="form-label">Ad</label>
    <input type="text" name="title" id="title" class="form-control"
        value="{{ old('title', $account->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="type" class="form-label">Tip</label>
    <select name="type" id="type" class="form-select select2" required>
        @foreach (['aktiv', 'passiv', 'gəlir', 'xərc'] as $type)
            <option value="{{ $type }}" @selected(old('type', $account->type ?? '') == $type)>
                {{ ucfirst($type) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="parent_id" class="form-label">Üst Hesab</label>
    <select name="parent_id" id="parent_id" class="form-select select2">
        <option value="">-- Seçilməyib --</option>
        @foreach ($allAccounts as $item)
            <option value="{{ $item->id }}" @selected(old('parent_id', $account->parent_id ?? '') == $item->id)>
                {{ $item->title }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Qeyd</label>
    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $account->descript
