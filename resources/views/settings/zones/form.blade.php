
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($zone)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('regionS') ? 'has-error' : '' }}">
    <label for="regionS" class="col-md-2 control-label">Region</label>
    <div class="col-md-10">
        <select class="form-control" id="regionS" name="regionS" required="true">
        	    <option value="" style="display: none;" {{ old('regionS', optional($zone)->regionS ?: '') == '' ? 'selected' : '' }} disabled selected>Select region</option>
        	@foreach ($regions as $key => $region)
			    <option value="{{ $key }}" {{ old('regionS', optional($zone)->regionS) == $key ? 'selected' : '' }}>
			    	{{ $region }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('regionS', '<p class="help-block">:message</p>') !!}
    </div>
</div>

