@extends('layouts.app')
@section('pagetitle')
    Edit Organization Location
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('organization_locations.organization_location.index') }}">Organization
            Locations</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-default">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title mb-1">Edit Organization Location</h3>
            </div>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('organization_locations.organization_location.update', $organizationLocation->id) }}"
                id="edit_organization_location_form" name="edit_organization_location_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('settings.organization_locations.form', [
                'organizationLocation' => $organizationLocation,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('organization_locations.organization_location.index') }}"
                            class="btn btn-warning" title="Show All Organization Location">
                            Cancel
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
            $('#edit_organization_location_form').validate({
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
