@extends('layouts.app')
@section('pagetitle')
{{(__('setting.Employees'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('organization_units.organization_unit.index') }}">{{('setting.OrganizationUnit')}}</a>
    </li>
    <li class="breadcrumb-item active">{{(__('setting.Employees'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Employee List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('organization_units_employes')
            @if (count($employees) == 0)
                <h4 class="text-center">{{(__('employee.No Employees in this Units'))}}.</h4>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Full Name'))}}</th>
                            <th>{{(__('setting.Sex'))}}</th>
                            <th>{{(__('setting.OrganizationUnit'))}}</th>
                            <th>{{(__('setting.Job Title'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->en_name }}</td>
                                <td>{{ $employee->sexes->name }}</td>
                                <td>{{ $employee->organizationUnitse->en_name }}</td>
                                <td>
                                    @foreach ($jobTitleCategories as $title)
                                        @if ($employee->jobPositions->job_title_category == $title->id)
                                            {{ $title->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @permission('organization_units_employes')
                                    <a href="{{ route('employees.employee.show', $employee->id) }}"
                                        class="btn btn-primary" title="Show Employee">
                                        {{(__('setting.View Details'))}}
                                    </a>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employees->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>

@endsection
