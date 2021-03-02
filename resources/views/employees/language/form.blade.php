<div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
    <label for="employee" class="col-md-2 control-label">Employee</label>
    <div class="col-md-10">
        <select class="form-control" id="employee" name="employee" required="true">
            <option value="" style="display: none;"
                {{ old('employee', optional($employeeLanguage)->employee ?: '') == '' ? 'selected' : '' }} disabled
                selected>Select employee</option>
            @foreach ($employees as $key => $employee)
                <option value="{{ $key }}"
                    {{ old('employee', optional($employeeLanguage)->employee) == $key ? 'selected' : '' }}>
                    {{ $employee }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('employee', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('language') ? 'has-error' : '' }}">
        <label for="language" class="col-md-4 control-label">Language</label>
        <div class="col-md-12">
            <select class="form-control" id="language" name="language" required="true">
                <option value="" style="display: none;"
                    {{ old('language', optional($employeeLanguage)->language ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Enter language here...</option>
                @foreach ($languages as $key => $language)
                    <option value="{{ $key }}"
                        {{ old('language', optional($employeeLanguage)->language) == $key ? 'selected' : '' }}>
                        {{ $language }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('language', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('reading') ? 'has-error' : '' }}">
        <label for="reading" class="col-md-4 control-label">Reading</label>
        <div class="col-md-12">
            <select class="form-control" id="reading" name="reading" required="true">
                <option value="" style="display: none;"
                    {{ old('reading', optional($employeeLanguage)->reading ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Enter Reading level here...</option>
                @foreach ($languageLevels as $key => $languageLevel)
                    <option value="{{ $key }}"
                        {{ old('reading', optional($employeeLanguage)->reading) == $key ? 'selected' : '' }}>
                        {{ $languageLevel }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('reading', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('writing') ? 'has-error' : '' }}">
        <label for="writing" class="col-md-4 control-label">Writing</label>
        <div class="col-md-12">
            <select class="form-control" id="writing" name="writing" required="true">
                <option value="" style="display: none;"
                    {{ old('writing', optional($employeeLanguage)->writing ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Enter Writing level here...</option>
                @foreach ($languageLevels as $key => $languageLevel)
                    <option value="{{ $key }}"
                        {{ old('writing', optional($employeeLanguage)->writing) == $key ? 'selected' : '' }}>
                        {{ $languageLevel }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('writing', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('listening') ? 'has-error' : '' }}">
        <label for="listening" class="col-md-4 control-label">Listening</label>
        <div class="col-md-12">
            <select class="form-control" id="listening" name="listening" required="true">
                <option value="" style="display: none;"
                    {{ old('listening', optional($employeeLanguage)->listening ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Enter Listening level here...</option>
                @foreach ($languageLevels as $key => $languageLevel)
                    <option value="{{ $key }}"
                        {{ old('listening', optional($employeeLanguage)->listening) == $key ? 'selected' : '' }}>
                        {{ $languageLevel }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('listening', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('speaking') ? 'has-error' : '' }}">
        <label for="speaking" class="col-md-4 control-label">Speaking</label>
        <div class="col-md-12">
            <select class="form-control" id="speaking" name="speaking" required="true">
                <option value="" style="display: none;"
                    {{ old('speaking', optional($employeeLanguage)->speaking ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Enter Speaking level here...</option>
                @foreach ($languageLevels as $key => $languageLevel)
                    <option value="{{ $key }}"
                        {{ old('speaking', optional($employeeLanguage)->speaking) == $key ? 'selected' : '' }}>
                        {{ $languageLevel }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('speaking', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('is_prefered') ? 'has-error' : '' }}">
        <label for="is_prefered" class="col-md-4 control-label">Is Prefered</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="is_prefered_1">
                    <input id="is_prefered_1" class="" name="is_prefered" type="checkbox" value="1"
                        {{ old('is_prefered', optional($employeeLanguage)->is_prefered) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>
            {!! $errors->first('is_prefered', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
