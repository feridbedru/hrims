@extends('layouts.app')
@section('pagetitle')
{{(__('setting.NewTemplate'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">{{(__('setting.Setting'))}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('templates.template.index') }}">{{(__('setting.Templates'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('setting.CreateNewTemplate'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('templates.template.store') }}" accept-charset="UTF-8"
                id="create_template_form" name="create_template_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.templates.form', [
                'template' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('templates.template.index') }}" class="btn btn-warning mr-5"
                            title="Show All Template">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
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
            $('#create_template_form').validate({
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
