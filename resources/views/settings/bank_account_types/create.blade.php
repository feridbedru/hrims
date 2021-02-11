@extends('layouts.app')
@section('pagetitle')
    New Bank Account Type
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bank_account_types.bank_account_type.index') }}">Bank Account Type</a>
    </li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Bank Account Type</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('bank_account_types.bank_account_type.store') }}" accept-charset="UTF-8"
                id="create_bank_account_type_form" name="create_bank_account_type_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.bank_account_types.form', [
                'bankAccountType' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Add">
                        <a href="{{ route('bank_account_types.bank_account_type.index') }}" class="btn btn-warning mr-5"
                            title="Show All Bank Account Type">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
