@extends('layouts.employee')
@section('pagetitle')
    Disabilities
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Disabilities</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Disabilities List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeDisabilities) == 0)
                <h4 class="text-center">No Disabilities Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Medical Certificate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeDisabilities as $employeeDisability)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeDisability->types->name }}</td>
                                <td>{{ $employeeDisability->description }}</td>
                                <td>
                                    @if(isset($employeeDisability->medical_certificate ))
                                    <a href="{{ asset('uploads/disability/' . $employeeDisability->medical_certificate) }}" class="btn btn-outline-primary" target="_blank">View File</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($employeeDisability->status == 1)
                                        Pending
                                    @elseif($employeeDisability->status == 2)
                                        Rejected
                                    @else
                                        Approved
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeDisability->status == 1)
                                        <a href="{{ route('employee_disabilities.employee_disability.approve', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) }}"
                                            class="btn btn-outline-success mr-3" title="Approve Disability">
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
                                                        <h4 class="modal-title">Reject Disability</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{!! route('employee_disabilities.employee_disability.reject', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) !!}"
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
                                    @elseif($employeeDisability->status == 2)
                                        <form method="POST" action="{!! route('employee_disabilities.employee_disability.destroy', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Disability"
                                                onclick="return confirm(&quot;Click Ok to delete Disability.&quot;)">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{!! route('employee_disabilities.employee_disability.destroy', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <a href="{{ route('employee_disabilities.employee_disability.edit', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) }}"
                                                class="btn btn-outline-warning mr-2" title="Edit Disability">
                                                Edit
                                            </a>
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Disability"
                                                onclick="return confirm(&quot;Click Ok to delete Disability.&quot;)">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeDisabilities->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_disabilities.employee_disability.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Disability">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
    @if (count($employeeDisabilities) > 0)
        <a href="{{ route('employee_disabilities.employee_disability.print', $employee) }}" class="btn btn-primary" title="Print Employee Disability" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> Print</span>
        </a>
    @endif
@endsection
