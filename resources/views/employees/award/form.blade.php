@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-calendar/css/redmond.calendars.picker.css') }}">
@endsection
<h6 class="ml-2">{{(__('setting.requiredField'))}} <span class="text-danger">*</span></h6>
<hr>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('organization') ? 'has-error' : '' }}">
        <label for="organization" class="col-md-12 control-label">{{__('setting.Organization')}} <span
                class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="organization" type="text" id="organization"
                value="{{ old('organization', optional($employeeAward)->organization) }}" minlength="1"
                required="true" placeholder="{{(__('employee.Enter organization here'))}}">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('type') ? 'has-error' : '' }}">
        <label for="type" class="col-md-12 control-label">{{(__('setting.AwardType'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="type" name="type" required="true">
                <option value="" style="display: none;"
                    {{ old('type', optional($employeeAward)->type ?: '') == '' ? 'selected' : '' }} disabled selected>
                    {{(__('employee.Select award type'))}}</option>
                @foreach ($awardTypes as $key => $awardType)
                    <option value="{{ $key }}"
                        {{ old('type', optional($employeeAward)->type) == $key ? 'selected' : '' }}>
                        {{ $awardType }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('attachment') ? 'has-error' : '' }}">
        <label for="attachment" class="col-md-12 control-label">{{(__('employee.Attachment'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        {{(__('employee.Browse'))}} <input type="file" name="attachment" id="attachment" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeAward->attachment) && !empty($employeeAward->attachment))
                <div class="input-group input-width-input">
                    <span class="input-group-addon mr-2">
                        <input type="checkbox" name="custom_delete_attachment" class="custom-delete-file" value="1"
                            {{ old('custom_delete_attachment', '0') == '1' ? 'checked' : '' }}> {{(__('setting.delete'))}}
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeAward->attachment }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('awarded_on') ? 'has-error' : '' }}">
        <label for="awarded_on" class="col-md-12 control-label">{{(__('employee.Awarded On'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="awarded_on" type="calendar" id="awarded_on"
                value="{{ old('organization', optional($employeeAward)->awarded_on) }}" minlength="10" maxlength="10" pattern="YYYY-MM-DD">
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-12 control-label">{{(__('setting.Description'))}}</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000">{{ old('description', optional($employeeAward)->description) }}</textarea>
    </div>
</div>
@section('javascripts')
    <script src="{{ asset('assets/plugins/jquery-calendar/js/jquery.plugin.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-calendar/js/jquery.calendars.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-calendar/js/jquery.calendars.plus.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-calendar/js/jquery.calendars.picker.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-calendar/js/jquery.calendars.ethiopian.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-calendar/js/jquery.calendars.ethiopian-am.js') }}"></script>
    <script>
        $('#awarded_on').calendarsPicker({
            calendar: $.calendars.instance('ethiopian', 'am'),
            pickerClass: 'myPicker',
            dateFormat: 'yyyy-mm-dd'
        });
    </script>
@endsection