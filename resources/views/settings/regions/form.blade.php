
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($region)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
    <label for="code" class="col-md-2 control-label">Code</label>
    <div class="col-md-10">
        <input class="form-control" name="code" type="text" id="code" value="{{ old('code', optional($region)->code) }}" minlength="1" placeholder="Enter code here...">
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div>

