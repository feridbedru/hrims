<div class="row">
    <div class="form-group col-md-8 {{ $errors->has('en_name') ? 'has-error' : '' }}">
        <label for="en_name" class="col-md-4 control-label">English Name</label>
        <div class="col-md-12">
            <input class="form-control" name="en_name" type="text" id="en_name"
                value="{{ old('en_name', optional($organizationUnit)->en_name) }}" minlength="1"
                placeholder="Enter english name here...">
            {!! $errors->first('en_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('en_acronym') ? 'has-error' : '' }}">
        <label for="en_acronym" class="col-md-4 control-label">English Acronym</label>
        <div class="col-md-12">
            <input class="form-control" name="en_acronym" type="text" id="en_acronym"
                value="{{ old('en_acronym', optional($organizationUnit)->en_acronym) }}" minlength="1"
                placeholder="Enter english acronym here...">
            {!! $errors->first('en_acronym', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-8 {{ $errors->has('am_name') ? 'has-error' : '' }}">
        <label for="am_name" class="col-md-4 control-label">Amharic Name</label>
        <div class="col-md-12">
            <input class="form-control" name="am_name" type="text" id="am_name"
                value="{{ old('am_name', optional($organizationUnit)->am_name) }}" minlength="1"
                placeholder="Enter amharic name here...">
            {!! $errors->first('am_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('am_acronym') ? 'has-error' : '' }}">
        <label for="am_acronym" class="col-md-4 control-label">Amharic Acronym</label>
        <div class="col-md-12">
            <input class="form-control" name="am_acronym" type="text" id="am_acronym"
                value="{{ old('am_acronym', optional($organizationUnit)->am_acronym) }}" minlength="1"
                placeholder="Enter amharic acronym here...">
            {!! $errors->first('am_acronym', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('parent') ? 'has-error' : '' }}">
        <label for="parent" class="col-md-4 control-label">Parent</label>
        <div class="col-md-12">
            <select class="form-control" id="parent" name="parent">
                <option value="" style="display: none;"
                    {{ old('parent', optional($organizationUnit)->parent ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select organization unit</option>
                @foreach ($organizationUnits as $key => $organizationUnit)
                    <option value="{{ $key }}"
                        {{ old('parent', optional($organizationUnit)->parent) == $key ? 'selected' : '' }}>
                        {{ $organizationUnit }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('parent', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('job_category') ? 'has-error' : '' }}">
        <label for="job_category" class="col-md-4 control-label">Job Category</label>
        <div class="col-md-12">
            <select class="form-control" id="job_category" name="job_category">
                <option value="" style="display: none;"
                    {{ old('job_category', optional($organizationUnit)->job_category ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select job category</option>
                @foreach ($jobCategories as $key => $jobCategory)
                    <option value="{{ $key }}"
                        {{ old('job_category', optional($organizationUnit)->job_category) == $key ? 'selected' : '' }}>
                        {{ $jobCategory }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('job_category', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group col-md-4 {{ $errors->has('location') ? 'has-error' : '' }}">
        <label for="location" class="col-md-4 control-label">Location</label>
        <div class="col-md-12">
            <select class="form-control" id="location" name="location">
                <option value="" style="display: none;"
                    {{ old('location', optional($organizationUnit)->location ?: '') == '' ? 'selected' : 'selected' }}
                    disabled selected>Select organization location</option>
                @foreach ($organizationLocations as $key => $organizationLocation)
                    <option value="{{ $key }}"
                        {{ old('location', optional($organizationUnit)->location) == $key ? 'selected' : '' }}>
                        {{ $organizationLocation }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('reports_to') ? 'has-error' : '' }}">
        <label for="reports_id" class="col-md-4 control-label">Reports To</label>
        <div class="col-md-12">
            <select class="form-control" id="reports_to" name="reports_to">
                <option value="" style="display: none;"
                    {{ old('reports_to', optional($organizationUnit)->reports_to ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select organization unit</option>
                @foreach ($organizationUnits as $key => $organizationUnit)
                    <option value="{{ $key }}"
                        {{ old('reports_to', optional($organizationUnit)->reports_to) == $key ? 'selected' : '' }}>
                        {{ $organizationUnit }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('reports_to', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group col-md-4 {{ $errors->has('chairman') ? 'has-error' : '' }}">
        <label for="chairman" class="col-md-4 control-label">Chairman</label>
        <div class="col-md-12">
            <select class="form-control" id="chairman" name="chairman">
                <option value="" style="display: none;"
                    {{ old('chairman', optional($organizationUnit)->chairman ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select Chairman</option>
                @foreach ($chairmans as $key => $chairman)
                    <option value="{{ $key }}"
                        {{ old('chairman', optional($chairman)->chairman) == $key ? 'selected' : '' }}>
                        {{ $chairman }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('reports_to', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group col-md-2 {{ $errors->has('is_root_unit') ? 'has-error' : '' }}">
        <label for="is_root_unit" class="col-md-6 control-label">Is Root Unit</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_root_unit_1">
                    <input id="is_root_unit_1" class="mt-2 mr-2" name="is_root_unit" type="checkbox" value="1"
                        {{ old('is_root_unit', optional($organizationUnit)->is_root_unit) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_root_unit', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-2 {{ $errors->has('is_category') ? 'has-error' : '' }}">
        <label for="is_category" class="col-md-6 control-label">Is Category</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_category_1">
                    <input id="is_category_1" class="mt-2 mr-2" name="is_category" type="checkbox" value="1"
                        {{ old('is_category', optional($organizationUnit)->is_category) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_category', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('phone_number') ? 'has-error' : '' }}">
        <label for="phone_number" class="col-md-4 control-label">Phone Number</label>
        <div class="col-md-12">
            <input class="form-control" name="phone_number" type="number" id="phone_number"
                value="{{ old('phone_number', optional($organizationUnit)->phone_number) }}"
                placeholder="Enter phone number here...">
            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('email_address') ? 'has-error' : '' }}">
        <label for="email_address" class="col-md-4 control-label">Email Address</label>
        <div class="col-md-12">
            <input class="form-control" name="email_address" type="email" id="email_address"
                value="{{ old('email_address', optional($organizationUnit)->email_address) }}"
                placeholder="Enter email address here...">
            {!! $errors->first('email_address', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('web_page') ? 'has-error' : '' }}">
        <label for="web_page" class="col-md-4 control-label">Web Page</label>
        <div class="col-md-12">
            <input class="form-control" name="web_page" type="text" id="web_page"
                value="{{ old('web_page', optional($organizationUnit)->web_page) }}"
                placeholder="Enter web page here...">
            {!! $errors->first('web_page', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
