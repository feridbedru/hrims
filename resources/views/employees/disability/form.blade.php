<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('type') ? 'has-error' : '' }}">
        <label for="type" class="col-md-4 control-label">Disability Type</label>
        <div class="col-md-12">
            <select class="form-control" id="type" name="type" required="true">
                <option value="" style="display: none;"
                    {{ old('type', optional($employeeDisability)->type ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select disability type</option>
                @foreach ($disabilityTypes as $key => $disabilityType)
                    <option value="{{ $key }}"
                        {{ old('type', optional($employeeDisability)->type) == $key ? 'selected' : '' }}>
                        {{ $disabilityType }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('medical_certificate') ? 'has-error' : '' }}">
        <label for="medical_certificate" class="col-md-4 control-label">Medical Certificate</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="medical_certificate" id="medical_certificate" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeDisability->medical_certificate) && !empty($employeeDisability->medical_certificate))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_medical_certificate" class="custom-delete-file"
                            value="1" {{ old('custom_delete_medical_certificate', '0') == '1' ? 'checked' : '' }}>
                        Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeDisability->medical_certificate }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">Description</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000">{{ old('description', optional($employeeDisability)->description) }}</textarea>
    </div>
</div>

<div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
    <label for="employee" class="col-md-2 control-label">Employee</label>
    <div class="col-md-10">
        <select class="form-control" id="employee" name="employee" required="true">
            <option value="" style="display: none;"
                {{ old('employee', optional($employeeDisability)->employee ?: '') == '' ? 'selected' : '' }} disabled
                selected>Select employee</option>
            @foreach ($employees as $key => $employee)
                <option value="{{ $key }}"
                    {{ old('employee', optional($employeeDisability)->employee) == $key ? 'selected' : '' }}>
                    {{ $employee }}
                </option>
            @endforeach
        </select>
    </div>
</div>
