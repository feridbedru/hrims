@extends('layouts.employee')
@section('pagetitle')
    Employee Families
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Employee Families</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Employee Families List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($employeeFamilies) == 0)
                <h4 class="text-center">No Employee Families Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Relationship</th>
                            <th>Date Of Birth</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeFamilies as $employeeFamily)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeFamily->en_name }}</td>
                                <td>{{ $employeeFamily->name }}</td>
                                <td>{{ $employeeFamily->sex }}</td>
                                <td>{{ $employeeFamily->relation }}</td>
                                <td>{{ $employeeFamily->date_of_birth }}</td>
                                <td>
                                    @if ($employeeFamily->status == 1)
                                        Pending
                                    @elseif($employeeFamily->status == 2)
                                        Rejected
                                    @else
                                        Approved
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeFamily->status == 1)
                                        <a href="{{ route('employee_families.employee_family.approve', $employeeFamily->id) }}"
                                            class="btn btn-outline-success mr-3" title="Approve Employee Family">
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
                                                        <h4 class="modal-title">Reject Employee Family</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST"
                                                        action="{!!  route('employee_families.employee_family.reject', $employeeFamily->id) !!}"
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
                                    @elseif($employeeFamily->status == 2)
                                        <form method="POST"
                                            action="{!!  route('employee_families.employee_family.destroy', $employeeFamily->id) !!}"
                                            accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <button type="submit" class="btn btn-danger" title="Delete Employee Family"
                                                    onclick="return confirm(&quot;Click Ok to delete Employee Family.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <form method="POST"
                                            action="{!!  route('employee_families.employee_family.destroy', $employeeFamily->id) !!}"
                                            accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('employee_families.employee_family.edit', $employeeFamily->id) }}"
                                                    class="btn btn-warning" title="Edit Employee Family">
                                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="Delete Employee Family"
                                                    onclick="return confirm(&quot;Click Ok to delete Employee Family.&quot;)">
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
                {!! $employeeFamilies->render() !!}
            @endif
        </div>
    </div>
        <a href="{{ route('employee_families.employee_family.create') }}" class="btn btn-success"
            title="Create New Employee Family">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
@endsection