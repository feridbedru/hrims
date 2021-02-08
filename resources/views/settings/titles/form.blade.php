
<div class="form-group {{ $errors->has('en_title') ? 'has-error' : '' }}">
    <label for="en_title" class="col-md-2 control-label">English Title</label>
    <div class="col-md-10">
        <input class="form-control" name="en_title" type="text" id="en_title" value="{{ old('en_title', optional($title)->en_title) }}" minlength="1" required="true" placeholder="Enter english title here...">
        {!! $errors->first('en_title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('am_title') ? 'has-error' : '' }}">
    <label for="am_title" class="col-md-2 control-label">Amharic Title</label>
    <div class="col-md-10">
        <input class="form-control" name="am_title" type="text" id="am_title" value="{{ old('am_title', optional($title)->am_title) }}" minlength="1" required="true" placeholder="Enter amharic title here...">
        {!! $errors->first('am_title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

