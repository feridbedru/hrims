@extends('layouts.printer')
@section('pagetitle')
    Bank Account
@endsection
@section('content')
    @if (count($employeeBankAccounts) == 0)
        <h4 class="text-center">No Bank Accounts Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bank</th>
                    <th>Bank Account Type</th>
                    <th>Account Number</th>
                    <th>Status</th>
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
                                Pending
                            @elseif($employeeBankAccount->status == 2)
                                Rejected
                            @else
                                Approved
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
