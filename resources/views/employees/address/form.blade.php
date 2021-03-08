<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('type') ? 'has-error' : '' }}">
        <label for="type" class="col-md-4 control-label">Address Type</label>
        <div class="col-md-12">
            <select class="form-control" id="type" name="type" required="true">
                <option value="" style="display: none;"
                    {{ old('type', optional($employeeAddress)->type ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select address type</option>
                @foreach ($addressTypes as $key => $addressType)
                    <option value="{{ $key }}"
                        {{ old('type', optional($employeeAddress)->type) == $key ? 'selected' : '' }}>
                        {{ $addressType }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('address') ? 'has-error' : '' }}">
        <label for="address" class="col-md-4 control-label">Address</label>
        <div class="col-md-12">
            <input class="form-control" name="address" type="text" id="address"
                value="{{ old('address', optional($employeeAddress)->address) }}" minlength="1"
                placeholder="Enter address here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('house_number') ? 'has-error' : '' }}">
        <label for="house_number" class="col-md-4 control-label">House Number</label>
        <div class="col-md-12">
            <input class="form-control" name="house_number" type="text" id="house_number"
                value="{{ old('house_number', optional($employeeAddress)->house_number) }}" minlength="1"
                placeholder="Enter house number here...">
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4">
        <label for="region" class="col-md-4 control-label">Region</label>
        <div class="col-md-12">
            <select class="form-control" id="region" name="region">
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
        <label for="zone" class="col-md-4 control-label">Zone</label>
        <div class="col-md-12">
            <select class="form-control" id="zone" name="zone">
                <option value="" style="display: none;" disabled selected>Select Zone</option>
                @foreach ($zones as $key => $zone)
                    <option value="{{ $key }}">
                        {{ $zone }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="form-group col-md-4 {{ $errors->has('woreda') ? 'has-error' : '' }}">
        <label for="woreda" class="col-md-4 control-label">Woreda</label>
        <div class="col-md-12">
            <select class="form-control" id="woreda" name="woreda">
                <option value="" style="display: none;"
                    {{ old('woreda', optional($employeeAddress)->woreda ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select woreda</option>
                @foreach ($woredas as $key => $woreda)
                    <option value="{{ $key }}"
                        {{ old('woreda', optional($employeeAddress)->woreda) == $key ? 'selected' : '' }}>
                        {{ $woreda }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
