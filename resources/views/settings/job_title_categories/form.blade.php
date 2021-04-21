<h6 class="ml-2">{{ __('setting.requiredField') }}<span class="text-danger">*</span> </h6>
<hr>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-12 control-label">{{ __('setting.JobTitleCategoryName') }} <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" oninput="process(this)" id="name"
                value="{{ old('name', optional($jobTitleCategory)->name) }}" minlength="1" maxlength="255"
                placeholder="{{ __('employee.Job Title Category Name') }}">
        </div>
    </div>
    <div class="form-group col-md-6 {{ $errors->has('parent') ? 'has-error' : '' }}">
        <label for="parent" class="col-md-12 control-label">{{ __('setting.Parent') }}</label>
        <div class="col-md-12">
            <select class="form-control" id="parent" name="parent">
                <option value="" style="display: none;"
                    {{ old('parent', optional($jobTitleCategory)->parent ?: '') == '' ? 'selected' : '' }} disabled
                    selected>{{ __('setting.Selectjobtitlecategory') }}</option>
                @foreach ($jobTitleCategories as $key => $jobTitleCategory)
                    <option value="{{ $key }}"
                        {{ old('parent', optional($jobTitleCategory)->parent) == $key ? 'selected' : '' }}>
                        {{ $jobTitleCategory }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-12 control-label">{{ __('setting.Description') }}</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000">{{ old('description', optional($jobTitleCategory)->description) }}</textarea>
    </div>
</div>
<script>
    function process(input) {
        let value = input.value;
        let text = value.replace(/[^A-Z,a-z, ]/g, "");
        input.value = text;
    }

</script>
