@extends('layouts.app')
@section('pagetitle')
{{(__('setting.NewWoreda'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('woredas.woreda.index') }}">{{(__('setting.Woreda'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('setting.CreateNewWoreda'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('woredas.woreda.store') }}" accept-charset="UTF-8"
                id="create_woreda_form" name="create_woreda_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.woredas.form', [
                'woreda' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('woredas.woreda.index') }}" class="btn btn-warning mr-5"
                            title="Show All Woreda">
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
            $('#create_woreda_form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                    },
                    zone: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name",
                        minlength: "Your name must be at least 2 characters long"
                    },
                    zone: {
                        required: "Please choose zone"
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