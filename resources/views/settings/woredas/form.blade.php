
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($woreda)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('zone') ? 'has-error' : '' }}">
    <label for="zone" class="col-md-2 control-label">Zone</label>
    <div class="col-md-10">
        <select class="form-control" id="zone" name="zone" required="true">
        	    <option value="" style="display: none;" {{ old('zone', optional($woreda)->zone ?: '') == '' ? 'selected' : '' }} disabled selected>Select zone</option>
        	@foreach ($zones as $key => $zone)
			    <option value="{{ $key }}" {{ old('zone', optional($woreda)->zone) == $key ? 'selected' : '' }}>
			    	{{ $zone }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('zone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

