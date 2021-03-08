<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('occured_on') ? 'has-error' : '' }}">
        <label for="occured_on" class="col-md-4 control-label">Occured On</label>
        <div class="col-md-12">
            <input class="form-control" name="occured_on" type="date" id="occured_on"
                value="{{ old('occured_on', optional($employeeDisaster)->occured_on) }}" required="true"
                placeholder="Enter occured on here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('cause') ? 'has-error' : '' }}">
        <label for="cause" class="col-md-4 control-label">Disaster Cause</label>
        <div class="col-md-12">
            <select class="form-control" id="cause" name="cause" required="true">
                <option value="" style="display: none;"
                    {{ old('cause', optional($employeeDisaster)->cause ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select disaster cause</option>
                @foreach ($disasterCauses as $key => $disasterCause)
                    <option value="{{ $key }}"
                        {{ old('cause', optional($employeeDisaster)->cause) == $key ? 'selected' : '' }}>
                        {{ $disasterCause }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('severity') ? 'has-error' : '' }}">
        <label for="severity" class="col-md-4 control-label">Disaster Severity</label>
        <div class="col-md-12">
            <select class="form-control" id="severity" name="severity" required="true">
                <option value="" style="display: none;"
                    {{ old('severity', optional($employeeDisaster)->severity ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select disaster severity</option>
                @foreach ($disasterSeverities as $key => $disasterSeverity)
                    <option value="{{ $key }}"
                        {{ old('severity', optional($employeeDisaster)->severity) == $key ? 'selected' : '' }}>
                        {{ $disasterSeverity }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">Description</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000"
            required="true">{{ old('description', optional($employeeDisaster)->description) }}</textarea>
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

            @if (isset($employeeDisaster->attachment) && !empty($employeeDisaster->attachment))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_attachment" class="custom-delete-file" value="1"
                            {{ old('custom_delete_attachment', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeDisaster->attachment }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('is_mass') ? 'has-error' : '' }}">
        <label for="is_mass" class="col-md-4 control-label">Is Mass</label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="is_mass_1">
                    <input id="is_mass_1" class="" name="is_mass" type="checkbox" value="1"
                        {{ old('is_mass', optional($employeeDisaster)->is_mass) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>
        </div>
    </div>
</div>
