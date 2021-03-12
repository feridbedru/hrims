<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="col-md-2 control-label">Organization Location Name <span class="text-danger">*</span></label>
            <div class="col-md-12">
                <input class="form-control" name="name" type="text" id="name"
                    value="{{ old('name', optional($organizationLocation)->name) }}" minlength="1" maxlength="255"
                    required="true" placeholder="Enter name here...">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="col-md-2 control-label">Address <span class="text-danger">*</span></label>
            <div class="col-md-12">
                <input class="form-control" name="address" type="text" id="address"
                    value="{{ old('address', optional($organizationLocation)->address) }}" minlength="1"
                    maxlength="255" required="true" placeholder="Enter address here...">
            </div>
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('cordinates') ? 'has-error' : '' }}">
    <label for="cordinates" class="col-md-2 control-label">Cordinates</label>
    <div class="col-md-12">
        <input class="form-control" name="cordinates" type="text" id="cordinates"
            value="{{ old('cordinates', optional($organizationLocation)->cordinates) }}" minlength="1"
            placeholder="Enter cordinates here...">
    </div>
</div>
