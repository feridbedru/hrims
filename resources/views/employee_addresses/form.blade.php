<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('address_type_id') ? 'has-error' : '' }}">
        <label for="address_type_id" class="col-md-4 control-label">Address Type</label>
        <div class="col-md-12">
            <select class="form-control" id="address_type_id" name="address_type_id" required="true">
                <option value="" style="display: none;"
                    {{ old('address_type_id', optional($employeeAddress)->address_type_id ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select address type</option>
                @foreach ($addressTypes as $key => $addressType)
                    <option value="{{ $key }}"
                        {{ old('address_type_id', optional($employeeAddress)->address_type_id) == $key ? 'selected' : '' }}>
                        {{ $addressType }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('address_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('address') ? 'has-error' : '' }}">
        <label for="address" class="col-md-4 control-label">Address</label>
        <div class="col-md-12">
            <input class="form-control" name="address" type="text" id="address"
                value="{{ old('address', optional($employeeAddress)->address) }}" minlength="1"
                placeholder="Enter address here...">
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('house_number') ? 'has-error' : '' }}">
        <label for="house_number" class="col-md-4 control-label">House Number</label>
        <div class="col-md-12">
            <input class="form-control" name="house_number" type="text" id="house_number"
                value="{{ old('house_number', optional($employeeAddress)->house_number) }}" minlength="1"
                placeholder="Enter house number here...">
            {!! $errors->first('house_number', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4">
        <label for="region_id" class="col-md-4 control-label">Region</label>
        <div class="col-md-12">
            <select class="form-control" id="region_id" name="region_id">
                <option value="" style="display: none;" disabled selected>Select Region</option>
                @foreach ($regions as $key => $region)
                    <option value="{{ $key }}">
                        {{ $region }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="zone_id" class="col-md-4 control-label">Zone</label>
        <div class="col-md-12">
            <select class="form-control" id="zone_id" name="zone_id">
                <option value="" style="display: none;" disabled selected>Select Zone</option>
                @foreach ($zones as $key => $zone)
                    <option value="{{ $key }}">
                        {{ $zone }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="form-group col-md-4 {{ $errors->has('woreda_id') ? 'has-error' : '' }}">
        <label for="woreda_id" class="col-md-4 control-label">Woreda</label>
        <div class="col-md-12">
            <select class="form-control" id="woreda_id" name="woreda_id">
                <option value="" style="display: none;"
                    {{ old('woreda_id', optional($employeeAddress)->woreda_id ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select woreda</option>
                @foreach ($woredas as $key => $woreda)
                    <option value="{{ $key }}"
                        {{ old('woreda_id', optional($employeeAddress)->woreda_id) == $key ? 'selected' : '' }}>
                        {{ $woreda }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('woreda_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('employee_id') ? 'has-error' : '' }}">
        <label for="employee_id" class="col-md-4 control-label">Employee</label>
        <div class="col-md-12">
            <select class="form-control" id="employee_id" name="employee_id" required="true">
                <option value="" style="display: none;"
                    {{ old('employee_id', optional($employeeAddress)->employee_id ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select employee</option>
                @foreach ($employees as $key => $employee)
                    <option value="{{ $key }}"
                        {{ old('employee_id', optional($employeeAddress)->employee_id) == $key ? 'selected' : '' }}>
                        {{ $employee }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('employee_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 {{ $errors->has('created_by') ? 'has-error' : '' }}">
        <label for="created_by" class="col-md-4 control-label">Created By</label>
        <div class="col-md-12">
            <select class="form-control" id="created_by" name="created_by" required="true">
                <option value="" style="display: none;"
                    {{ old('created_by', optional($employeeAddress)->created_by ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select created by</option>
                @foreach ($creators as $key => $creator)
                    <option value="{{ $key }}"
                        {{ old('created_by', optional($employeeAddress)->created_by) == $key ? 'selected' : '' }}>
                        {{ $creator }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
