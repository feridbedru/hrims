<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-2 control-label">Name</label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($salaryScale)->name) }}" minlength="1" maxlength="255" required="true"
                placeholder="Enter name here...">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('description') ? 'has-error' : '' }}">
        <label for="description" class="col-md-2 control-label">Description</label>
        <div class="col-md-12">
            <input class="form-control" name="description" type="text" id="description"
                value="{{ old('description', optional($salaryScale)->description) }}" minlength="1" maxlength="255"
                required="true">
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-2 {{ $errors->has('is_enabled') ? 'has-error' : '' }}">
        <label for="is_enabled" class="col-md-6 control-label">Is Enabled</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="is_enabled_1">
                    <input id="is_enabled_1" class="" name="is_enabled" type="checkbox" value="1"
                        {{ old('is_enabled', optional($salaryScale)->is_enabled) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>
            {!! $errors->first('is_enabled', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
<div class="form-group col-md-4 {{ $errors->has('job_category') ? 'has-error' : '' }}">
    <label for="job_category" class="col-md-4 control-label">Job Category</label>
    <div class="col-md-12">
        <select class="form-control" id="job_category" name="job_category" required="true">
            <option value="" style="display: none;"
                {{ old('job_category', optional($salaryScale)->job_category ?: '') == '' ? 'selected' : '' }} disabled
                selected>Select job category</option>
            @foreach ($jobCategories as $key => $jobCategory)
                <option value="{{ $key }}"
                    {{ old('job_category', optional($salaryScale)->job_category) == $key ? 'selected' : '' }}>
                    {{ $jobCategory }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('job_category', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('stair_height') ? 'has-error' : '' }}">
    <label for="stair_height" class="col-md-6 control-label">Stair Height</label>
    <div class="col-md-12">
        <input class="form-control" name="stair_height" type="text" id="stair_height"
            value="{{ old('stair_height', optional($salaryScale)->stair_height) }}" minlength="1" required="true"
            placeholder="Enter stair height here...">
        {!! $errors->first('stair_height', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('salary_steps') ? 'has-error' : '' }}">
    <label for="salary_steps" class="col-md-6 control-label">Salary Steps</label>
    <div class="col-md-12">
        <input class="form-control" name="salary_steps" type="text" id="salary_steps"
            value="{{ old('salary_steps', optional($salaryScale)->salary_steps) }}" minlength="1" required="true"
            placeholder="Enter salary steps here...">
        {!! $errors->first('salary_steps', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
