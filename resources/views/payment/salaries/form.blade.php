
<div class="form-group {{ $errors->has('salary_height') ? 'has-error' : '' }}">
    <label for="salary_height" class="col-md-2 control-label">Salary Height</label>
    <div class="col-md-10">
        <select class="form-control" id="salary_height" name="salary_height" required="true">
        	    <option value="" style="display: none;" {{ old('salary_height', optional($salary)->salary_height ?: '') == '' ? 'selected' : '' }} disabled selected>Select salary height</option>
        	@foreach ($salaryHeights as $key => $salaryHeight)
			    <option value="{{ $key }}" {{ old('salary_height', optional($salary)->salary_height) == $key ? 'selected' : '' }}>
			    	{{ $salaryHeight }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('salary_height', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('salary_step') ? 'has-error' : '' }}">
    <label for="salary_step" class="col-md-2 control-label">Salary Step</label>
    <div class="col-md-10">
        <select class="form-control" id="salary_step" name="salary_step" required="true">
        	    <option value="" style="display: none;" {{ old('salary_step', optional($salary)->salary_step ?: '') == '' ? 'selected' : '' }} disabled selected>Select salary step</option>
        	@foreach ($salarySteps as $key => $salaryStep)
			    <option value="{{ $key }}" {{ old('salary_step', optional($salary)->salary_step) == $key ? 'selected' : '' }}>
			    	{{ $salaryStep }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('salary_step', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
    <label for="amount" class="col-md-2 control-label">Amount</label>
    <div class="col-md-10">
        <input class="form-control" name="amount" type="text" id="amount" value="{{ old('amount', optional($salary)->amount) }}" minlength="1" required="true" placeholder="Enter amount here...">
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

