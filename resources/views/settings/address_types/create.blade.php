@extends('layouts.app')
@section('pagetitle')
    New Address Type
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('address_types.address_type.index') }}">Address Type</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Address Type</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('address_types.address_type.store') }}" accept-charset="UTF-8"
                id="create_address_type_form" name="create_address_type_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.address_types.form', [
                'addressType' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Add">
                        <a href="{{ route('address_types.address_type.index') }}" class="btn btn-warning mr-5"
                            title="Show All Address Type">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
