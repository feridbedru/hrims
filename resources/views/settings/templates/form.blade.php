<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-4 control-label">Title</label>
    <div class="col-md-12">
        <input class="form-control" name="title" type="text" id="title"
            value="{{ old('title', optional($template)->title) }}" minlength="1" maxlength="255" required="true"
            placeholder="Enter title here...">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
    <label for="body" class="col-md-4 control-label">Body</label>
    <div class="col-md-12">
        <textarea class="form-control" name="body" cols="50" rows="10" id="body" minlength="1" required="true"
            placeholder="Enter body here...">{{ old('body', optional($template)->body) }}</textarea>
        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('language') ? 'has-error' : '' }}">
        <label for="language" class="col-md-4 control-label">Language</label>
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
            {!! $errors->first('language', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('template_type') ? 'has-error' : '' }}">
        <label for="template_type" class="col-md-4 control-label">Template Type</label>
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

            {!! $errors->first('template_type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('code') ? 'has-error' : '' }}">
        <label for="code" class="col-md-4 control-label">Code</label>
        <div class="col-md-12">
            <input class="form-control" name="code" type="text" id="code"
                value="{{ old('code', optional($template)->code) }}" minlength="1" required="true"
                placeholder="Enter code here...">
            {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('is_active') ? 'has-error' : '' }}">
        <label for="is_active" class="col-md-4 control-label">Is Active</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="is_active_1">
                    <input id="is_active_1" class="" name="is_active" type="checkbox" value="1"
                        {{ old('is_active', optional($template)->is_active) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
