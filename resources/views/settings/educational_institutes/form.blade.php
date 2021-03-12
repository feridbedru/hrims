<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Educational Institute Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($educationalInstitute)->name) }}" minlength="1" maxlength="255"
            required="true" placeholder="Enter name here...">
    </div>
</div>

<div class="form-group {{ $errors->has('abbreviation') ? 'has-error' : '' }}">
    <label for="abbreviation" class="col-md-4 control-label">Abbreviation</label>
    <div class="col-md-12">
        <input class="form-control" name="abbreviation" type="text" id="abbreviation"
            value="{{ old('abbreviation', optional($educationalInstitute)->abbreviation) }}" minlength="1"
            placeholder="Enter abbreviation here...">
    </div>
</div>
