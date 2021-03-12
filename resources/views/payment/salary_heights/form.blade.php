<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('salary_scale') ? 'has-error' : '' }}">
        <label for="salary_scale" class="col-md-12 control-label">Salary Scale <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="salary_scale" name="salary_scale" required="true">
                <option value="" style="display: none;"
                    {{ old('salary_scale', optional($salaryHeight)->salary_scale ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select salary scale</option>
                @foreach ($salaryScales as $key => $salaryScale)
                    <option value="{{ $key }}"
                        {{ old('salary_scale', optional($salaryHeight)->salary_scale) == $key ? 'selected' : '' }}>
                        {{ $salaryScale }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('level') ? 'has-error' : '' }}">
        <label for="level" class="col-md-12 control-label">Level <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="level" type="text" id="level"
                value="{{ old('level', optional($salaryHeight)->level) }}" minlength="1" required="true"
                placeholder="Enter level here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('initial_salary') ? 'has-error' : '' }}">
        <label for="initial_salary" class="col-md-12 control-label">Base Salary <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="initial_salary" type="text" id="initial_salary"
                value="{{ old('initial_salary', optional($salaryHeight)->initial_salary) }}" minlength="1"
                required="true" placeholder="Enter initial salary here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('maximum_salary') ? 'has-error' : '' }}">
        <label for="maximum_salary" class="col-md-12 control-label">Maximum Salary <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="maximum_salary" type="text" id="maximum_salary"
                value="{{ old('maximum_salary', optional($salaryHeight)->maximum_salary) }}" minlength="1"
                required="true" placeholder="Enter maximum salary here...">
        </div>
    </div>
</div>
