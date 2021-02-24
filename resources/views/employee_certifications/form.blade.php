<div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
    <label for="employee" class="col-md-2 control-label">Employee</label>
    <div class="col-md-10">
        <select class="form-control" id="employee" name="employee" required="true">
            <option value="" style="display: none;"
                {{ old('employee', optional($employeeCertification)->employee ?: '') == '' ? 'selected' : '' }}
                disabled selected>Select employee</option>
            @foreach ($employees as $key => $employee)
                <option value="{{ $key }}"
                    {{ old('employee', optional($employeeCertification)->employee) == $key ? 'selected' : '' }}>
                    {{ $employee }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('employee', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>
        <div class="col-md-12">
            <input class="form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($employeeCertification)->name) }}" minlength="1" maxlength="255"
                required="true" placeholder="Enter name here...">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('issued_on') ? 'has-error' : '' }}">
        <label for="issued_on" class="col-md-4 control-label">Issued On</label>
        <div class="col-md-12">
            <input class="form-control" name="issued_on" type="date" id="issued_on"
                value="{{ old('issued_on', optional($employeeCertification)->issued_on) }}" minlength="1"
                required="true" placeholder="Enter issued on here...">
            {!! $errors->first('issued_on', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('certification_number') ? 'has-error' : '' }}">
        <label for="certification_number" class="col-md-6 control-label">Certification Number</label>
        <div class="col-md-12">
            <input class="form-control" name="certification_number" type="text" id="certification_number"
                value="{{ old('certification_number', optional($employeeCertification)->certification_number) }}"
                minlength="1" placeholder="Enter certification number here...">
            {!! $errors->first('certification_number', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('category') ? 'has-error' : '' }}">
        <label for="category" class="col-md-4 control-label">Category</label>
        <div class="col-md-12">
            <select class="form-control" id="category" name="category" required="true">
                <option value="" style="display: none;"
                    {{ old('category', optional($employeeCertification)->category ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select skill category</option>
                @foreach ($skillCategories as $key => $skillCategory)
                    <option value="{{ $key }}"
                        {{ old('category', optional($employeeCertification)->category) == $key ? 'selected' : '' }}>
                        {{ $skillCategory }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('verification_link') ? 'has-error' : '' }}">
        <label for="verification_link" class="col-md-4 control-label">Verification Link</label>
        <div class="col-md-12">
            <input class="form-control" name="verification_link" type="text" id="verification_link"
                value="{{ old('verification_link', optional($employeeCertification)->verification_link) }}"
                minlength="1" placeholder="Enter verification link here...">
            {!! $errors->first('verification_link', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('vendor') ? 'has-error' : '' }}">
        <label for="vendor" class="col-md-4 control-label">Vendor</label>
        <div class="col-md-12">
            <select class="form-control" id="vendor" name="vendor">
                <option value="" style="display: none;"
                    {{ old('vendor', optional($employeeCertification)->vendor ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select certification vendor</option>
                @foreach ($certificationVendors as $key => $certificationVendor)
                    <option value="{{ $key }}"
                        {{ old('vendor', optional($employeeCertification)->vendor) == $key ? 'selected' : '' }}>
                        {{ $certificationVendor }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('vendor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('attachment') ? 'has-error' : '' }}">
        <label for="attachment" class="col-md-4 control-label">Attachment</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="attachment" id="attachment" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeCertification->attachment) && !empty($employeeCertification->attachment))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_attachment" class="custom-delete-file" value="1"
                            {{ old('custom_delete_attachment', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeCertification->attachment }}
                    </span>
                </div>
            @endif
            {!! $errors->first('attachment', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('expires_on') ? 'has-error' : '' }}">
        <label for="expires_on" class="col-md-4 control-label">Expires On</label>
        <div class="col-md-12">
            <input class="form-control" name="expires_on" type="date" id="expires_on"
                value="{{ old('expires_on', optional($employeeCertification)->expires_on) }}"
                placeholder="Enter expires on here...">
            {!! $errors->first('expires_on', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>