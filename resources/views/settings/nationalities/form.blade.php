<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($nationality)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="Enter name here...">
    </div>
</div>
<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
    <label for="code" class="col-md-2 control-label">Code <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control" name="code" type="text" id="code"
            value="{{ old('code', optional($nationality)->code) }}" minlength="1" required="true"
            placeholder="Enter code here...">
    </div>
</div>