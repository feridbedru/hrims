<input class="form-control" name="disaster" type="text" id="disaster" value="{{ old('disaster', $employeeDisaster) }}"
    hidden>
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">{{ __('setting.Title') }}</label>
    <div class="col-md-12">
        <input class="form-control" name="title" type="text" id="title"
            value="{{ old('title', optional($employeeDisasterIndeminity)->title) }}" minlength="1" maxlength="255"
            required="true" placeholder="{{ __('employee.Enter title here') }}">
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">{{ __('setting.Description') }}</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000"
            required="true">{{ old('description', optional($employeeDisasterIndeminity)->description) }}</textarea>
    </div>
</div>

<div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
    <label for="cost" class="col-md-4 control-label">{{ __('employee.Cost') }}</label>
    <div class="col-md-12">
        <input class="form-control" name="cost" type="text" id="cost"
            value="{{ old('cost', optional($employeeDisasterIndeminity)->cost) }}" minlength="1"
            placeholder="{{ __('employee.Enter cost here') }}">
    </div>
</div>

<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
    <label for="file" class="col-md-4 control-label">{{ __('employee.File') }}</label>
    <div class="col-md-12">
        <div class="input-group uploaded-file-group">
            <label class="input-group-btn">
                <span class="btn btn-default">
                    {{ __('employee.Browse') }} <input type="file" name="file" id="file" class="hidden">
                </span>
            </label>
            <input type="text" class="form-control uploaded-file-name" readonly>
        </div>

        @if (isset($employeeDisasterIndeminity->file) && !empty($employeeDisasterIndeminity->file))
            <div class="input-group input-width-input">
                <span class="input-group-addon">
                    <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1"
                        {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}>
                    {{ __('setting.delete') }}
                </span>

                <span class="input-group-addon custom-delete-file-name">
                    {{ $employeeDisasterIndeminity->file }}
                </span>
            </div>
        @endif
    </div>
</div>
