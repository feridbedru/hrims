
<div class="form-group {{ $errors->has('salary_scale') ? 'has-error' : '' }}">
    <label for="salary_scale" class="col-md-2 control-label">Salary Scale</label>
    <div class="col-md-10">
        <select class="form-control" id="salary_scale" name="salary_scale" required="true">
        	    <option value="" style="display: none;" {{ old('salary_scale', optional($salaryStep)->salary_scale ?: '') == '' ? 'selected' : '' }} disabled selected>Select salary scale</option>
        	@foreach ($salaryScales as $key => $salaryScale)
			    <option value="{{ $key }}" {{ old('salary_scale', optional($salaryStep)->salary_scale) == $key ? 'selected' : '' }}>
			    	{{ $salaryScale }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('salary_scale', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('step') ? 'has-error' : '' }}">
    <label for="step" class="col-md-2 control-label">Step</label>
    <div class="col-md-10">
        <input class="form-control" name="step" type="text" id="step" value="{{ old('step', optional($salaryStep)->step) }}" min="-2147483648" max="2147483647" placeholder="Enter step here...">
        {!! $errors->first('step', '<p class="help-block">:message</p>') !!}
    </div>
</div>

