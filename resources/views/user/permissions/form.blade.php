<h6 class="ml-2">{{ __('setting.requiredField') }}<span class="text-danger">*</span> </h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">{{ __('setting.Name') }}</label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($permissions)->name) }}" minlength="1" maxlength="255"
            placeholder="Enter name here...">
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">{{ __('setting.Description') }}</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000">{{ old('description', optional($permissions)->description) }}</textarea>
    </div>
</div>

<div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
    <label for="display_name" class="col-md-4 control-label">Display Name</label>
    <div class="col-md-12">
        <input class="form-control" name="display_name" type="text" id="display_name"
            value="{{ old('display_name', optional($permissions)->display_name) }}" minlength="1"
            placeholder="Enter display name here...">
    </div>
</div>
