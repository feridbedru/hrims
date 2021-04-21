<h6 class="ml-2">{{ __('setting.requiredField') }}<span class="text-danger">*</span> </h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">{{ __('setting.ZoneName') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" oninput="process(this)" id="name"
            value="{{ old('name', optional($zone)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{ __('setting.placeholderName') }}">
    </div>
</div>

<div class="form-group {{ $errors->has('region') ? 'has-error' : '' }}">
    <label for="region" class="col-md-4 control-label">{{ __('setting.Regions') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-12">
        <select class="form-control" id="region" name="region" required="true">
            <option value="" style="display: none;"
                {{ old('region', optional($zone)->region ?: '') == '' ? 'selected' : '' }} disabled selected>
                {{ __('setting.Selectregion') }}</option>
            @foreach ($regions as $key => $region)
                <option value="{{ $key }}"
                    {{ old('regionS', optional($zone)->region) == $key ? 'selected' : '' }}>
                    {{ $region }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<script>
    function process(input) {
        let value = input.value;
        let text = value.replace(/[^A-Z,a-z ]/g, "");
        input.value = text;
    }

</script>
