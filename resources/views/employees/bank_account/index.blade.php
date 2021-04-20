@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Bank Accounts'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Bank Accounts'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Bank Accounts List'))}}</h3>
        </div>

        <div class="card-body">
            @if (count($employeeBankAccounts) == 0)
                <h4 class="text-center">{{(__('employee.No Bank Accounts Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Banks'))}}</th>
                            <th>{{(__('setting.BankAccountType'))}}</th>
                            <th>{{(__('employee.Account Number'))}}</th>
                            <th>{{(__('employee.File'))}}</th>
                            <th>{{(__('employee.Status'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
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
                                    @if (isset($employeeBankAccount->file))
                                        <a href="{{ asset('uploads/bankaccount/' . $employeeBankAccount->file) }}" class="btn btn-outline-primary" target="_blank">{{(__('employee.View File'))}}</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($employeeBankAccount->status == 1)
                                        {{(__('employee.Pending'))}}
                                    @elseif($employeeBankAccount->status == 2)
                                        {{(__('employee.Rejected'))}}
                                    @else
                                        {{(__('employee.Approved'))}}
                                    @endif
                                </td>
                                <td>
                                    @if ($employeeBankAccount->status == 1)
                                        <a href="{{ route('employee_bank_accounts.employee_bank_account.approve', ['employee' => $employeeBankAccount->employees->id, 'employeeBankAccount' => $employeeBankAccount->id]) }}"
                                            class="btn btn-outline-success mr-3" title="Approve Bank Account">
                                            {{(__('employee.Approve'))}}
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modal-reject">
                                            {{(__('employee.Reject'))}}
                                        </button>
                                        <div class="modal fade" id="modal-reject">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h4 class="modal-title">{{(__('employee.Reject Bank Account'))}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{!! route('employee_bank_accounts.employee_bank_account.reject', ['employee' => $employeeBankAccount->employees->id, 'employeeBankAccount' => $employeeBankAccount->id]) !!}"
                                                        accept-charset="UTF-8">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <label for="note">{{(__('employee.Note'))}}</label>
                                                            <textarea class="form-control" name="note" cols="50" rows="10"
                                                                id="note" minlength="1" maxlength="1000"
                                                                required="true"></textarea>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">{{(__('employee.Close'))}}</button>
                                                            <input class="btn btn-danger" type="submit" value="Reject">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($employeeBankAccount->status == 2)
                                        <form method="POST" action="{!! route('employee_bank_accounts.employee_bank_account.destroy', ['employee' => $employeeBankAccount->employees->id, 'employeeBankAccount' => $employeeBankAccount->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <button type="submit" class="btn btn-outline-danger"
                                                    title="Delete Bank Account"
                                                    onclick="return confirm(&quot;Click Ok to delete Bank Account.&quot;)">
                                                    {{(__('setting.delete'))}}
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <form method="POST" action="{!! route('employee_bank_accounts.employee_bank_account.destroy', ['employee' => $employeeBankAccount->employees->id, 'employeeBankAccount' => $employeeBankAccount->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('employee_bank_accounts.employee_bank_account.edit', ['employee' => $employeeBankAccount->employees->id, 'employeeBankAccount' => $employeeBankAccount->id]) }}"
                                                    class="btn btn-outline-warning mr-3" title="Edit Bank Account">
                                                    {{(__('setting.edit'))}}
                                                </a>

                                                <button type="submit" class="btn btn-outline-danger"
                                                    title="Delete Bank Account"
                                                    onclick="return confirm(&quot;Click Ok to delete Bank Account.&quot;)">
                                                    {{(__('setting.delete'))}}
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeBankAccounts->links() }}
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('employee_bank_accounts.employee_bank_account.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Employee Bank Account">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @if (count($employeeBankAccounts) > 0)
        <a href="{{ route('employee_bank_accounts.employee_bank_account.print', $employee) }}" class="btn btn-primary" title="Print Employee Bank Account" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
    @endif
@endsection
