<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="row">
    <div class="form-group col-md-10 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-12 control-label">Name <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($report)->name) }}" minlength="1" maxlength="255" required="true"
                placeholder="Enter name here...">
        </div>
    </div>

    <div class="form-group col-md-2 {{ $errors->has('is_active') ? 'has-error' : '' }}">
        <label for="is_active" class="col-md-8 control-label">Is Active</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_active_1">
                    <input id="is_active_1" class="" name="is_active" type="checkbox" value="1"
                        {{ old('is_active', optional($report)->is_active) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-12 control-label">Description <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000" required="true"
            placeholder="enter description here...">{{ old('description', optional($report)->description) }}</textarea>
    </div>
</div>

<div class="form-group {{ $errors->has('query') ? 'has-error' : '' }}">
    <label for="query" class="col-md-12 control-label">Query <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <textarea class="form-control" name="query" cols="50" rows="10" id="query" minlength="1" required="true"
            placeholder="Enter query here...">{{ old('query', optional($report)->query) }}</textarea>
    </div>
</div>
