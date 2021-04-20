@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Edit Bank Account'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_bank_accounts.employee_bank_account.index', $employee) }}">{{(__('employee.Bank Account'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Bank Account'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('employee_bank_accounts.employee_bank_account.update', ['employee' => $employee->id, 'employeeBankAccount' => $employeeBankAccount->id]) }}"
                id="edit_employee_bank_account_form" name="edit_employee_bank_account_form" accept-charset="UTF-8"
                class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.bank_account.form', [
                'employeeBankAccount' => $employeeBankAccount,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('employee_bank_accounts.employee_bank_account.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Bank Account">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
