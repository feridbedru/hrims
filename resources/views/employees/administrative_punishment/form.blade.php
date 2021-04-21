<h6 class="ml-2">{{(__('setting.requiredField'))}} <span class="text-danger">*</span></h6>
<hr>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('organization_name') ? 'has-error' : '' }}">
        <label for="organization_name" class="col-md-12 control-label">{{(__('employee.Organization Name'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="organization_name" type="text" oninput="process(this)" id="organization_name"
                value="{{ old('organization_name', optional($employeeAdministrativePunishment)->organization_name) }}"
                minlength="1" required="true" placeholder="{{(__('employee.Enter organization name here'))}}">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('decision') ? 'has-error' : '' }}">
        <label for="decision" class="col-md-12 control-label">{{(__('employee.Decision'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="decision" type="text" id="decision"
                value="{{ old('decision', optional($employeeAdministrativePunishment)->decision) }}" minlength="1"
                required="true" placeholder="{{(__('employee.Enter decision here'))}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('reason') ? 'has-error' : '' }}">
        <label for="reason" class="col-md-12 control-label">{{(__('employee.Reason'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="reason" type="text" id="reason"
                value="{{ old('reason', optional($employeeAdministrativePunishment)->reason) }}" minlength="1"
                required="true" placeholder="{{(__('employee.Enter reason here'))}}">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('file') ? 'has-error' : '' }}">
        <label for="file" class="col-md-12 control-label">{{(__('employee.File'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        {{(__('employee.{{(__('employee.Browse'))}}'))}} <input type="file" name="file" id="file" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeAdministrativePunishment->file) && !empty($employeeAdministrativePunishment->file))
                <div class="input-group input-width-input">
                    <span class="input-group-addon mr-2">
                        <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1"
                            {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> {{(__('setting.delete'))}}
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeAdministrativePunishment->file }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('start_date') ? 'has-error' : '' }}">
        <label for="start_date" class="col-md-12 control-label">{{(__('employee.Start Date'))}}</label>
        <div class="col-md-12">
            <input class="form-control" name="start_date" type="date" id="start_date"
                value="{{ old('start_date', optional($employeeAdministrativePunishment)->start_date) }}">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('end_date') ? 'has-error' : '' }}">
        <label for="end_date" class="col-md-12 control-label">{{(__('employee.End Date'))}}</label>
        <div class="col-md-12">
            <input class="form-control" name="end_date" type="date" id="end_date"
                value="{{ old('end_date', optional($employeeAdministrativePunishment)->end_date) }}">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('status') ? 'has-error' : '' }}">
        <label for="status" class="col-md-12 control-label">{{(__('employee.Status'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="status" name="status" required="true">
                <option value="" style="display: none;"
                    {{ old('status', optional($employeeAdministrativePunishment)->status ?: '') == '' ? 'selected' : '' }}
                    disabled selected>
                    {{(__('employee.Select status'))}}</option>

                <option value="1"
                    {{ old('status', optional($employeeAdministrativePunishment)->status) == 1 ? 'selected' : '' }}>
                    {{(__('employee.Active'))}}
                </option>
                <option value="2"
                    {{ old('status', optional($employeeAdministrativePunishment)->status) == 0 ? 'selected' : '' }}>
                    {{(__('employee.Closed'))}}
                </option>
            </select>
        </div>
    </div>
</div>
