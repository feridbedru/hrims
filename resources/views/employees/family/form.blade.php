<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-12 control-label">Name <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($employeeFamily)->name) }}" minlength="1" maxlength="255"
                required="true" placeholder="Enter name here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('sex') ? 'has-error' : '' }}">
        <label for="sex" class="col-md-12 control-label">Sex <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="sex" name="sex" required="true">
                <option value="" style="display: none;"
                    {{ old('sex', optional($employeeFamily)->sex ?: '') == '' ? 'selected' : '' }} disabled selected>
                    Select sex</option>
                @foreach ($sexes as $key => $sex)
                    <option value="{{ $key }}"
                        {{ old('sex', optional($employeeFamily)->sex) == $key ? 'selected' : '' }}>
                        {{ $sex }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('relationship') ? 'has-error' : '' }}">
        <label for="relationship" class="col-md-12 control-label">Relationship <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="relationship" name="relationship" required="true">
                <option value="" style="display: none;"
                    {{ old('relationship', optional($employeeFamily)->relationship ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select relationship</option>
                @foreach ($relationships as $key => $relationship)
                    <option value="{{ $key }}"
                        {{ old('relationship', optional($employeeFamily)->relationship) == $key ? 'selected' : '' }}>
                        {{ $relationship }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('date_of_birth') ? 'has-error' : '' }}">
        <label for="date_of_birth" class="col-md-12 control-label">Date Of Birth <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="date_of_birth" type="date" id="date_of_birth"
                value="{{ old('date_of_birth', optional($employeeFamily)->date_of_birth) }}" required="true"
                placeholder="Enter date of birth here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('photo') ? 'has-error' : '' }}">
        <label for="photo" class="col-md-12 control-label">Photo</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="photo" id="photo" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeFamily->photo) && !empty($employeeFamily->photo))
                <div class="input-group input-width-input">
                    <span class="input-group-addon mr-2">
                        <input type="checkbox" name="custom_delete_photo" class="custom-delete-file" value="1"
                            {{ old('custom_delete_photo', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>
                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeFamily->photo }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('file') ? 'has-error' : '' }}">
        <label for="file" class="col-md-12 control-label">Certificate</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="file" id="file" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeFamily->file) && !empty($employeeFamily->file))
                <div class="input-group input-width-input">
                    <span class="input-group-addon mr-2">
                        <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1"
                            {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>
                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeFamily->file }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
