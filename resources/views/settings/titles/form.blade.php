<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="form-group {{ $errors->has('en_title') ? 'has-error' : '' }}">
    <label for="en_title" class="col-md-4 control-label">English Title <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="en_title" type="text" id="en_title"
            value="{{ old('en_title', optional($title)->en_title) }}" minlength="1" required="true"
            placeholder="Enter english title here...">
    </div>
</div>

<div class="form-group {{ $errors->has('am_title') ? 'has-error' : '' }}">
    <label for="am_title" class="col-md-4 control-label">Amharic Title <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="am_title" type="text" id="am_title"
            value="{{ old('am_title', optional($title)->am_title) }}" minlength="1" required="true"
            placeholder="Enter amharic title here...">
    </div>
</div>
