<div class="form-group {{ $errors->has('disaster') ? 'has-error' : '' }}">
    <label for="disaster" class="col-md-2 control-label">Employee Disaster</label>
    <div class="col-md-10">
        <select class="form-control" id="disaster" name="disaster" required="true">
            <option value="" style="display: none;"
                {{ old('disaster', optional($employeeDisasterIndeminity)->disaster ?: '') == '' ? 'selected' : '' }}
                disabled selected>Select employee disaster</option>
            @foreach ($employeeDisasters as $key => $employeeDisaster)
                <option value="{{ $key }}"
                    {{ old('disaster', optional($employeeDisasterIndeminity)->disaster) == $key ? 'selected' : '' }}>
                    {{ $employeeDisaster }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Title</label>
    <div class="col-md-12">
        <input class="form-control" name="title" type="text" id="title"
            value="{{ old('title', optional($employeeDisasterIndeminity)->title) }}" minlength="1" maxlength="255"
            required="true" placeholder="Enter title here...">
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000"
            required="true">{{ old('description', optional($employeeDisasterIndeminity)->description) }}</textarea>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('cost') ? 'has-error' : '' }}">
        <label for="cost" class="col-md-4 control-label">Cost</label>
        <div class="col-md-12">
            <input class="form-control" name="cost" type="text" id="cost"
                value="{{ old('cost', optional($employeeDisasterIndeminity)->cost) }}" minlength="1"
                placeholder="Enter cost here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('file') ? 'has-error' : '' }}">
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

            @if (isset($employeeDisasterIndeminity->file) && !empty($employeeDisasterIndeminity->file))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1"
                            {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeDisasterIndeminity->file }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>