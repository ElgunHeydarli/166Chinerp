<div class="productInputs">
    @if (isset($factory_vin_code))
        <div class="productInput">
            <div class="form-item">
                <label for="">Vin kod</label>
                <input type="text" oninput="convert_alphanumeric(this)" value="{{ $factory_vin_code->vin_code }}"
                    name="vin_codes[{{ $counter }}][]" placeholder="text here">
            </div>
        </div>
    @else
        @for ($i = 1; $i <= $count; $i++)
            <div class="productInput">
                <div class="form-item">
                    <label for="">Vin kod</label>
                    <input type="text" oninput="convert_alphanumeric(this)" name="vin_codes[{{ $counter - 1 }}][]"
                        placeholder="text here">
                </div>
            </div>
        @endfor
    @endif
</div>
