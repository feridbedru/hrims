<h6 class="ml-2">Fields denoted with <span class="text-danger">*</span> are required.</h6>
<hr>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Woreda Name <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($woreda)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="Enter name here...">
    </div>
</div>

<div class="form-group {{ $errors->has('zone') ? 'has-error' : '' }}">
    <label for="zone" class="col-md-4 control-label">Zone <span class="text-danger">*</span></label>
    <div class="col-md-12">
        <select class="form-control" id="zone" name="zone" required="true">
            <option value="" style="display: none;"
                {{ old('zone', optional($woreda)->zone ?: '') == '' ? 'selected' : '' }} disabled selected>Select zone
            </option>
            @foreach ($zones as $key => $zone)
                <option value="{{ $key }}"
                    {{ old('zone', optional($woreda)->zone) == $key ? 'selected' : '' }}>
                    {{ $zone }}
                </option>
            @endforeach
        </select>
    </div>
</div>
