<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('level') ? 'has-error' : '' }}">
        <label for="level" class="col-md-4 control-label">Level</label>
        <div class="col-md-12">
            <select class="form-control" id="level" name="level" required="true">
                <option value="" style="display: none;"
                    {{ old('level', optional($employeeEducation)->level ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select education level</option>
                @foreach ($educationLevels as $key => $educationLevel)
                    <option value="{{ $key }}"
                        {{ old('level', optional($employeeEducation)->level) == $key ? 'selected' : '' }}>
                        {{ $educationLevel }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('level', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('institute') ? 'has-error' : '' }}">
        <label for="institute" class="col-md-4 control-label">Institute</label>
        <div class="col-md-12">
            <select class="form-control" id="institute" name="institute" required="true">
                <option value="" style="display: none;"
                    {{ old('institute', optional($employeeEducation)->institute ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select educational institute</option>
                @foreach ($educationalInstitutes as $key => $educationalInstitute)
                    <option value="{{ $key }}"
                        {{ old('institute', optional($employeeEducation)->institute) == $key ? 'selected' : '' }}>
                        {{ $educationalInstitute }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('institute', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('field') ? 'has-error' : '' }}">
        <label for="field" class="col-md-4 control-label">Field</label>
        <div class="col-md-12">
            <select class="form-control" id="field" name="field" required="true">
                <option value="" style="display: none;"
                    {{ old('field', optional($employeeEducation)->field ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select educational field</option>
                @foreach ($educationalFields as $key => $educationalField)
                    <option value="{{ $key }}"
                        {{ old('field', optional($employeeEducation)->field) == $key ? 'selected' : '' }}>
                        {{ $educationalField }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('field', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('gpa_scale') ? 'has-error' : '' }}">
        <label for="gpa_scale" class="col-md-4 control-label">GPA Scale</label>
        <div class="col-md-12">
            <select class="form-control" id="gpa_scale" name="gpa_scale" required="true">
                <option value="" style="display: none;"
                    {{ old('gpa_scale', optional($employeeEducation)->gpa_scale ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select gpa scale</option>
                @foreach ($gpaScales as $key => $gpaScale)
                    <option value="{{ $key }}"
                        {{ old('gpa_scale', optional($employeeEducation)->gpa_scale) == $key ? 'selected' : '' }}>
                        {{ $gpaScale }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('gpa_scale', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('gpa') ? 'has-error' : '' }}">
        <label for="gpa" class="col-md-4 control-label">GPA</label>
        <div class="col-md-12">
            <input class="form-control" name="gpa" type="text" id="gpa"
                value="{{ old('gpa', optional($employeeEducation)->gpa) }}" minlength="1" required="true"
                placeholder="Enter gpa here...">
            {!! $errors->first('gpa', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('start_date') ? 'has-error' : '' }}">
        <label for="start_date" class="col-md-4 control-label">Start Date</label>
        <div class="col-md-12">
            <input class="form-control" name="start_date" type="date" id="start_date"
                value="{{ old('start_date', optional($employeeEducation)->start_date) }}">
            {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('end_date') ? 'has-error' : '' }}">
        <label for="end_date" class="col-md-4 control-label">End Date</label>
        <div class="col-md-12">
            <input class="form-control" name="end_date" type="date" id="end_date"
                value="{{ old('end_date', optional($employeeEducation)->end_date) }}">
            {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('file') ? 'has-error' : '' }}">
        <label for="file" class="col-md-4 control-label">File</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="file" id="file" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>
            @if (isset($employeeEducation->file) && !empty($employeeEducation->file))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1"
                            {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>
                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeEducation->file }}
                    </span>
                </div>
            @endif
            {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('has_coc') ? 'has-error' : '' }}">
        <label for="has_coc" class="col-md-4 control-label">Has COC</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="has_coc_1">
                    <input id="has_coc_1" class="" name="has_coc" type="checkbox" value="1"
                        {{ old('has_coc', optional($employeeEducation)->has_coc) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>
            {!! $errors->first('has_coc', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('coc_issued_date') ? 'has-error' : '' }}">
        <label for="coc_issued_date" class="col-md-4 control-label">COC Issued Date</label>
        <div class="col-md-12">
            <input class="form-control" name="coc_issued_date" type="text" id="coc_issued_date"
                value="{{ old('coc_issued_date', optional($employeeEducation)->coc_issued_date) }}"
                placeholder="Enter coc issued date here...">
            {!! $errors->first('coc_issued_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('coc_file') ? 'has-error' : '' }}">
        <label for="coc_file" class="col-md-4 control-label">COC File</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="coc_file" id="coc_file" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>
            @if (isset($employeeEducation->coc_file) && !empty($employeeEducation->coc_file))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_coc_file" class="custom-delete-file" value="1"
                            {{ old('custom_delete_coc_file', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>
                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeEducation->coc_file }}
                    </span>
                </div>
            @endif
            {!! $errors->first('coc_file', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
    <label for="employee" class="col-md-2 control-label">Employee</label>
    <div class="col-md-10">
        <select class="form-control" id="employee" name="employee" required="true">
            <option value="" style="display: none;"
                {{ old('employee', optional($employeeEducation)->employee ?: '') == '' ? 'selected' : '' }} disabled
                selected>Select employee</option>
            @foreach ($employees as $key => $employee)
                <option value="{{ $key }}"
                    {{ old('employee', optional($employeeEducation)->employee) == $key ? 'selected' : '' }}>
                    {{ $employee }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('employee', '<p class="help-block">:message</p>') !!}
    </div>
</div>