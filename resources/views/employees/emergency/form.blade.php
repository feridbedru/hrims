<div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
    <label for="employee" class="col-md-2 control-label">Employee</label>
    <div class="col-md-10">
        <select class="form-control" id="employee" name="employee" required="true">
            <option value="" style="display: none;"
                {{ old('employee', optional($employeeEmergency)->employee ?: '') == '' ? 'selected' : '' }} disabled
                selected>Select employee</option>
            @foreach ($employees as $key => $employee)
                <option value="{{ $key }}"
                    {{ old('employee', optional($employeeEmergency)->employee) == $key ? 'selected' : '' }}>
                    {{ $employee }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($employeeEmergency)->name) }}" minlength="1" maxlength="255"
                required="true" placeholder="Enter name here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('phone_number') ? 'has-error' : '' }}">
        <label for="phone_number" class="col-md-4 control-label">Phone Number</label>
        <div class="col-md-12">
            <input class="form-control" name="phone_number" type="number" id="phone_number"
                value="{{ old('phone_number', optional($employeeEmergency)->phone_number) }}"
                placeholder="Enter phone number here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('relationship') ? 'has-error' : '' }}">
        <label for="relationship" class="col-md-4 control-label">Relationship</label>
        <div class="col-md-12">
            <select class="form-control" id="relationship" name="relationship" required="true">
                <option value="" style="display: none;"
                    {{ old('relationship', optional($employeeEmergency)->relationship ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select relationship</option>
                @foreach ($relationships as $key => $relationship)
                    <option value="{{ $key }}"
                        {{ old('relationship', optional($employeeEmergency)->relationship) == $key ? 'selected' : '' }}>
                        {{ $relationship }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('address') ? 'has-error' : '' }}">
        <label for="address" class="col-md-4 control-label">Address</label>
        <div class="col-md-12">
            <input class="form-control" name="address" type="text" id="address"
                value="{{ old('address', optional($employeeEmergency)->address) }}" minlength="1"
                placeholder="Enter address here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('house_number') ? 'has-error' : '' }}">
        <label for="house_number" class="col-md-4 control-label">House Number</label>
        <div class="col-md-12">
            <input class="form-control" name="house_number" type="text" id="house_number"
                value="{{ old('house_number', optional($employeeEmergency)->house_number) }}"
                placeholder="Enter house number here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('other_phone') ? 'has-error' : '' }}">
        <label for="other_phone" class="col-md-6 control-label">Other Phone</label>
        <div class="col-md-12">
            <input class="form-control" name="other_phone" type="text" id="other_phone"
                value="{{ old('other_phone', optional($employeeEmergency)->other_phone) }}" minlength="1"
                placeholder="Enter other phone here...">
        </div>
    </div>
</div>