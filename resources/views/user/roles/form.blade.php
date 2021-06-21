<div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name" class="col-md-12 control-label">{{ __('setting.Name') }}</label>
                <input class="form-control" name="name" type="text" id="name"
                    value="{{ old('name', optional($roles)->name) }}" minlength="1" maxlength="255"
                    placeholder="Enter name here...">
            </div>
        </div>
    </div>
    <div class="form-group col-md-6  {{ $errors->has('description') ? 'has-error' : '' }}">
        <div class="col-md-12">
            <label for="description" class="col-md-2 control-label">{{ __('setting.Description') }}</label>
            <div class="col-md-12">
                <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
                    maxlength="1000">{{ old('description', optional($roles)->description) }}</textarea>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('display_name') ? 'has-error' : '' }}">
        <label for="display_name" class="col-md-4 control-label">{{ __('setting.Display Name') }}</label>
        <div>
            <input class="form-control" name="display_name" type="text" id="display_name"
                value="{{ old('display_name', optional($roles)->display_name) }}" minlength="1"
                placeholder="Enter display name here...">
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-12">
        <div class="mb-3">
            <label for="example-text-input" class="col-md-4 col-form-label">{{ __('setting.Permission') }}</label>
            <div class="col-md-12">
                <option value="" disabled="" {{ old('permissions') ? '' : 'selected' }}></option>
                <select name="permission[]" class="select2 form-control select2-multiple " multiple="multiple"
                    data-placeholder="Choose ...">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}" {{ old('permission') ? 'selected' : '' }}>
                            {{ $permission->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('permission') }}</span>
            </div>
        </div>
    </div>
</div>