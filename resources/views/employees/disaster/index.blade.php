@extends('layouts.employee')
@section('pagetitle')
    Disasters
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Disasters</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Disasters List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeDisasters) == 0)
                <h4 class="text-center">No Disasters Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Occured On</th>
                            <th>Disaster Cause</th>
                            <th>Disaster Severity</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeDisasters as $employeeDisaster)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeDisaster->occured_on }}</td>
                                <td>{{ $employeeDisaster->causes->name }}</td>
                                <td>{{ $employeeDisaster->severities->name }}</td>
                                <td>{{ $employeeDisaster->description }}</td>
                                <td>{{ $employeeDisaster->status }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_disasters.employee_disaster.destroy', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_disasters.employee_disaster.show', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) }}"
                                                class="btn btn-primary" title="Show Disaster">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('employee_disasters.employee_disaster.edit', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) }}"
                                                class="btn btn-warning" title="Edit Disaster">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Disaster"
                                                onclick="return confirm(&quot;Click Ok to delete Disaster.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeDisasters->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_disasters.employee_disaster.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Disaster">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
    @if (count($employeeDisasters) > 0)
        <a href="{{ route('employee_disasters.employee_disaster.print', $employee) }}" class="btn btn-primary" title="Print Employee Disaster" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> Print</span>
        </a>
    @endif
@endsection
