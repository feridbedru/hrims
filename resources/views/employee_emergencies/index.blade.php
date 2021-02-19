@extends('layouts.employee')
@section('pagetitle')
    Employee Emergencies
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Employee Emergencies</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Employee Emergencies List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($employeeEmergencies) == 0)
                <h4 class="text-center">No Employee Emergencies Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
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
                                {{-- {{ dd($employeeEmergency)}} --}}
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeEmergency->en_name}}</td>
                                <td>{{ $employeeEmergency->name }}</td>
                                <td>{{ $employeeEmergency->phone_number }}</td>
                                <td>{{ $employeeEmergency->relation }}</td>
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
                                        <a href="{{ route('employee_emergencies.employee_emergency.approve', $employeeEmergency->id) }}"
                                            class="btn btn-outline-success mr-3" title="Approve Employee Emergency">
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
                                                        <h4 class="modal-title">Reject Employee Emergency</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST"
                                                        action="{!!  route('employee_emergencies.employee_emergency.reject', $employeeEmergency->id) !!}"
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
                                        <form method="POST"
                                            action="{!!  route('employee_emergencies.employee_emergency.destroy', $employeeEmergency->id) !!}"
                                            accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <button type="submit" class="btn btn-danger"
                                                    title="Delete Employee Emergency"
                                                    onclick="return confirm(&quot;Click Ok to delete Employee Emergency.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <form method="POST"
                                            action="{!!  route('employee_emergencies.employee_emergency.destroy', $employeeEmergency->id) !!}"
                                            accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('employee_emergencies.employee_emergency.edit', $employeeEmergency->id) }}"
                                                    class="btn btn-warning" title="Edit Employee Emergency">
                                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger"
                                                    title="Delete Employee Emergency"
                                                    onclick="return confirm(&quot;Click Ok to delete Employee Emergency.&quot;)">
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
                {!! $employeeEmergencies->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_emergencies.employee_emergency.create') }}" class="btn btn-success"
        title="Create New Employee Emergency">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
