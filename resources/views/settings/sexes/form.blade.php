<h6 class="ml-2">{{ __('setting.requiredField') }}<span class="text-danger">*</span> </h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">{{ __('setting.SexName') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" oninput="process(this)" id="name"
            value="{{ old('name', optional($sex)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{ __('employee.Enter Sex Name') }}">
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">{{ __('setting.Description') }}</label>
    <div class="col-md-12">
        <input class="form-control" name="description" type="text" id="description"
            value="{{ old('description', optional($sex)->description) }}" minlength="1" maxlength="1000">
    </div>
</div>
<script>
    //function to accept only letter and space
    function process(input) {
        let value = input.value;
        let text = value.replace(/[^A-Z,a-z ]/g, "");
        input.value = text;
    }

</script>
