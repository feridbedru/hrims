<div class="row">
    <div class="form-group col-md-4{{ $errors->has('evaluation_id') ? 'has-error' : '' }}">
        <label for="evaluation_id" class="col-md-12 control-label">{{ __('employee.Evaluation') }}</label>
        <div class="col-md-12">
            <select class="form-control" id="evaluation_id" name="evaluation_id" required="true">
                <option value="" style="display: none;"
                    {{ old('evaluation_id', optional($evaluationQuestion)->evaluation_id ?: '') == '' ? 'selected' : '' }}
                    disabled selected>Select evaluation</option>
                @foreach ($evaluations as $key => $evaluation)
                    <option value="{{ $key }}"
                        {{ old('evaluation_id', optional($evaluationQuestion)->evaluation_id) == $key ? 'selected' : '' }}>
                        {{ $evaluation }}
                    </option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="form-group col-md-8 {{ $errors->has('criteria') ? 'has-error' : '' }}">
        <label for="criteria" class="col-md-12 control-label">{{ __('employee.Criteria') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="criteria" type="text" id="criteria"
                value="{{ old('criteria', optional($evaluationQuestion)->criteria) }}" minlength="1" required="true"
                placeholder="Enter criteria here...">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('weight') ? 'has-error' : '' }}">
        <label for="weight" class="col-md-12 control-label">{{ __('employee.Weight') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="weight" type="number" id="weight"
                value="{{ old('weight', optional($evaluationQuestion)->weight) }}" min="1" max="2147483647"
                required="true" placeholder="Enter weight here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('order') ? 'has-error' : '' }}">
        <label for="order" class="col-md-12 control-label">{{ __('employee.Order') }}</label>
        <div class="col-md-12">
            <input class="form-control" name="order" type="number" id="order"
                value="{{ old('order', optional($evaluationQuestion)->order) }}" min="1" max="2147483647"
                required="true" placeholder="Enter order here...">
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('status') ? 'has-error' : '' }}">
        <label for="status" class="col-md-12 control-label">{{ __('employee.Status') }}</label>
        <div class="col-md-12">
            <select class="form-control" id="status" name="status" required="true">
                <option value="" style="display: none;"
                    {{ old('status', optional($evaluationQuestion)->status ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select Status</option>
                <option value="1"> Active </option>
                <option value="2"> Closed </option>
            </select>
        </div>
    </div>
</div>
