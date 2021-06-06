@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Bank Accounts'))}}
@endsection
@section('content')
@permission('bankAccount_print')
    @if (count($employeeBankAccounts) == 0)
        <h4 class="text-center">{{(__('employee.No Bank Accounts Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Banks') }}</th>
                    <th>{{ __('setting.BankAccountType') }}</th>
                    <th>{{ __('employee.Account Number') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeBankAccounts as $employeeBankAccount)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeBankAccount->banks->name }}</td>
                        <td>{{ $employeeBankAccount->types->name }}</td>
                        <td>{{ $employeeBankAccount->account_number }}</td>
                        <td>
                            @if ($employeeBankAccount->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeBankAccount->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
