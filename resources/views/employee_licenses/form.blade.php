<div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
    <label for="employee" class="col-md-2 control-label">Employee</label>
    <div class="col-md-10">
        <select class="form-control" id="employee" name="employee" required="true">
            <option value="" style="display: none;"
                {{ old('employee', optional($employeeLicense)->employee ?: '') == '' ? 'selected' : '' }} disabled
                selected>Select employee</option>
            @foreach ($employees as $key => $employee)
                <option value="{{ $key }}"
                    {{ old('employee', optional($employeeLicense)->employee) == $key ? 'selected' : '' }}>
                    {{ $employee }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('employee', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('title') ? 'has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">Title</label>
        <div class="col-md-12">
            <input class="form-control" name="title" type="text" id="title"
                value="{{ old('title', optional($employeeLicense)->title) }}" minlength="1" maxlength="255"
                required="true" placeholder="Enter title here...">
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('type') ? 'has-error' : '' }}">
        <label for="type" class="col-md-4 control-label">License Type</label>
        <div class="col-md-12">
            <select class="form-control" id="type" name="type" required="true">
                <option value="" style="display: none;"
                    {{ old('type', optional($employeeLicense)->type ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select license type</option>
                @foreach ($licenseTypes as $key => $licenseType)
                    <option value="{{ $key }}"
                        {{ old('type', optional($employeeLicense)->type) == $key ? 'selected' : '' }}>
                        {{ $licenseType }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('issuing_organization') ? 'has-error' : '' }}">
        <label for="issuing_organization" class="col-md-6 control-label">Issuing Organization</label>
        <div class="col-md-12">
            <input class="form-control" name="issuing_organization" type="text" id="issuing_organization"
                value="{{ old('issuing_organization', optional($employeeLicense)->issuing_organization) }}"
                minlength="1" required="true" placeholder="Enter issuing organization here...">
            {!! $errors->first('issuing_organization', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('expiry_date') ? 'has-error' : '' }}">
        <label for="expiry_date" class="col-md-4 control-label">Expiry Date</label>
        <div class="col-md-12">
            <input class="form-control" name="expiry_date" type="date" id="expiry_date"
                value="{{ old('expiry_date', optional($employeeLicense)->expiry_date) }}"
                placeholder="Enter expiry date here...">
            {!! $errors->first('expiry_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('file') ? 'has-error' : '' }}">
        <label for="file" class="col-md-4 control-label">File</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="file" id="file" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeLicense->file) && !empty($employeeLicense->file))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1"
                            {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeLicense->file }}
                    </span>
                </div>
            @endif
            {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
