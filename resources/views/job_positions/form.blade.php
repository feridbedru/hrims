
<div class="row">
    <div class="form-group col-md-8 {{ $errors->has('organization_unit') ? 'has-error' : '' }}">
        <label for="organization_unit" class="col-md-2 control-label">Organization Unit</label>
        <div class="col-md-12">
            <select class="form-control " id="organization_unit" name="organization_unit" required="true">
                <option value="" style="display: none;"
                    {{ old('organization_unit', optional($jobPosition)->organization_unit ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select organization unit</option>
                @foreach ($organizationUnits as $key => $organizationUnit)
                    <option value="{{ $key }}"
                        {{ old('organization_unit', optional($jobPosition)->organization_unit) == $key ? 'selected' : '' }}>
                        {{ $organizationUnit }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('organization_unit', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group col-md-4{{ $errors->has('status') ? 'has-error' : '' }}">
        <label for="status" class="col-md-4 control-label">Is Available</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="status_1">
                    <input id="status_1" class="" name="status" type="checkbox" value="1"
                        {{ old('status', optional($jobPosition)->status) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('job_title_category') ? 'has-error' : '' }}">
        <label for="job_title_category" class="col-md-6 ">Job Title Category</label>
        <div class="col-md-12">
            <select class="form-control" id="job_title_category" name="job_title_category" required="true">
                <option value="" style="display: none;"
                    {{ old('job_title_category', optional($jobPosition)->job_title_category ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select job title category</option>
                @foreach ($jobTitleCategories as $key => $jobTitleCategory)
                    <option value="{{ $key }}"
                        {{ old('job_title_category', optional($jobPosition)->job_title_category) == $key ? 'selected' : '' }}>
                        {{ $jobTitleCategory }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('job_title_category', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('job_category') ? 'has-error' : '' }}">
        <label for="job_category" class="col-md-6 control-label">Job Category</label>
        <div class="col-md-12">
            <select class="form-control" id="job_category" name="job_category" required="true">
                <option value="" style="display: none;"
                    {{ old('job_category', optional($jobPosition)->job_category ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select job category</option>
                @foreach ($jobCategories as $key => $jobCategory)
                    <option value="{{ $key }}"
                        {{ old('job_category', optional($jobPosition)->job_category) == $key ? 'selected' : '' }}>
                        {{ $jobCategory }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('job_category', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('job_type') ? 'has-error' : '' }}">
        <label for="job_type" class="col-md-4 control-label">Job Type</label>
        <div class="col-md-12">
            <select class="form-control" id="job_type" name="job_type" required="true">
                <option value="" style="display: none;"
                    {{ old('job_type', optional($jobPosition)->job_type ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select job type</option>
                @foreach ($jobTypes as $key => $jobType)
                    <option value="{{ $key }}"
                        {{ old('job_type', optional($jobPosition)->job_type) == $key ? 'selected' : '' }}>
                        {{ $jobType }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('job_type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('job_description') ? 'has-error' : '' }}">
    <label for="job_description" class="col-md-2 control-label">Job Description</label>
    <div class="col-md-12">
        <textarea class="form-control" name="job_description" cols="50" rows="10" id="job_description" minlength="1"
            placeholder="Enter job description here...">{{ old('job_description', optional($jobPosition)->job_description) }}</textarea>
        {!! $errors->first('job_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('position_code') ? 'has-error' : '' }}">
        <label for="position_code" class="col-md-4 control-label">Position Code</label>
        <div class="col-md-12">
            <input class="form-control" name="position_code" type="text" id="position_code"
                value="{{ old('position_code', optional($jobPosition)->position_code) }}" minlength="1"
                placeholder="Enter position code here...">
            {!! $errors->first('position_code', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('position_id') ? 'has-error' : '' }}">
        <label for="position_id" class="col-md-4 control-label">Position ID</label>
        <div class="col-md-12">
            <input class="form-control" name="position_id" type="text" id="position_id"
                value="{{ old('position_id', optional($jobPosition)->position_id) }}" minlength="1"
                placeholder="Enter position ID here...">
            {!! $errors->first('position_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('salary') ? 'has-error' : '' }}">
        <label for="salary" class="col-md-4 control-label">Salary</label>
        <div class="col-md-12">
            <select class="form-control" id="salary" name="salary" required="true">
                <option value="" style="display: none;"
                    {{ old('salary', optional($jobPosition)->salary ?: '') == '' ? 'selected' : '' }} disabled
                    selected>
                    Select salary</option>
                @foreach ($salaries as $key => $salary)
                    <option value="{{ $key }}"
                        {{ old('salary', optional($jobPosition)->salary) == $key ? 'selected' : '' }}>
                        {{ $salary }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('salary', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>