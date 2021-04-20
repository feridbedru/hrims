<h6 class="ml-2">{{(__('setting.requiredField'))}}<span class="text-danger">*</span> </h6>
<hr>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-12 control-label">{{(__('setting.Name'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($salaryScale)->name) }}" minlength="1" maxlength="255" required="true"
                placeholder="Enter name here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('description') ? 'has-error' : '' }}">
        <label for="description" class="col-md-12 control-label">{{(__('setting.Description'))}}</label>
        <div class="col-md-12">
            <input class="form-control" name="description" type="text" id="description"
                value="{{ old('description', optional($salaryScale)->description) }}" minlength="1" maxlength="255" required="true">
        </div>
    </div>

    <div class="form-group col-md-2 {{ $errors->has('is_enabled') ? 'has-error' : '' }}">
        <label for="is_enabled" class="col-md-12 control-label">{{(__('setting.Is Enabled'))}}</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="is_enabled_1">
                    <input id="is_enabled_1" class="" name="is_enabled" type="checkbox" value="1"
                        {{ old('is_enabled', optional($salaryScale)->is_enabled) == '1' ? 'checked' : '' }}>
                    {{(__('setting.Yes'))}}
                </label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('job_category') ? 'has-error' : '' }}">
        <label for="job_category" class="col-md-12 control-label">{{(__('setting.JobCategory'))}} <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="job_category" name="job_category" required="true">
                <option value="" style="display: none;"
                    {{ old('job_category', optional($salaryScale)->job_category ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select job category</option>
                @foreach ($jobCategories as $key => $jobCategory)
                    <option value="{{ $key }}"
                        {{ old('job_category', optional($salaryScale)->job_category) == $key ? 'selected' : '' }}>
                        {{ $jobCategory }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('stair_height') ? 'has-error' : '' }}">
        <label for="stair_height" class="col-md-12 control-label">{{(__('setting.Stair Height'))}} <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="stair_height" type="number" id="stair_height"
                value="{{ old('stair_height', optional($salaryScale)->stair_height) }}" minlength="1" required="true"
                placeholder="Enter stair height here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('salary_steps') ? 'has-error' : '' }}">
        <label for="salary_steps" class="col-md-12 control-label">{{(__('setting.Salary Steps'))}} <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="salary_steps" type="number" id="salary_steps"
                value="{{ old('salary_steps', optional($salaryScale)->salary_steps) }}" minlength="1" required="true"
                placeholder="Enter salary steps here...">
        </div>
    </div>
</div>
