<h6 class="ml-2">{{(__('setting.requiredField'))}}<span class="text-danger">*</span> </h6>
<hr>
<div class="row">
    <div class="form-group col-md-8 {{ $errors->has('organization_unit') ? 'has-error' : '' }}">
        <label for="organization_unit" class="col-md-12 control-label">{{(__('setting.OrganizationUnit'))}} <span
                class="text-danger">*</span></label>
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
        </div>
    </div>
    <div class="form-group col-md-4{{ $errors->has('status') ? 'has-error' : '' }}">
        <label for="status" class="col-md-12 control-label">{{(__('setting.IsAvailable'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="status_1">
                    <input id="status_1" class="" name="status" type="checkbox" value="1"
                        {{ old('status', optional($jobPosition)->status) == '1' ? 'checked' : '' }}>
                    {{(__('setting.Yes'))}}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('job_title_category') ? 'has-error' : '' }}">
        <label for="job_title_category" class="col-md-12 ">{{(__('setting.JobTitle'))}} <span class="text-danger">*</span></label>
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
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('job_category') ? 'has-error' : '' }}">
        <label for="job_category" class="col-md-12 control-label">{{(__('setting.JobCategory'))}} <span
                class="text-danger">*</span></label>
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
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('job_type') ? 'has-error' : '' }}">
        <label for="job_type" class="col-md-12 control-label">{{(__('setting.JobType'))}} <span class="text-danger">*</span></label>
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
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('job_description') ? 'has-error' : '' }}">
    <label for="job_description" class="col-md-12 control-label">{{(__('setting.JobDescription'))}}</label>
    <div class="col-md-12">
        <textarea class="form-control" name="job_description" cols="50" rows="10" id="job_description" minlength="1"
            placeholder="Enter job description here...">{{ old('job_description', optional($jobPosition)->job_description) }}</textarea>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('position_code') ? 'has-error' : '' }}">
        <label for="position_code" class="col-md-12 control-label">{{(__('setting.PositionCode '))}} <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="position_code" type="text" id="position_code"
                value="{{ old('position_code', optional($jobPosition)->position_code) }}" minlength="1"
                placeholder="Enter position code here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('position_id') ? 'has-error' : '' }}">
        <label for="position_id" class="col-md-12 control-label">{{(__('setting.PositionID '))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="position_id" type="text" id="position_id"
                value="{{ old('position_id', optional($jobPosition)->position_id) }}" minlength="1"
                placeholder="Enter position ID here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('salary') ? 'has-error' : '' }}">
        <label for="salary" class="col-md-12 control-label">{{(__('setting.Salary'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="salary" name="salary" required="true">
                <option value="" style="display: none;"
                    {{ old('salary', optional($jobPosition)->salary ?: '') == '' ? 'selected' : '' }} disabled
                    selected>
                    {{(__('setting.Select salary'))}}</option>
                @foreach ($salaries as $key => $salary)
                    <option value="{{ $salary }}"
                        {{ old('salary', optional($jobPosition)->salary) == $salary->id ? 'selected' : '' }}>
                        @foreach ($salaryHeights as $salaryHeight)
                            @if ($salary->salary_height == $salaryHeight->id)
                            {{(__('setting.Level'))}} {{ $salaryHeight->level }},
                            @endif
                        @endforeach
                        @foreach ($salarySteps as $salaryStep)
                            @if ($salary->salary_step == $salaryStep->id)
                            {{(__('setting.Step'))}} {{ $salaryStep->step }},
                            @endif
                        @endforeach
                        {{(__('setting.br'))}}. {{ $salary->amount }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
