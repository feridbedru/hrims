@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.New Bank Account'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_bank_accounts.employee_bank_account.index', $employee) }}">{{(__('employee.Bank Account'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('employee.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Bank Account'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee_bank_accounts.employee_bank_account.store', $employee) }}"
                accept-charset="UTF-8" id="create_employee_bank_account_form" name="create_employee_bank_account_form"
                class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('employees.bank_account.form', [
                'employeeBankAccount' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('employee_bank_accounts.employee_bank_account.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Bank Account">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
