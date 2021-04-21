<h6 class="ml-2">{{ __('setting.requiredField') }}<span class="text-danger">*</span> </h6>
<hr>
<div class="form-group {{ $errors->has('en_title') ? 'has-error' : '' }}">
    <label for="en_title" class="col-md-4 control-label">{{ __('setting.EnglishTitle ') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="en_title" type="text" oninput="process(this)" id="en_title"
            value="{{ old('en_title', optional($title)->en_title) }}" minlength="1" required="true"
            placeholder="{{(__('employee.Enter englsh title here'))}}">
    </div>
</div>

<div class="form-group {{ $errors->has('am_title') ? 'has-error' : '' }}">
    <label for="am_title" class="col-md-4 control-label">{{ __('setting.AmharicTitle') }} <span
            class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="am_title" type="text" id="am_title" oninput="process(this)"
            value="{{ old('am_title', optional($title)->am_title) }}" minlength="1" required="true"
            placeholder="{{(__('employee.Enter amharic title here'))}}">
    </div>
</div>
<script>
    // function to accept only alephbet and space even in copy pase
    function process(input) {
        let value = input.value;
        let text = value.replace(/[^A-Z,a-z, ]/g, "");
        input.value = text;
    }

</script>
