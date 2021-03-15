<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('title') ? 'has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">Title <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="title" type="text" id="title"
                value="{{ old('title', optional($employeeFile)->title) }}" minlength="1" maxlength="255"
                required="true" placeholder="Enter title here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('attachment') ? 'has-error' : '' }}">
        <label for="attachment" class="col-md-2 control-label">Attachment <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="attachment" id="attachment" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeFile->attachment) && !empty($employeeFile->attachment))
                <div class="input-group input-width-input">
                    <span class="input-group-addon mr-2">
                        <input type="checkbox" name="custom_delete_attachment" class="custom-delete-file" value="1"
                            {{ old('custom_delete_attachment', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeFile->attachment }}
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
            maxlength="1000">{{ old('description', optional($employeeFile)->description) }}</textarea>
    </div>
</div>
