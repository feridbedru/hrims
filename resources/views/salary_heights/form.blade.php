<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('salary_scale') ? 'has-error' : '' }}">
        <label for="salary_scale" class="col-md-4 control-label">Salary Scale</label>
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

            {!! $errors->first('salary_scale', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('level') ? 'has-error' : '' }}">
        <label for="level" class="col-md-4 control-label">Level</label>
        <div class="col-md-12">
            <input class="form-control" name="level" type="text" id="level"
                value="{{ old('level', optional($salaryHeight)->level) }}" minlength="1" required="true"
                placeholder="Enter level here...">
            {!! $errors->first('level', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('initial_salary') ? 'has-error' : '' }}">
        <label for="initial_salary" class="col-md-4 control-label">Initial Salary</label>
        <div class="col-md-12">
            <input class="form-control" name="initial_salary" type="text" id="initial_salary"
                value="{{ old('initial_salary', optional($salaryHeight)->initial_salary) }}" minlength="1"
                required="true" placeholder="Enter initial salary here...">
            {!! $errors->first('initial_salary', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('maximum_salary') ? 'has-error' : '' }}">
        <label for="maximum_salary" class="col-md-4 control-label">Maximum Salary</label>
        <div class="col-md-12">
            <input class="form-control" name="maximum_salary" type="text" id="maximum_salary"
                value="{{ old('maximum_salary', optional($salaryHeight)->maximum_salary) }}" minlength="1"
                required="true" placeholder="Enter maximum salary here...">
            {!! $errors->first('maximum_salary', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
