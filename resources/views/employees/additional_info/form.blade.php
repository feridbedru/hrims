<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('place_of_birth') ? 'has-error' : '' }}">
        <label for="place_of_birth" class="col-md-12 control-label">Place Of Birth</label>
        <div class="col-md-12">
            <input class="form-control" name="place_of_birth" type="text" id="place_of_birth"
                value="{{ old('place_of_birth', optional($employeeAdditionalInfo)->place_of_birth) }}" minlength="1"
                placeholder="Enter place of birth here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('other_phone_number') ? 'has-error' : '' }}">
        <label for="other_phone_number" class="col-md-12 control-label">Other Phone Number</label>
        <div class="col-md-12">
            <input class="form-control" name="other_phone_number" type="number" id="other_phone_number"
                value="{{ old('other_phone_number', optional($employeeAdditionalInfo)->other_phone_number) }}"
                placeholder="Enter other phone number here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('nationality') ? 'has-error' : '' }}">
        <label for="nationality" class="col-md-12 control-label">Nationality</label>
        <div class="col-md-12">
            <select class="form-control" id="nationality" name="nationality">
                <option value="" style="display: none;"
                    {{ old('nationality', optional($employeeAdditionalInfo)->nationality ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select nationality</option>
                @foreach ($nationalities as $key => $nationality)
                    <option value="{{ $key }}"
                        {{ old('nationality', optional($employeeAdditionalInfo)->nationality) == $key ? 'selected' : '' }}>
                        {{ $nationality }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('religion') ? 'has-error' : '' }}">
        <label for="religion" class="col-md-12 control-label">Religion</label>
        <div class="col-md-12">
            <select class="form-control" id="religion" name="religion">
                <option value="" style="display: none;"
                    {{ old('religion', optional($employeeAdditionalInfo)->religion ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select religion</option>
                @foreach ($religions as $key => $religion)
                    <option value="{{ $key }}"
                        {{ old('religion', optional($employeeAdditionalInfo)->religion) == $key ? 'selected' : '' }}>
                        {{ $religion }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('blood_group') ? 'has-error' : '' }}">
        <label for="blood_group" class="col-md-12 control-label">Blood Group</label>
        <div class="col-md-12">
            <select class="form-control" id="blood_group" name="blood_group" required="true">
                <option value="" style="display: none;"
                    {{ old('blood_group', optional($employeeAdditionalInfo)->blood_group ?: '') == '' ? 'selected' : '' }}
                    disabled selected>
                    Select Blood Group</option>

                <option value="1"
                    {{ old('blood_group', optional($employeeAdditionalInfo)->blood_group) == 1 ? 'selected' : '' }}>
                    Active
                </option>
                <option value="2"
                    {{ old('blood_group', optional($employeeAdditionalInfo)->blood_group) == 0 ? 'selected' : '' }}>
                    Closed
                </option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('tin_number') ? 'has-error' : '' }}">
        <label for="tin_number" class="col-md-12 control-label">Tin Number</label>
        <div class="col-md-12">
            <input class="form-control" name="tin_number" type="number" id="tin_number"
                value="{{ old('tin_number', optional($employeeAdditionalInfo)->tin_number) }}"
                placeholder="Enter tin number here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('pension') ? 'has-error' : '' }}">
        <label for="pension" class="col-md-12 control-label">Pension</label>
        <div class="col-md-12">
            <input class="form-control" name="pension" type="text" id="pension"
                value="{{ old('pension', optional($employeeAdditionalInfo)->pension) }}" minlength="1"
                placeholder="Enter pension here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('marital_status') ? 'has-error' : '' }}">
        <label for="marital_status" class="col-md-12 control-label">Marital Status</label>
        <div class="col-md-12">
            <select class="form-control" id="marital_status" name="marital_status">
                <option value="" style="display: none;"
                    {{ old('marital_status', optional($employeeAdditionalInfo)->marital_status ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select marital status</option>
                @foreach ($maritalStatuses as $key => $maritalStatus)
                    <option value="{{ $key }}"
                        {{ old('marital_status', optional($employeeAdditionalInfo)->marital_status) == $key ? 'selected' : '' }}>
                        {{ $maritalStatus }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>