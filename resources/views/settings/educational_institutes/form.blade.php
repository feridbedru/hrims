<h6 class="ml-2">{{(__('setting.requiredField'))}}<span class="text-danger">*</span> </h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">{{(__('setting.EducationInsitutionName'))}} <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" oninput="process(this)" id="name"
            value="{{ old('name', optional($educationalInstitute)->name) }}" minlength="1" maxlength="255"
            required="true" placeholder="{{(__('employee.Enter Educational Level Name'))}}">
    </div>
</div>

<div class="form-group {{ $errors->has('abbreviation') ? 'has-error' : '' }}">
    <label for="abbreviation" class="col-md-4 control-label">{{(__('setting.Abbreviation'))}}</label>
    <div class="col-md-12">
        <input class="form-control" name="abbreviation" type="text" id="abbreviation"
            value="{{ old('abbreviation', optional($educationalInstitute)->abbreviation) }}" minlength="1"
            placeholder="{{(__('setting.Enter Abbreviation here'))}}">
    </div>
</div>
<script>

    function processs(input){
    let value = input.value;
    let text = value.replace(/[^A-Z,a-z, ]/g, "");
    input.value = text;
  }
  </script>