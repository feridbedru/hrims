<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-12 control-label">{{(__('employee.Name'))}}</label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($evaluationType)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-12 control-label">{{(__('employee.Description'))}}</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1" maxlength="1000">{{ old('description', optional($evaluationType)->description) }}</textarea>
    </div>
</div>

