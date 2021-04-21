<h6 class="ml-2">{{(__('setting.requiredField'))}}<span class="text-danger">*</span> </h6>
<hr>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('type') ? 'has-error' : '' }}">
        <label for="type" class="col-md-4 control-label">{{(__('employee.Type'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="type" name="type" required="true">
                <option value="" style="display: none;"
                    {{ old('type', optional($employeeStudyTraining)->type ?: '') == '' ? 'selected' : '' }} disabled
                    selected>{{(__('employee.Select Type'))}}</option>
                @foreach ($commitmentFors as $key => $commitmentFor)
                    <option value="{{ $key }}"
                        {{ old('type', optional($employeeStudyTraining)->type) == $key ? 'selected' : '' }}>
                        {{ $commitmentFor }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('institution') ? 'has-error' : '' }}">
        <label for="institution" class="col-md-4 control-label">{{(__('employee.Institution'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="institution" name="institution" required="true">
                <option value="" style="display: none;"
                    {{ old('institution', optional($employeeStudyTraining)->institution ?: '') == '' ? 'selected' : '' }}
                    disabled selected>{{(__('employee.Select educational institution'))}}</option>
                @foreach ($educationalInstitutions as $key => $educationalInstitution)
                    <option value="{{ $key }}"
                        {{ old('institution', optional($employeeStudyTraining)->institution) == $key ? 'selected' : '' }}>
                        {{ $educationalInstitution }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('level') ? 'has-error' : '' }}">
        <label for="level" class="col-md-4 control-label">{{(__('setting.Level'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="level" name="level" required="true">
                <option value="" style="display: none;"
                    {{ old('level', optional($employeeStudyTraining)->level ?: '') == '' ? 'selected' : '' }}
                    disabled selected>{{(__('employee.Select educational level'))}}</option>
                @foreach ($educationalLevels as $key => $educationalLevel)
                    <option value="{{ $key }}"
                        {{ old('level', optional($employeeStudyTraining)->level) == $key ? 'selected' : '' }}>
                        {{ $educationalLevel }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('field') ? 'has-error' : '' }}">
        <label for="field" class="col-md-4 control-label">{{(__('setting.Field'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <select class="form-control" id="field" name="field" required="true">
                <option value="" style="display: none;"
                    {{ old('field', optional($employeeStudyTraining)->field ?: '') == '' ? 'selected' : '' }}
                    disabled selected>{{(__('employee.Select educational field'))}}</option>
                @foreach ($educationalFields as $key => $educationalField)
                    <option value="{{ $key }}"
                        {{ old('field', optional($employeeStudyTraining)->field) == $key ? 'selected' : '' }}>
                        {{ $educationalField }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('start_date') ? 'has-error' : '' }}">
        <label for="start_date" class="col-md-4 control-label">{{(__('employee.Start Date'))}}</label>
        <div class="col-md-12">
            <input class="form-control" name="start_date" type="date" id="start_date"
                value="{{ old('start_date', optional($employeeStudyTraining)->start_date) }}">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('duration') ? 'has-error' : '' }}">
        <label for="duration" class="col-md-4 control-label">{{(__('employee.Duration'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="duration" type="text" id="duration"
                value="{{ old('duration', optional($employeeStudyTraining)->duration) }}" minlength="1"
                placeholder="{{(__('employee.Enter duration here'))}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-2 {{ $errors->has('has_commitment') ? 'has-error' : '' }}">
        <label for="has_commitment" class="col-md-12 control-label">{{(__('employee.Has Commitment'))}} <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <div class="checkbox">
                <label for="has_commitment_1">
                    <input id="has_commitment_1" class="" name="has_commitment" type="checkbox" value="1"
                        {{ old('has_commitment', optional($employeeStudyTraining)->has_commitment) == '1' ? 'checked' : '' }} required="true">
                        {{(__('employee.Yes'))}}
                </label>
            </div>
        </div>
    </div>

    <div class="form-group col-md-3 {{ $errors->has('total_commitment') ? 'has-error' : '' }}">
        <label for="total_commitment" class="col-md-12 control-label">{{(__('employee.Total Commitment(Month)'))}}</label>
        <div class="col-md-12">
            <input class="form-control" name="total_commitment" type="number" id="total_commitment"
                value="{{ old('total_commitment', optional($employeeStudyTraining)->total_commitment) }}"
                placeholder="{{(__('employee.Enter total months here'))}}">
        </div>
    </div>

    <div class="form-group col-md-3 {{ $errors->has('amount') ? 'has-error' : '' }}">
        <label for="amount" class="col-md-12 control-label">{{(__('employee.Total Commitment(Amount)'))}}</label>
        <div class="col-md-12">
            <input class="form-control" name="amount" type="number" id="amount"
                value="{{ old('amount', optional($employeeStudyTraining)->amount) }}"
                placeholder="{{(__('employee.Enter total amount here'))}}">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('attachment') ? 'has-error' : '' }}">
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

            @if (isset($employeeStudyTraining->attachment) && !empty($employeeStudyTraining->attachment))
                <div class="input-group input-width-input">
                    <span class="input-group-addon mr-2">
                        <input type="checkbox" name="custom_delete_attachment" class="custom-delete-file" value="1"
                            {{ old('custom_delete_attachment', '0') == '1' ? 'checked' : '' }}> {{(__('setting.delete'))}}
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeStudyTraining->attachment }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
