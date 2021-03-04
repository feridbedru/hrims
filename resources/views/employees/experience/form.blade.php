<div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
    <label for="employee" class="col-md-2 control-label">Employee</label>
    <div class="col-md-10">
        <select class="form-control" id="employee" name="employee" required="true">
            <option value="" style="display: none;"
                {{ old('employee', optional($employeeExperience)->employee ?: '') == '' ? 'selected' : '' }} disabled
                selected>Select employee</option>
            @foreach ($employees as $key => $employee)
                <option value="{{ $key }}"
                    {{ old('employee', optional($employeeExperience)->employee) == $key ? 'selected' : '' }}>
                    {{ $employee }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('type') ? 'has-error' : '' }}">
        <label for="type" class="col-md-4 control-label">Experience Type</label>
        <div class="col-md-12">
            <select class="form-control" id="type" name="type" required="true">
                <option value="" style="display: none;"
                    {{ old('type', optional($employeeExperience)->type ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select experience type</option>
                @foreach ($experienceTypes as $key => $experienceType)
                    <option value="{{ $key }}"
                        {{ old('type', optional($employeeExperience)->type) == $key ? 'selected' : '' }}>
                        {{ $experienceType }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Organization Name</label>
        <div class="col-md-12">
            <input class="form-control" name="organization_name" type="text" id="organization_name"
                value="{{ old('name', optional($employeeExperience)->name) }}" minlength="1" required="true"
                placeholder="Enter organization name here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('address') ? 'has-error' : '' }}">
        <label for="address" class="col-md-6 control-label">Organization Address</label>
        <div class="col-md-12">
            <input class="form-control" name="address" type="text" id="address"
                value="{{ old('address', optional($employeeExperience)->address) }}" minlength="1"
                placeholder="Enter organization address here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('job_position') ? 'has-error' : '' }}">
        <label for="job_position" class="col-md-4 control-label">Job Position</label>
        <div class="col-md-12">
            <input class="form-control" name="job_position" type="text" id="job_position"
                value="{{ old('job_position', optional($employeeExperience)->job_position) }}" minlength="1"
                required="true" placeholder="Enter job position here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('level') ? 'has-error' : '' }}">
        <label for="level" class="col-md-4 control-label">Level</label>
        <div class="col-md-12">
            <input class="form-control" name="level" type="text" id="level"
                value="{{ old('level', optional($employeeExperience)->level) }}" minlength="1" required="true"
                placeholder="Enter level here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('salary') ? 'has-error' : '' }}">
        <label for="salary" class="col-md-4 control-label">Salary</label>
        <div class="col-md-12">
            <input class="form-control" name="salary" type="text" id="salary"
                value="{{ old('salary', optional($employeeExperience)->salary) }}" minlength="1" required="true"
                placeholder="Enter salary here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('left_reason_id') ? 'has-error' : '' }}">
        <label for="left_reason_id" class="col-md-4 control-label">Left Reason</label>
        <div class="col-md-12">
            <select class="form-control" id="left_reason" name="left_reason" required="true">
                <option value="" style="display: none;"
                    {{ old('left_reason_id', optional($employeeExperience)->left_reason_id ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select left reason</option>
                @foreach ($leftReasons as $key => $leftReason)
                    <option value="{{ $key }}"
                        {{ old('left_reason_id', optional($employeeExperience)->left_reason_id) == $key ? 'selected' : '' }}>
                        {{ $leftReason }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4  {{ $errors->has('start_date') ? 'has-error' : '' }}">
        <label for="start_date" class="col-md-4 control-label">Start Date</label>
        <div class="col-md-12">
            <input class="form-control" name="start_date" type="date" id="start_date"
                value="{{ old('start_date', optional($employeeExperience)->start_date) }}" required="true"
                placeholder="Enter start date here...">
            {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('end_date') ? 'has-error' : '' }}">
        <label for="end_date" class="col-md-4 control-label">End Date</label>
        <div class="col-md-12">
            <input class="form-control" name="end_date" type="date" id="end_date"
                value="{{ old('end_date', optional($employeeExperience)->end_date) }}"
                placeholder="Enter end date here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('attachment') ? 'has-error' : '' }}">
        <label for="attachment" class="col-md-4 control-label">Attachment</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="attachment" id="attachment" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeExperience->attachment) && !empty($employeeExperience->attachment))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_attachment" class="custom-delete-file" value="1"
                            {{ old('custom_delete_attachment', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeExperience->attachment }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
