@extends('layouts.employee')
@section('pagetitle')
    Emergencies
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Emergencies</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Emergencies List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeEmergencies) == 0)
                <h4 class="text-center">No Emergencies Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Relationship</th>
                            <th>Address</th>
                            <th>House Number</th>
                            <th>Other Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeEmergencies as $employeeEmergency)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeEmergency->name }}</td>
                                <td>{{ $employeeEmergency->phone_number }}</td>
                                <td>{{ $employeeEmergency->relationships->name }}</td>
                                <td>{{ $employeeEmergency->address }}</td>
                                <td>{{ $employeeEmergency->house_number }}</td>
                                <td>{{ $employeeEmergency->other_phone }}</td>
                                <td>
                                    @if ($employeeEmergency->status == 1)
                                        Pending
                                    @elseif($employeeEmergency->status == 2)
                                        Rejected
                                    @else
                                        Approved
                                    @endif
                                </td>
                                <td>
                                    @if ($employeeEmergency->status == 1)
                                        <a href="{{ route('employee_emergencies.employee_emergency.approve', ['employee' => $employeeEmergency->employees->id, 'employeeEmergency' => $employeeEmergency->id]) }}"
                                            class="btn btn-outline-success mr-3" title="Approve Emergency">
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
                                                        <h4 class="modal-title">Reject Emergency</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{!! route('employee_emergencies.employee_emergency.reject', ['employee' => $employeeEmergency->employees->id, 'employeeEmergency' => $employeeEmergency->id]) !!}"
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
                                    @elseif($employeeEmergency->status == 2)
                                        <form method="POST" action="{!! route('employee_emergencies.employee_emergency.destroy', ['employee' => $employeeEmergency->employees->id, 'employeeEmergency' => $employeeEmergency->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <button type="submit" class="btn btn-danger" title="Delete Emergency"
                                                    onclick="return confirm(&quot;Click Ok to delete Emergency.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <form method="POST" action="{!! route('employee_emergencies.employee_emergency.destroy', ['employee' => $employeeEmergency->employees->id, 'employeeEmergency' => $employeeEmergency->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('employee_emergencies.employee_emergency.edit', ['employee' => $employeeEmergency->employees->id, 'employeeEmergency' => $employeeEmergency->id]) }}"
                                                    class="btn btn-warning" title="Edit Emergency">
                                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="Delete Emergency"
                                                    onclick="return confirm(&quot;Click Ok to delete Emergency.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
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
                {{ $employeeEmergencies->links() }}
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('employee_emergencies.employee_emergency.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Employee Emergency">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
    @if (count($employeeEmergencies) > 0)
        <a href="{{ route('employee_emergencies.employee_emergency.print', $employee) }}" class="btn btn-primary" title="Print Employee Emergency" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> Print</span>
        </a>
    @endif
@endsection
