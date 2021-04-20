<h6 class="ml-2">{{ __('setting.requiredField') }}<span class="text-danger">*</span> </h6>
<hr>
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-4 control-label">{{ __('setting.Title') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="title" type="text" id="title" oninput="process(this)"
            value="{{ old('title', optional($template)->title) }}" minlength="1" maxlength="255" required="true"
            placeholder="Enter title here...">
    </div>
</div>

<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
    <label for="body" class="col-md-4 control-label">{{ __('setting.Body') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-12">
        <textarea class="form-control" name="body" cols="50" rows="10" id="body" minlength="1" required="true"
            placeholder="Enter body here...">{{ old('body', optional($template)->body) }}</textarea>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('language') ? 'has-error' : '' }}">
        <label for="language" class="col-md-4 control-label">{{ __('setting.Languages') }} <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="language" name="language" required="true">
                <option value="" style="display: none;"
                    {{ old('language', optional($template)->language ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Enter language here...</option>
                @foreach ($languages as $key => $language)
                    <option value="{{ $key }}"
                        {{ old('language', optional($template)->language) == $key ? 'selected' : '' }}>
                        {{ $language }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('template_type') ? 'has-error' : '' }}">
        <label for="template_type" class="col-md-4 control-label">{{ __('setting.TemplatesType') }} <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="template_type" name="template_type" required="true">
                <option value="" style="display: none;"
                    {{ old('template_type', optional($template)->template_type ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select template type</option>
                @foreach ($templateTypes as $key => $templateType)
                    <option value="{{ $key }}"
                        {{ old('template_type', optional($template)->template_type) == $key ? 'selected' : '' }}>
                        {{ $templateType }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('code') ? 'has-error' : '' }}">
        <label for="code" class="col-md-4 control-label">{{ __('setting.Code') }} <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="code" type="text" id="code"
                value="{{ old('code', optional($template)->code) }}" minlength="1" required="true"
                placeholder="Enter code here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('is_active') ? 'has-error' : '' }}">
        <label for="is_active" class="col-md-4 control-label">{{ __('setting.IsActive') }}</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="is_active_1">
                    <input id="is_active_1" class="" name="is_active" type="checkbox" value="1"
                        {{ old('is_active', optional($template)->is_active) == '1' ? 'checked' : '' }}>
                    {{ __('setting.Yes') }}
                </label>
            </div>
        </div>
    </div>
</div>
<script>
    // function to accept only alephbet and space even in copy pase
    function process(input) {
        let value = input.value;
        let text = value.replace(/[^A-Z,a-z ]/g, "");
        input.value = text;
    }

</script>