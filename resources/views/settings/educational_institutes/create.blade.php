@extends('layouts.app')
@section('pagetitle')
{{(__('setting.NewEducationalInstitute'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">{{(__('setting.Setting'))}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('educational_institutes.educational_institute.index') }}">{{(__('setting.EducationalInstitutes'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('setting.CreateNewEducationalInstitute'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('educational_institutes.educational_institute.store') }}"
                accept-charset="UTF-8" id="create_educational_institute_form" name="create_educational_institute_form"
                class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.educational_institutes.form', [
                'educationalInstitute' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('educational_institutes.educational_institute.index') }}"
                            class="btn btn-warning mr-5" title="Show All Educational Institute">
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
            $('#create_educational_institute_form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                    },
                    abbreviation: {
                        minlength: 1
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name",
                        minlength: "Your name must be at least 2 characters long"
                    },
                    abbreviation: {
                        minlength: "Your description must be at least 2 characters long"
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
