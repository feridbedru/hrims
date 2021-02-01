
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($language)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
    <label for="code" class="col-md-2 control-label">Code</label>
    <div class="col-md-10">
        <input class="form-control" name="code" type="text" id="code" value="{{ old('code', optional($language)->code) }}" minlength="1" placeholder="Enter code here...">
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_default') ? 'has-error' : '' }}">
    <label for="is_default" class="col-md-2 control-label">Is Default</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_default_1">
            	<input id="is_default_1" class="" name="is_default" type="checkbox" value="1" {{ old('is_default', optional($language)->is_default) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_default', '<p class="help-block">:message</p>') !!}
    </div>
</div>

