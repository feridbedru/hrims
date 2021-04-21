<h6 class="ml-2">{{ __('setting.requiredField') }}<span class="text-danger">*</span> </h6>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="col-md-12 control-label">{{ __('setting.OrganizationLocationName') }} <span
                    class="text-danger">*</span></label>
            <div class="col-md-12">
                <input class="form-control" name="name" type="text" id="name" oninput="process(this)"
                    value="{{ old('name', optional($organizationLocation)->name) }}" minlength="1" maxlength="255"
                    required="true" placeholder="{{(__('employee.Enter Organization Location Name Here'))}}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="col-md-12 control-label">{{ __('setting.Address') }} <span
                    class="text-danger">*</span></label>
            <div class="col-md-12">
                <input class="form-control" name="address" type="text" id="address" oninput="process(this)"
                    value="{{ old('address', optional($organizationLocation)->address) }}" minlength="1"
                    maxlength="255" required="true" placeholder="{{(__('employee.Enter address here'))}}">
            </div>
        </div>
    </div>
</div>
<script>
    function process(input) {
        let value = input.value;
        let text = value.replace(/[^A-Z,a-z, ]/g, "");
        input.value = text;
    }
</script>
