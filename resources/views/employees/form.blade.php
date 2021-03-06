<div class="row">
    <div class="form-group col-md-2 {{ $errors->has('title') ? 'has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">Title</label>
        <div class="col-md-12">
            <select class="form-control" id="title" name="title">
                <option value="" style="display: none;"
                    {{ old('title', optional($employee)->title ?: '') == '' ? 'selected' : '' }} disabled selected>
                    Select title</option>
                @foreach ($titles as $key => $title)
                    <option value="{{ $key }}"
                        {{ old('title', optional($employee)->title) == $key ? 'selected' : '' }}>
                        {{ $title }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-5 {{ $errors->has('en_name') ? 'has-error' : '' }}">
        <label for="en_name" class="col-md-4 control-label">English Name</label>
        <div class="col-md-12">
            <input class="form-control" name="en_name" type="text" id="en_name"
                value="{{ old('en_name', optional($employee)->en_name) }}" minlength="1"
                placeholder="Enter english name here...">
            {!! $errors->first('en_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-5 {{ $errors->has('am_name') ? 'has-error' : '' }}">
        <label for="am_name" class="col-md-4 control-label">Amharic Name</label>
        <div class="col-md-12">
            <input class="form-control" name="am_name" type="text" id="am_name"
                value="{{ old('am_name', optional($employee)->am_name) }}" minlength="1" required="true"
                placeholder="Enter amharic name here...">
            {!! $errors->first('am_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('sex') ? 'has-error' : '' }}">
        <label for="sex" class="col-md-4 control-label">Sex</label>
        <div class="col-md-12">
            <select class="form-control" id="sex" name="sex" required="true">
                <option value="" style="display: none;"
                    {{ old('sex', optional($employee)->sex ?: '') == '' ? 'selected' : '' }} disabled selected>Select
                    sex</option>
                @foreach ($sexes as $key => $sex)
                    <option value="{{ $key }}"
                        {{ old('sex', optional($employee)->sex) == $key ? 'selected' : '' }}>
                        {{ $sex }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('sex', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('date_of_birth') ? 'has-error' : '' }}">
        <label for="date_of_birth" class="col-md-4 control-label">Date Of Birth</label>
        <div class="col-md-12">
            <input class="form-control" name="date_of_birth" type="date" id="date_of_birth"
                value="{{ old('date_of_birth', optional($employee)->date_of_birth) }}" required="true"
                placeholder="Enter date of birth here...">
            {!! $errors->first('date_of_birth', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('photo') ? 'has-error' : '' }}">
        <label for="photo" class="col-md-4 control-label">Photo</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="photo" id="photo" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employee->photo) && !empty($employee->photo))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_photo" class="custom-delete-file" value="1"
                            {{ old('custom_delete_photo', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>
                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employee->photo }}
                    </span>
                </div>
            @endif
            {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('phone_number') ? 'has-error' : '' }}">
        <label for="phone_number" class="col-md-4 control-label">Phone Number</label>
        <div class="col-md-12">
            <input class="form-control" name="phone_number" type="number" id="phone_number"
                value="{{ old('phone_number', optional($employee)->phone_number) }}"
                placeholder="Enter phone number here...">
            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('organization_unit') ? 'has-error' : '' }}">
        <label for="organization_unit" class="col-md-4 control-label">Organization Unit</label>
        <div class="col-md-12">
            <select class="form-control" id="organization_unit" name="organization_unit" required="true">
                <option value="" style="display: none;"
                    {{ old('organization_unit', optional($employee)->organization_unit ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select organization unit</option>
                @foreach ($organizationUnits as $key => $organizationUnit)
                    <option value="{{ $key }}"
                        {{ old('organization_unit', optional($employee)->organization_unit) == $key ? 'selected' : '' }}>
                        {{ $organizationUnit }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('organization_unit', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    {{-- {{dd($jobPositions)}} --}}
    <div class="form-group col-md-4 {{ $errors->has('job_position') ? 'has-error' : '' }}">
        <label for="job_position" class="col-md-4 control-label">Job Position</label>
        <div class="col-md-12">
            <select class="form-control" id="job_position" name="job_position" required="true">
                <option value="" style="display: none;"
                    {{ old('job_position', optional($employee)->job_position ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select job position</option>
                @foreach ($jobPositions as $key => $jobPosition)
                    <option value="{{ $key }}"
                        {{ old('job_position', optional($employee)->job_position) == $key ? 'selected' : '' }}>
                        {{ $jobPosition }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('job_position', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('employment_id') ? 'has-error' : '' }}">
        <label for="employment_id" class="col-md-4 control-label">Employment ID</label>
        <div class="col-md-12">
            <input class="form-control" name="employment_id" type="text" id="employment_id"
                value="{{ old('employment_id', optional($employee)->employment_id) }}"
                placeholder="Enter employment ID here ...">
            {!! $errors->first('employment_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('status') ? 'has-error' : '' }}">
        <label for="status" class="col-md-4 control-label">Employee Status</label>
        <div class="col-md-12">
            <select class="form-control" id="status" name="status">
                <option value="" style="display: none;"
                    {{ old('status', optional($employee)->status ?: '') == '' ? 'selected' : '' }} disabled selected>
                    Select employee status</option>
                @foreach ($employeeStatuses as $key => $employeeStatus)
                    <option value="{{ $key }}"
                        {{ old('status', optional($employee)->status) == $key ? 'selected' : '' }}>
                        {{ $employeeStatus }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
