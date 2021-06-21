<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-12 control-label">{{ __('employee.Name') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($leaveType)->name) }}" minlength="1" maxlength="255"
                placeholder="Enter name here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('job_type_id') ? 'has-error' : '' }}">
        <label for="job_type_id" class="col-md-12 control-label">{{ __('employee.Job Type') }}</label>
        <div class="col-md-12">
            <select class="form-control" id="job_type_id" name="job_type_id" required="true">
                <option value="" style="display: none;"
                    {{ old('job_type_id', optional($leaveType)->job_type_id ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select job type</option>
                @foreach ($jobTypes as $key => $jobType)
                    <option value="{{ $key }}"
                        {{ old('job_type_id', optional($leaveType)->job_type_id) == $key ? 'selected' : '' }}>
                        {{ $jobType }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-12 control-label">{{ __('employee.Description') }}</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000">{{ old('description', optional($leaveType)->description) }}</textarea>
    </div>
</div>


<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('initial') ? 'has-error' : '' }}">
        <label for="initial" class="col-md-12 control-label">{{ __('employee.Initial') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="initial" type="number" id="initial"
                value="{{ old('initial', optional($leaveType)->initial) }}" min="1"
                placeholder="Enter initial here...">

        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('maximum') ? 'has-error' : '' }}">
        <label for="maximum" class="col-md-12 control-label">{{ __('employee.Maximum') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="maximum" type="number" id="maximum"
                value="{{ old('maximum', optional($leaveType)->maximum) }}" min="1"
                placeholder="Enter maximum here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('male') ? 'has-error' : '' }}">
        <label for="male" class="col-md-12 control-label">{{ __('employee.Male') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="male" type="number" id="male"
                value="{{ old('male', optional($leaveType)->male) }}" min="1" placeholder="Enter male here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('female') ? 'has-error' : '' }}">
        <label for="female" class="col-md-12 control-label">{{ __('employee.Female') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="female" type="number" id="female"
                value="{{ old('female', optional($leaveType)->female) }}" min="1" required="true"
                placeholder="Enter female here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('includes_offdays') ? 'has-error' : '' }}">
        <label for="includes_offdays" class="col-md-12 control-label">{{ __('employee.Includes Offdays') }}</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="includes_offdays_1">
                    <input id="includes_offdays_1" class="" name="includes_offdays" type="checkbox" value="1"
                        {{ old('includes_offdays', optional($leaveType)->includes_offdays) == '1' ? 'checked' : '' }}>
                    {{ __('employee.Yes') }}
                </label>
            </div>
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('is_transferable') ? 'has-error' : '' }}">
        <label for="is_transferable" class="col-md-12 control-label">{{ __('employee.Is Transferable') }}</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="is_transferable_1">
                    <input id="is_transferable_1" class="" name="is_transferable" type="checkbox" value="1"
                        {{ old('is_transferable', optional($leaveType)->is_transferable) == '1' ? 'checked' : '' }}>
                    {{ __('employee.Yes') }}
                </label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('pre_post') ? 'has-error' : '' }}">
        <label for="pre_post" class="col-md-12 control-label">{{ __('employee.Pre Post') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="pre_post" type="text" id="pre_post"
                value="{{ old('pre_post', optional($leaveType)->pre_post) }}" minlength="1"
                placeholder="Enter pre post here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('is_active') ? 'has-error' : '' }}">
        <label for="is_active" class="col-md-12 control-label">{{ __('employee.Is Active') }}</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="is_active_1">
                    <input id="is_active_1" class="" name="is_active" type="checkbox" value="1"
                        {{ old('is_active', optional($leaveType)->is_active) == '1' ? 'checked' : '' }}>
                    {{ __('employee.Yes') }}
                </label>
            </div>
        </div>
    </div>
</div>
