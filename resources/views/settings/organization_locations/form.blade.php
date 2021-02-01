<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="col-md-2 control-label">Name</label>
            <div class="col-md-12">
                <input class="form-control" name="name" type="text" id="name"
                    value="{{ old('name', optional($organizationLocation)->name) }}" minlength="1" maxlength="255"
                    required="true" placeholder="Enter name here...">
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Address</label>
                <div class="col-md-12">
                    <input class="form-control" name="address" type="text" id="address"
                        value="{{ old('address', optional($organizationLocation)->address) }}" minlength="1"
                        maxlength="255" required="true" placeholder="Enter address here...">
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
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
            {!! $errors->first('cordinates', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
