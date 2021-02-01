@extends('layouts.app')
@section('pagetitle')
    Employee Status
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Employee Statuses</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Employee Status List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($employeeStatuses) == 0)
                <h4 class="text-center">No Employee Statuses Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeStatuses as $employeeStatus)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeStatus->name }}</td>
                                <td>{{ $employeeStatus->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('employee_statuses.employee_status.destroy', $employeeStatus->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_statuses.employee_status.edit', $employeeStatus->id) }}"
                                                class="btn btn-warning" title="Edit Employee Status">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Employee Status"
                                                onclick="return confirm(&quot;Click Ok to delete Employee Status.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeStatuses->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_statuses.employee_status.create') }}" class="btn btn-success"
        title="Create New Employee Status">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
