@extends('layouts.app')
@section('pagetitle')
    New Organization Location
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('organization_locations.organization_location.index') }}">Organization
            Locations</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Organization Location</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('organization_locations.organization_location.store') }}"
                accept-charset="UTF-8" id="create_organization_location_form" name="create_organization_location_form"
                class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.organization_locations.form', [
                'organizationLocation' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 text-center mt-4 m-2">
                        <input class="btn btn-primary mr-5" type="submit" value="Save">
                        <a href="{{ route('organization_locations.organization_location.index') }}"
                            class="btn btn-warning mr-5" title="Show All Organization Location">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
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
            $('#create_organization_location_form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                    },
                    address: {
                        required: true,
                        minlength: 1
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name",
                        minlength: "Your name must be at least 2 characters long"
                    },
                    address: {
                        required: "Please enter an address",
                        minlength: "Your address must be at least 1 characters long"
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
