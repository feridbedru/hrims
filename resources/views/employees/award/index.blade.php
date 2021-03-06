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
                            <th>Employee</th>
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
                                <td>{{ $employeeAward->employees->en_name }}</td>
                                <td>{{ $employeeAward->organization }}</td>
                                <td>{{ $employeeAward->types->name }}</td>
                                <td>{{ $employeeAward->awarded_on }}</td>
                                <td>{{ $employeeAward->status }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_awards.employee_award.destroy', $employeeAward->id) !!}" accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_awards.employee_award.show', $employeeAward->id) }}"
                                                class="btn btn-primary" title="Show Award">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('employee_awards.employee_award.edit', $employeeAward->id) }}"
                                                class="btn btn-warning" title="Edit Award">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Award"
                                                onclick="return confirm(&quot;Click Ok to delete Award.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeAwards->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_awards.employee_award.create') }}" class="btn btn-success"
        title="Create New Employee Award">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
