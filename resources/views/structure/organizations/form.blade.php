<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="row">
    <div class="form-group col-md-5 {{ $errors->has('en_name') ? 'has-error' : '' }}">
        <label for="en_name" class="col-md-12 control-label">English Name <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="en_name" type="text" id="en_name"
                value="{{ old('en_name', optional($organization)->en_name) }}" minlength="5" required="true"
                placeholder="Enter English name here...">
        </div>
    </div>

    <div class="form-group col-md-5 {{ $errors->has('am_name') ? 'has-error' : '' }}">
        <label for="am_name" class="col-md-12 control-label">Amharic Name <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input class="form-control" name="am_name" type="text" id="am_name"
                value="{{ old('am_name', optional($organization)->am_name) }}" minlength="5"
                placeholder="Enter amharic name here...">
        </div>
    </div>

    <div class="form-group col-md-2 {{ $errors->has('abbreviation') ? 'has-error' : '' }}">
        <label for="abbreviation" class="col-md-12 control-label">Abbreviation </label>
        <div class="col-md-12">
            <input class="form-control" name="abbreviation" type="text" id="abbreviation"
                value="{{ old('abbreviation', optional($organization)->abbreviation) }}" minlength="2"
                placeholder="Enter abbreviation here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('motto') ? 'has-error' : '' }}">
        <label for="motto" class="col-md-12 control-label">Motto</label>
        <div class="col-md-12">
            <input class="form-control" name="motto" type="text" id="motto"
                value="{{ old('motto', optional($organization)->motto) }}" minlength="10"
                placeholder="Enter motto here...">
        </div>
    </div>

    <div class="form-group col-md-4{{ $errors->has('mission') ? 'has-error' : '' }}">
        <label for="mission" class="col-md-12 control-label">Mission</label>
        <div class="col-md-12">
            <input class="form-control" name="mission" type="text" id="mission"
                value="{{ old('mission', optional($organization)->mission) }}" minlength="10"
                placeholder="Enter mission here...">
        </div>
    </div>

    <div class="form-group col-md-4{{ $errors->has('vision') ? 'has-error' : '' }}">
        <label for="vision" class="col-md-12 control-label">Vision</label>
        <div class="col-md-12">
            <input class="form-control" name="vision" type="text" id="vision"
                value="{{ old('vision', optional($organization)->vision) }}" minlength="10"
                placeholder="Enter vision here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('logo') ? 'has-error' : '' }}">
        <label for="logo" class="col-md-12 control-label">Logo</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        <input type="file" name="logo" id="logo" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>
            @if (isset($organization->logo) && !empty($organization->logo))
                <div class="input-group input-width-input">
                    <span class="input-group-addon mr-2">
                        <input type="checkbox" name="custom_delete_logo" class="custom-delete-file" value="1"
                            {{ old('custom_delete_logo', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name text-success">
                        {{ $organization->logo }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('header') ? 'has-error' : '' }}">
        <label for="header" class="col-md-12 control-label">Header</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        <input type="file" name="header" id="header" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>
            @if (isset($organization->header) && !empty($organization->header))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_header" class="custom-delete-file" value="1"
                            {{ old('custom_delete_header', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>
                    <span class="input-group-addon custom-delete-file-name">
                        {{ $organization->header }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('footer') ? 'has-error' : '' }}">
        <label for="footer" class="col-md-12 control-label">Footer</label>
        <div class="col-md-12">
            <div class="input-group uploaded-file-group">
                <label class="input-group-prepend">
                    <span class="btn btn-default">
                        <input type="file" name="footer" id="footer" class="hidden">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($organization->footer) && !empty($organization->footer))
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_footer" class="custom-delete-file" value="1"
                            {{ old('custom_delete_footer', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>
                    <span class="input-group-addon custom-delete-file-name">
                        {{ $organization->footer }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('address') ? 'has-error' : '' }}">
        <label for="address" class="col-md-12 control-label">Address</label>
        <div class="col-md-12">
            <input class="form-control" name="address" type="text" id="address"
                value="{{ old('address', optional($organization)->address) }}" minlength="10"
                placeholder="Enter address here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('website') ? 'has-error' : '' }}">
        <label for="website" class="col-md-12 control-label">Website</label>
        <div class="col-md-12">
            <input class="form-control" name="website" type="text" id="website"
                value="{{ old('website', optional($organization)->website) }}" minlength="5"
                placeholder="Enter website here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('email') ? 'has-error' : '' }}">
        <label for="email" class="col-md-12 control-label">Email</label>
        <div class="col-md-12">
            <input class="form-control" name="email" type="email" id="email"
                value="{{ old('email', optional($organization)->email) }}" placeholder="Enter email here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('phone_number') ? 'has-error' : '' }}">
        <label for="phone_number" class="col-md-12 control-label">Phone Number</label>
        <div class="col-md-12">
            <input class="form-control" name="phone_number" type="tel" id="phone_number"
                value="{{ old('phone_number', optional($organization)->phone_number) }}" min="0"
                placeholder="Enter phone number here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('fax_number') ? 'has-error' : '' }}">
        <label for="fax_number" class="col-md-12 control-label">Fax Number</label>
        <div class="col-md-12">
            <input class="form-control" name="fax_number" type="tel" id="fax_number"
                value="{{ old('fax_number', optional($organization)->fax_number) }}" min="0"
                placeholder="Enter fax number here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('po_box') ? 'has-error' : '' }}">
        <label for="po_box" class="col-md-12 control-label">P.O. Box</label>
        <div class="col-md-12">
            <input class="form-control" name="po_box" type="text" id="po_box"
                value="{{ old('po_box', optional($organization)->po_box) }}" minlength="1"
                placeholder="Enter PO Box here...">
        </div>
    </div>
</div>
