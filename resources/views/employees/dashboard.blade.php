@extends('layouts.employee')
@section('pagetitle')
    Employee Dashboard
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h3 class="card-title">Employee Dashboard</h3>
            <div class="card-tools">
                <form method="POST" action="{!! route('employees.employee.destroy', $employee->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('employees.employee.edit', $employee->id) }}" class="btn btn-warning"
                            title="Edit Employee">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        <button type="submit" class="btn btn-danger" title="Delete Employee"
                            onclick="return confirm(&quot;Click Ok to delete Employee.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>English Name</dt>
                        <dd>{{ $employee->titles->en_title }} {{ $employee->en_name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Amharic Name</dt>
                        <dd>{{ $employee->titles->am_title }} {{ $employee->am_name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Sex</dt>
                        <dd>{{ $employee->sexes->name }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>Date Of Birth</dt>
                        <dd>{{ $employee->date_of_birth }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Phone Number</dt>
                        <dd>{{ $employee->phone_number }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Organization Unit</dt>
                        <dd>{{ $employee->organizationUnitse->en_name }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>Job Position</dt>
                        <dd>
                            @foreach ($jobTitleCategories as $title)
                                @if ($employee->jobPositions->job_title_category == $title->id)
                                    {{ $title->name }}
                                @endif
                            @endforeach
                        </dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Employment ID</dt>
                        <dd>{{ $employee->employment_id }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Status</dt>
                        <dd>{{ $employee->employeeStatuses->name }}</dd>
                    </div>
                </div>
            </dl>
        </div>
    </div>
@endsection
