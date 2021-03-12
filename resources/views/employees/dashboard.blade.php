@extends('layouts.employee')

@section('content')

<div class="card card-primary">
    <div class="card-header clearfix">
        <h3 class="card-title">Employee Dashboard</h3>
        <div class="card-tools">
            <form method="POST" action="{!! route('employees.employee.destroy', $employee->id) !!}" accept-charset="UTF-8">
                @method('DELETE')
                {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
        
                        <a href="{{ route('employees.employee.create') }}" class="btn btn-success" title="Create New Employee">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </a>
                        
                        <a href="{{ route('employees.employee.edit', $employee->id ) }}" class="btn btn-warning" title="Edit Employee">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
        
                        <button type="submit" class="btn btn-danger" title="Delete Employee" onclick="return confirm(&quot;Click Ok to delete Employee.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>English Name</dt>
            <dd>{{ $employee->en_name }}</dd>
            <dt>Amharic Name</dt>
            <dd>{{ $employee->am_name }}</dd>
            <dt>Title</dt>
            <dd>{{ $employee->titles->en_title }}</dd>
            <dt>Sex</dt>
            <dd>{{ $employee->sexes->name }}</dd>
            <dt>Date Of Birth</dt>
            <dd>{{ $employee->date_of_birth }}</dd>
            <dt>Photo</dt>
            <dd>{{ asset('storage/' . $employee->photo) }}</dd>
            <dt>Phone Number</dt>
            <dd>{{ $employee->phone_number }}</dd>
            <dt>Organization Unit</dt>
            <dd>{{ $employee->organizationUnitse->en_name }}</dd>
            <dt>Job Position</dt>
            <dd>{{ $employee->jobPositions->job_title_category }}</dd>
            <dt>Employment ID</dt>
            <dd>{{ $employee->employment_id }}</dd>
            <dt>Employee Status</dt>
            <dd>{{ $employee->employeeStatuses->name }}</dd>

        </dl>

    </div>

    
</div>

@endsection