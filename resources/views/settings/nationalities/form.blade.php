<h6 class="ml-2">{{ __('setting.requiredField') }}<span class="text-danger">*</span> </h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ __('setting.NationalityName') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" oninput="process(this)"
            value="{{ old('name', optional($nationality)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{ __('employee.Enter Country Name Here') }}">
    </div>
</div>
<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
    <label for="code" class="col-md-2 control-label">{{ __('setting.Code') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control" name="code" type="text" id="code" oninput="processs(this)"
            value="{{ old('code', optional($nationality)->code) }}" minlength="1" required="true"
            placeholder="Enter code here...">
    </div>
</div>
<script>
    // function to accept only alephbet and space even in copy pase
    function process(input) {
        let value = input.value;
        let text = value.replace(/[^A-Z,a-z, ]/g, "");
        input.value = text;
    }

    // function to accept only number and space even in copy pase
    function processs(input) {
        let value = input.value;
        let num = value.replace(/[^A-Z]/g, "");
        input.value = num;
    }

</script>
