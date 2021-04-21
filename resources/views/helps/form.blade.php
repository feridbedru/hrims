<h6 class="ml-2">{{(__('setting.requiredField'))}}<span class="text-danger">*</span> </h6>
<hr>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('title') ? 'has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">{{(__('setting.Title'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="title" type="text" id="title" oninput="process(this)"
                value="{{ old('title', optional($help)->title) }}" minlength="1" maxlength="255" required="true"
                placeholder="{{(__('setting.enterthetitlehere'))}}">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('description') ? 'has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">{{(__('setting.Description'))}}</label>
        <div class="col-md-12">
            <input class="form-control" name="description" type="text" id="description"
                value="{{ old('description', optional($help)->description) }}" minlength="1" maxlength="255">
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('data') ? 'has-error' : '' }}">
    <label for="data" class="col-md-2 control-label">{{(__('setting.Data'))}} <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <textarea class="ckeditor form-control" name="data" id="data" required="required"
            placeholder="{{(__('setting.enterdatahere'))}}">{{ old('data', optional($help)->data) }}</textarea>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('topic_for') ? 'has-error' : '' }}">
        <label for="topic_for" class="col-md-4 control-label">{{__('setting.TopicFor')}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="topic_for" type="text" id="topic_for"
                value="{{ old('topic_for', optional($help)->topic_for) }}" minlength="1" required="true"
                placeholder="{{(__('setting.entertopicforhere'))}}">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('parent') ? 'has-error' : '' }}">
        <label for="parent" class="col-md-4 control-label">{{(__('setting.Parent'))}}</label>
        <div class="col-md-12">
            <select class="form-control" id="parent" name="parent">
                <option value="" style="display: none;"
                    {{ old('parent', optional($help)->parent ?: '') == '' ? 'selected' : '' }} disabled selected>
                    {{(__('setting.SelectParent'))}}</option>
                @foreach ($helps as $key => $help)
                    <option value="{{ $key }}"
                        {{ old('parent', optional($help)->parent) == $key ? 'selected' : '' }}>
                        {{ $help }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('language') ? 'has-error' : '' }}">
        <label for="language" class="col-md-4 control-label">{{(__('setting.Language'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="language" name="language" required="true">
                <option value="" style="display: none;"
                    {{ old('language', optional($help)->language ?: '') == '' ? 'selected' : '' }} disabled
                    selected>{{(__('employee.Select Language'))}}</option>
                @foreach ($languages as $key => $language)
                    <option value="{{ $key }}"
                        {{ old('language', optional($help)->language) == $key ? 'selected' : '' }}>
                        {{ $language }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<script>
    //function to accept only letter and space character
    function process(input){
     let value = input.value;
     let text = value.replace(/[^A-Z,a-z, ]/g, "");
     input.value = text;
    }
</script>