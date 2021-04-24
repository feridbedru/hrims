<div class="row">
    <input class="form-control" name="disaster" type="text" id="disaster"
                value="{{ old('disaster', $employeeDisaster) }}" hidden>
    <div class="form-group col-md-12 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-12 control-label">{{(__('setting.Name'))}}</label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($employeeDisasterWitness)->name) }}" minlength="1" maxlength="255"
                required="true" placeholder="{{(__('employee.Enter name here'))}}">
        </div>
    </div>

    <div class="form-group col-md-12 {{ $errors->has('phone') ? 'has-error' : '' }}">
        <label for="phone" class="col-md-12 control-label">{{(__('setting.PhoneNumber'))}}</label>
        <div class="col-md-12">
            <input class="form-control" name="phone" type="text" id="phone"
                value="{{ old('phone', optional($employeeDisasterWitness)->phone) }}" minlength="1"
                placeholder="{{(__('employee.Enter phone number here'))}}">
        </div>
    </div>

    <div class="form-group col-md-12 {{ $errors->has('file') ? 'has-error' : '' }}">
        <label for="file" class="col-md-12 control-label">{{(__('employee.File'))}}</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        {{(__('employee.Browse'))}} <input type="file" name="file" id="file" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeDisasterWitness->file) && !empty($employeeDisasterWitness->file))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_file" class="custom-delete-file mr-2" value="1"
                            {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> {{(__('setting.delete'))}}
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeDisasterWitness->file }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
