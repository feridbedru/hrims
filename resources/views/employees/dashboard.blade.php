@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Employee Dashboard'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Dashboard'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h3 class="card-title">{{(__('employee.Employee Dashboard'))}}</h3>
            <div class="card-tools">
                <form method="POST" action="{!! route('employees.employee.destroy', $employee->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        @permission('employee_edit')
                        <a href="{{ route('employees.employee.edit', $employee->id) }}" class="btn btn-warning"
                            title="Edit Employee">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        @endpermission
                        @permission('employee_delete')
                        <button type="submit" class="btn btn-danger" title="Delete Employee"
                            onclick="return confirm(&quot;Click Ok to delete Employee.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                        @endpermission
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            @permission('employee_show')
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.English Name'))}}</dt>
                        <dd>{{ $employee->titles->en_title }} {{ $employee->en_name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Amharic Name'))}}</dt>
                        <dd>{{ $employee->titles->am_title }} {{ $employee->am_name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('setting.Sex'))}}</dt>
                        <dd>{{ $employee->sexes->name }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Date Of Birth'))}}</dt>
                        <dd>{{ $employee->date_of_birth }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Phone Number'))}}</dt>
                        <dd>{{ $employee->phone_number }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Organization Unit'))}}</dt>
                        <dd>{{ $employee->organizationUnitse->en_name }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Job Position'))}}</dt>
                        <dd>
                            @foreach ($jobTitleCategories as $title)
                                @if ($employee->jobPositions->job_title_category == $title->id)
                                    {{ $title->name }}
                                @endif
                            @endforeach
                        </dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Employment ID'))}}</dt>
                        <dd>{{ $employee->employment_id }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('setting.Status'))}}</dt>
                        <dd>{{ $employee->employeeStatuses->name }}</dd>
                    </div>
                </div>
            </dl>
            @endpermission
        </div>
    </div>
@endsection
