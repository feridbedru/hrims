@extends('layouts.app')
@section('pagetitle')
{{(__('employee.Edit Zone'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('zones.zone.index') }}">{{(__('employee.Zone'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Zone'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('zones.zone.update', $zone->id) }}" id="edit_zone_form"
                name="edit_zone_form" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('settings.zones.form', [
                'zone' => $zone,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('zones.zone.index') }}" class="btn btn-warning mr-5" title="Show All Zone">
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
            $('#edit_zone_form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                    },
                    region: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name",
                        minlength: "Your name must be at least 2 characters long"
                    },
                    region: {
                        required: "Please choose region"
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
