@extends('layouts.app')
@section('pagetitle')
{{(__('employee.Edit Template'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">{{(__('setting.Setting'))}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('templates.template.index') }}">{{(__('employee.Template'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Template'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('templates.template.update', $template->id) }}" id="edit_template_form"
                name="edit_template_form" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('settings.templates.form', [
                'template' => $template,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('templates.template.index') }}" class="btn btn-warning mr-5"
                            title="Show All Template">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $(function() {
            $('#edit_template_form').validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 2,
                    },
                    body: {
                        required: true,
                        minlength: 1
                    },
                    language: {
                        required: true
                    },
                    template_type: {
                        required: true
                    },
                    code: {
                        required: true
                    },
                },
                messages: {
                    title: {
                        required: "Please enter a title",
                        minlength: "Your title must be at least 2 characters long"
                    },
                    body: {
                        required: "Please enter a body",
                        minlength: "Your body must be at least 1 characters long"
                    },
                    language: {
                        required: "Please choose a language"
                    },
                    template_type: {
                        required: "Please choose a template type"
                    },
                    code: {
                        required: "Please enter a code"
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
