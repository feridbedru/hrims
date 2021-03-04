<div class="form-group {{ $errors->has('disaster') ? 'has-error' : '' }}">
    <label for="disaster" class="col-md-2 control-label">Employee Disaster</label>
    <div class="col-md-10">
        <select class="form-control" id="disaster" name="disaster" required="true">
            <option value="" style="display: none;"
                {{ old('disaster', optional($employeeDisasterWitness)->disaster ?: '') == '' ? 'selected' : '' }}
                disabled selected>Select employee disaster</option>
            @foreach ($employeeDisasters as $key => $employeeDisaster)
                <option value="{{ $key }}"
                    {{ old('disaster', optional($employeeDisasterWitness)->disaster) == $key ? 'selected' : '' }}>
                    {{ $employeeDisaster }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($employeeDisasterWitness)->name) }}" minlength="1" maxlength="255"
                required="true" placeholder="Enter name here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('phone') ? 'has-error' : '' }}">
        <label for="phone" class="col-md-4 control-label">Phone</label>
        <div class="col-md-12">
            <input class="form-control" name="phone" type="text" id="phone"
                value="{{ old('phone', optional($employeeDisasterWitness)->phone) }}" minlength="1"
                placeholder="Enter phone here...">
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

            @if (isset($employeeDisasterWitness->file) && !empty($employeeDisasterWitness->file))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1"
                            {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeDisasterWitness->file }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
