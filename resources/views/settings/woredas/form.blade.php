<h6 class="ml-2">{{ __('setting.requiredField') }}<span class="text-danger">*</span> </h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">{{ __('setting.WoredaName ') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name" oninput="process(this)"
            value="{{ old('name', optional($woreda)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder={{ __('setting.woredaname') }}>
    </div>
</div>

<div class="form-group {{ $errors->has('zone') ? 'has-error' : '' }}">
    <label for="zone" class="col-md-4 control-label">{{ __('setting.zoneName ') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-12">
        <select class="form-control" id="zone" name="zone" required="true">
            <option value="" style="display: none;"
                {{ old('zone', optional($woreda)->zone ?: '') == '' ? 'selected' : '' }} disabled selected>
                {{ __('setting.Selectzone') }}
            </option>
            @foreach ($zones as $key => $zone)
                <option value="{{ $key }}"
                    {{ old('zone', optional($woreda)->zone) == $key ? 'selected' : '' }}>
                    {{ $zone }}
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
