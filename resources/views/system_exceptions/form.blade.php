
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-4 control-label">Title</label>
    <div class="col-md-12">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($systemException)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-4 control-label">Status</label>
    <div class="col-md-12">
        <input class="form-control" name="status" type="text" id="status" value="{{ old('status', optional($systemException)->status) }}" minlength="1" required="true" placeholder="Enter status here...">
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

