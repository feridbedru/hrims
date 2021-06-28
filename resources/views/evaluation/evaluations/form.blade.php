<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('title') ? 'has-error' : '' }}">
        <label for="title" class="col-md-12 control-label">{{ __('employee.Title') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="title" type="text" id="title"
                value="{{ old('title', optional($evaluation)->title) }}" minlength="1" maxlength="255" required="true"
                placeholder="Enter title here...">
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('time_period') ? 'has-error' : '' }}">
        <label for="time_period" class="col-md-12 control-label">{{ __('employee.Time Period') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="time_period" type="text" id="time_period"
                value="{{ old('time_period', optional($evaluation)->time_period) }}" minlength="1" required="true"
                placeholder="Enter time period here...">
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-12 control-label">{{ __('employee.Description') }}</label>
    <div class="col-md-12">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1"
            maxlength="1000">{{ old('description', optional($evaluation)->description) }}</textarea>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('evaluation_type_id') ? 'has-error' : '' }}">
        <label for="evaluation_type_id" class="col-md-12 control-label">{{ __('employee.Evaluation Type') }}</label>
        <div class="col-md-12">
            <select class="form-control" id="evaluation_type_id" name="evaluation_type_id" required="true">
                <option value="" style="display: none;"
                    {{ old('evaluation_type_id', optional($evaluation)->evaluation_type_id ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select evaluation type</option>
                @foreach ($evaluationTypes as $key => $evaluationType)
                    <option value="{{ $key }}"
                        {{ old('evaluation_type_id', optional($evaluation)->evaluation_type_id) == $key ? 'selected' : '' }}>
                        {{ $evaluationType }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('start_date') ? 'has-error' : '' }}">
        <label for="start_date" class="col-md-12 control-label">{{ __('employee.Start Date') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="start_date" type="text" id="start_date"
                value="{{ old('start_date', optional($evaluation)->start_date) }}" required="true"
                placeholder="Enter start date here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('end_date') ? 'has-error' : '' }}">
        <label for="end_date" class="col-md-12 control-label">{{ __('employee.End Date') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="end_date" type="text" id="end_date"
                value="{{ old('end_date', optional($evaluation)->end_date) }}" required="true"
                placeholder="Enter end date here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('job_category_id') ? 'has-error' : '' }}">
        <label for="job_category_id" class="col-md-12 control-label">{{ __('employee.Job Category') }}</label>
        <div class="col-md-12">
            <select class="form-control" id="job_category_id" name="job_category_id" required="true">
                <option value="" style="display: none;"
                    {{ old('job_category_id', optional($evaluation)->job_category_id ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select job category</option>
                @foreach ($jobCategories as $key => $jobCategory)
                    <option value="{{ $key }}"
                        {{ old('job_category_id', optional($evaluation)->job_category_id) == $key ? 'selected' : '' }}>
                        {{ $jobCategory }}
                    </option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="form-group col-md-8 {{ $errors->has('organization_units_id') ? 'has-error' : '' }}">
        <label for="organization_units_id"
            class="col-md-12 control-label">{{ __('employee.Organization Units') }}</label>
        <div class="col-md-12">
            <select class="form-control" id="organization_units_id" name="organization_units_id" required="true">
                <option value="" style="display: none;"
                    {{ old('organization_units_id', optional($evaluation)->organization_units_id ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select organization units</option>
                @foreach ($organizationUnits as $key => $organizationUnit)
                    <option value="{{ $key }}"
                        {{ old('organization_units_id', optional($evaluation)->organization_units_id) == $key ? 'selected' : '' }}>
                        {{ $organizationUnit }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-3 {{ $errors->has('self') ? 'has-error' : '' }}">
        <label for="self" class="col-md-12 control-label">{{ __('employee.Self') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="self" type="number" id="self"
                value="{{ old('self', optional($evaluation)->self) }}" min="1" max="100" required="true"
                placeholder="Enter self here...">
        </div>
    </div>

    <div class="form-group col-md-3 {{ $errors->has('peer') ? 'has-error' : '' }}">
        <label for="peer" class="col-md-12 control-label">{{ __('employee.Peer') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="peer" type="number" id="peer"
                value="{{ old('peer', optional($evaluation)->peer) }}" min="1" max="100" required="true"
                placeholder="Enter peer here...">
        </div>
    </div>

    <div class="form-group col-md-3 {{ $errors->has('team_leader') ? 'has-error' : '' }}">
        <label for="team_leader" class="col-md-12 control-label">{{ __('employee.Team Leader') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="team_leader" type="number" id="team_leader"
                value="{{ old('team_leader', optional($evaluation)->team_leader) }}" min="1" max="100"
                required="true" placeholder="Enter team leader here...">
        </div>
    </div>

    <div class="form-group col-md-3 {{ $errors->has('unit_leader') ? 'has-error' : '' }}">
        <label for="unit_leader" class="col-md-12 control-label">{{ __('employee.Unit Leader') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="unit_leader" type="number" id="unit_leader"
                value="{{ old('unit_leader', optional($evaluation)->unit_leader) }}" min="1" max="100"
                required="true" placeholder="Enter unit leader here...">
        </div>
    </div>
</div>

<div class="form-group col-md-8 {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-12 control-label">{{ __('employee.Status') }}</label>
    <div class="col-md-12">
        <select class="form-control" id="status" name="status" required="true">
            <option value="" style="display: none;"
                {{ old('status', optional($evaluation)->status ?: '') == '' ? 'selected' : '' }}
                disabled selected>Select Status</option>
            <option value="1"> Active </option>
            <option value="2"> Closed </option>
        </select>
    </div>
</div>