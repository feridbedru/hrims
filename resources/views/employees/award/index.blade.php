@extends('layouts.employee')
@section('pagetitle')
    Awards
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> Awards</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> Awards List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeAwards) == 0)
                <h4 class="text-center">No Awards Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Organization</th>
                            <th>Award Type</th>
                            <th>Awarded On</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeAwards as $employeeAward)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeAward->organization }}</td>
                                <td>{{ $employeeAward->types->name }}</td>
                                <td>{{ $employeeAward->awarded_on }}</td>
                                <td>
                                    @if ($employeeAward->status == 1)
                                        Pending
                                    @elseif($employeeAward->status == 2)
                                        Rejected
                                    @else
                                        Approved
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeAward->status == 3)
                                        <form method="POST" action="{!! route('employee_awards.employee_award.destroy', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('employee_awards.employee_award.show', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) }}"
                                                    class="btn btn-primary" title="Show Award">
                                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('employee_awards.employee_award.edit', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) }}"
                                                    class="btn btn-warning" title="Edit Award">
                                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="Delete Award"
                                                    onclick="return confirm(&quot;Click Ok to delete Award.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <a href="{{ route('employee_awards.employee_award.show', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) }}"
                                            class="btn btn-primary" title="Show Award">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeAwards->links() }}
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('employee_awards.employee_award.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Employee Award">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
    @if (count($employeeAwards) > 0)
        <a href="{{ route('employee_awards.employee_award.print', $employee) }}" class="btn btn-primary" title="Print Employee Award" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> Print</span>
        </a>
    @endif
@endsection
