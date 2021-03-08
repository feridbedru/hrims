@extends('layouts.employee')
@section('pagetitle')
    Addresses
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Address</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Address List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeAddresses) == 0)
                <h4 class="text-center">No Address Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Address Type</th>
                            <th>Address</th>
                            <th>House Number</th>
                            <th>Woreda</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeAddresses as $employeeAddress)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeAddress->employees->en_name }}</td>
                                <td>{{ $employeeAddress->types->name }}</td>
                                <td>{{ $employeeAddress->address }}</td>
                                <td>{{ $employeeAddress->house_number }}</td>
                                <td>{{ optional($employeeAddress->woredas)->name }}</td>
                                <td>
                                    @if ($employeeAddress->status == 1)
                                        Pending
                                    @elseif($employeeAddress->status == 2)
                                        Rejected
                                    @else
                                        Approved
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeAddress->status == 1)
                                        <a href="{{ route('employee_addresses.employee_address.approve', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) }}"
                                            class="btn btn-outline-success mr-3" title="Approve Employee Address">
                                            Approve
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modal-reject">
                                            Reject
                                        </button>
                                        <div class="modal fade" id="modal-reject">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h4 class="modal-title">Reject Address</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{!! route('employee_addresses.employee_address.reject', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) !!}"
                                                        accept-charset="UTF-8">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <label for="note">Note</label>
                                                            <textarea class="form-control" name="note" cols="50" rows="10"
                                                                id="note" minlength="1" maxlength="1000"
                                                                required="true"></textarea>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <input class="btn btn-danger" type="submit" value="Reject">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($employeeAddress->status == 2)
                                        <form method="POST" action="{!! route('employee_addresses.employee_address.destroy', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <button type="submit" class="btn btn-outline-danger" title="Delete Address"
                                                    onclick="return confirm(&quot;Click Ok to delete Employee Address.&quot;)">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <form method="POST" action="{!! route('employee_addresses.employee_address.destroy', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <a href="{{ route('employee_addresses.employee_address.edit', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) }}"
                                                class="btn btn-outline-warning mr-3" title="Edit Address">
                                                Edit
                                            </a>
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Address"
                                                onclick="return confirm(&quot;Click Ok to delete Address.&quot;)">
                                                Delete
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeAddresses->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_addresses.employee_address.create', $employee) }}" class="btn btn-success"
        title="Create New Employee Address">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
