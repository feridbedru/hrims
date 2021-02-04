@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
@endsection
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('title') ? 'has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">Title</label>
        <div class="col-md-12">
            <input class="form-control" name="title" type="text" id="title"
                value="{{ old('title', optional($help)->title) }}" minlength="1" maxlength="255" required="true"
                placeholder="Enter title here...">
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('description') ? 'has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">Description</label>
        <div class="col-md-12">
            <input class="form-control" name="description" type="text" id="description"
                value="{{ old('description', optional($help)->description) }}" minlength="1" maxlength="1000">
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('data') ? 'has-error' : '' }}">
    <label for="data" class="col-md-2 control-label">Data</label>
    <div class="col-md-12">
        <textarea class="textarea pad" name="data" id="data"
            required="true" placeholder="Enter data here...">{{ old('data', optional($help)->data) }}</textarea>
        {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('topic_for') ? 'has-error' : '' }}">
        <label for="topic_for" class="col-md-4 control-label">Topic For</label>
        <div class="col-md-12">
            <input class="form-control" name="topic_for" type="text" id="topic_for"
                value="{{ old('topic_for', optional($help)->topic_for) }}" minlength="1" required="true"
                placeholder="Enter topic for here...">
            {!! $errors->first('topic_for', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('parent') ? 'has-error' : '' }}">
        <label for="parent" class="col-md-4 control-label">Parent</label>
        <div class="col-md-12">
            <select class="form-control" id="parent" name="parent">
                <option value="" style="display: none;"
                    {{ old('parent', optional($help)->parent ?: '') == '' ? 'selected' : '' }} disabled selected>
                    Select Parent</option>
                @foreach ($helps as $key => $help)
                    <option value="{{ $key }}"
                        {{ old('parent', optional($help)->parent) == $key ? 'selected' : '' }}>
                        {{ $help }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('parent', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group col-md-4 {{ $errors->has('language_id') ? 'has-error' : '' }}">
        <label for="language_id" class="col-md-4 control-label">Language</label>
        <div class="col-md-12">
            <select class="form-control" id="language_id" name="language_id" required="true">
                <option value="" style="display: none;"
                    {{ old('language_id', optional($help)->language_id ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Enter language here...</option>
                @foreach ($languages as $key => $language)
                    <option value="{{ $key }}"
                        {{ old('language_id', optional($help)->language_id) == $key ? 'selected' : '' }}>
                        {{ $language }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('language_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('created_by') ? 'has-error' : '' }}">
    <label for="created_by" class="col-md-2 control-label">Created By</label>
    <div class="col-md-10">
        <select class="form-control" id="created_by" name="created_by">
            <option value="" style="display: none;"
                {{ old('created_by', optional($help)->created_by ?: '') == '' ? 'selected' : '' }} disabled selected>
                Select created by</option>
            @foreach ($creators as $key => $creator)
                <option value="{{ $key }}"
                    {{ old('created_by', optional($help)->created_by) == $key ? 'selected' : '' }}>
                    {{ $creator }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@section('javascripts')
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function() {
    $('#data').summernote({
        height: 400
    });
    });
  </script>
@endsection