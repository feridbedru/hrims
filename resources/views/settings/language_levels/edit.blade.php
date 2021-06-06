@extends('layouts.app')
@section('pagetitle')
{{(__('employee.Edit Language Levels'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">{{(__('setting.Setting'))}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('language_levels.language_level.index') }}">{{(__('employee.Language Levels'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Language Levels'))}}</h3>
        </div>
        <div class="card-body">
            @permission('setting_LanguageLevels_Edit')
            <form method="POST" action="{{ route('language_levels.language_level.update', $languageLevel->id) }}"
                id="edit_language_level_form" name="edit_language_level_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('settings.language_levels.form', [
                'languageLevel' => $languageLevel,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('language_levels.language_level.index') }}" class="btn btn-warning"
                            title="Show All Language Level">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $(function() {
            $('#edit_language_level_form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                    },
                    description: {
                        minlength: 1
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name",
                        minlength: "Your name must be at least 2 characters long"
                    },
                    description: {
                        minlength: "Your description must be at least 1 characters long"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

    </script>
@endsection
