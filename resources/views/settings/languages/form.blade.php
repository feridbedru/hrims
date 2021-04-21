<h6 class="ml-2">{{(__('setting.requiredField'))}}<span class="text-danger">*</span> </h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">{{(__('setting.LanguageName'))}} <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($language)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{(__('employee.Enter Language Name Here'))}}">
    </div>
</div>

<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
    <label for="code" class="col-md-4 control-label">{{(__('setting.Code'))}} <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="code" type="text" id="code"
            value="{{ old('code', optional($language)->code) }}" minlength="1" placeholder="{{(__('setting.Code'))}}"
            required="true">
    </div>
</div>

<div class="form-group {{ $errors->has('is_default') ? 'has-error' : '' }}">
    <label for="is_default" class="col-md-4 control-label">{{(__('setting.IsDefault'))}}</label>
    <div class="col-md-12">
        <div class="checkbox">
            <label for="is_default_1">
                <input id="is_default_1" class="" name="is_default" type="checkbox" value="1"
                    {{ old('is_default', optional($language)->is_default) == '1' ? 'checked' : '' }}>
                    {{(__('setting.Yes'))}}
            </label>
        </div>
    </div>
</div>
<script>
    // function to accept only alephbet and space even in copy pase
    function processs(input)
     {
    let value = input.value;
    let text = value.replace(/[^A-Z,a-z ]/g, "");
    input.value = text;
     }

      // function to accept only number even in copy pase
      function process(input)
      {
      let value = input.value;
      let numbers = value.replace(/[^0-9]/g, "");
      input.value = numbers;
      }
  </script>