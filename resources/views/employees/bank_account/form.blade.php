<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('bank') ? 'has-error' : '' }}">
        <label for="bank" class="col-md-4 control-label">Bank</label>
        <div class="col-md-12">
            <select class="form-control" id="bank" name="bank" required="true">
                <option value="" style="display: none;"
                    {{ old('bank', optional($employeeBankAccount)->bank ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select bank</option>
                @foreach ($banks as $key => $bank)
                    <option value="{{ $key }}"
                        {{ old('bank', optional($employeeBankAccount)->bank) == $key ? 'selected' : '' }}>
                        {{ $bank }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('account_type') ? 'has-error' : '' }}">
        <label for="account_type" class="col-md-4 control-label">Bank Account Type</label>
        <div class="col-md-12">
            <select class="form-control" id="account_type" name="account_type" required="true">
                <option value="" style="display: none;"
                    {{ old('account_type', optional($employeeBankAccount)->account_type ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Enter bank account type here...</option>
                @foreach ($bankAccountTypes as $key => $bankAccountType)
                    <option value="{{ $key }}"
                        {{ old('account_type', optional($employeeBankAccount)->account_type) == $key ? 'selected' : '' }}>
                        {{ $bankAccountType }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('account_number') ? 'has-error' : '' }}">
        <label for="account_number" class="col-md-4 control-label">Account Number</label>
        <div class="col-md-12">
            <input class="form-control" name="account_number" type="number" id="account_number"
                value="{{ old('account_number', optional($employeeBankAccount)->account_number) }}" required="true"
                placeholder="Enter account number here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('file') ? 'has-error' : '' }}">
        <label for="file" class="col-md-4 control-label">File</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="file" id="file" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($employeeBankAccount->file) && !empty($employeeBankAccount->file))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1"
                            {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $employeeBankAccount->file }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('created_by') ? 'has-error' : '' }}">
        <label for="created_by" class="col-md-4 control-label">Created By</label>
        <div class="col-md-12">
            <select class="form-control" id="created_by" name="created_by" required="true">
                <option value="" style="display: none;"
                    {{ old('created_by', optional($employeeBankAccount)->created_by ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select created by</option>
                @foreach ($creators as $key => $creator)
                    <option value="{{ $key }}"
                        {{ old('created_by', optional($employeeBankAccount)->created_by) == $key ? 'selected' : '' }}>
                        {{ $creator }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('employee') ? 'has-error' : '' }}">
        <label for="employee" class="col-md-4 control-label">Employee</label>
        <div class="col-md-12">
            <select class="form-control" id="employee" name="employee" required="true">
                <option value="" style="display: none;"
                    {{ old('employee', optional($employeeBankAccount)->employee ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select employee</option>
                @foreach ($employees as $key => $employee)
                    <option value="{{ $key }}"
                        {{ old('employee', optional($employeeBankAccount)->employee) == $key ? 'selected' : '' }}>
                        {{ $employee }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
