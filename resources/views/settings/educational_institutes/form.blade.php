
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($educationalInstitute)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('abbreviation') ? 'has-error' : '' }}">
    <label for="abbreviation" class="col-md-2 control-label">Abbreviation</label>
    <div class="col-md-10">
        <input class="form-control" name="abbreviation" type="text" id="abbreviation" value="{{ old('abbreviation', optional($educationalInstitute)->abbreviation) }}" minlength="1" placeholder="Enter abbreviation here...">
        {!! $errors->first('abbreviation', '<p class="help-block">:message</p>') !!}
    </div>
</div>

