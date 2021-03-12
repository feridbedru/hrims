<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Region Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($region)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="Enter name here...">
    </div>
</div>

<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
    <label for="code" class="col-md-4 control-label">Code</label>
    <div class="col-md-12">
        <input class="form-control" name="code" type="text" id="code"
            value="{{ old('code', optional($region)->code) }}" minlength="1" placeholder="Enter code here...">
    </div>
</div>
