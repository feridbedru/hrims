@extends('layouts.app')
@section('pagetitle')
{{(__('employee.Employees'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Employees'))}}</li>
@endsection
@section('content')
@permission('employee_list')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('setting.SearchandFilter'))}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.employee.filter') }}" method="POST" accept-charset="UTF-8"
                id="filter_employee_form" name="filter_employee_form" class="form-horizontal">
                <div class="row">
                    {{ csrf_field() }}
                    <div class="form-group col-md-2">
                        <select class="form-control" name="job_position_id" id="job_position_id">
                            <option value="NULL">{{(__('employee.Select Job Position'))}}</option>
                            @foreach ($jobPositions as $key => $jobPosition)
                                <option value="{{ $key }}">
                                    {{ $jobPosition }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control" name="sex_id" id="sex_id">
                            <option value="NULL">{{(__('employee.Select Sex'))}}</option>
                            @foreach ($sexl as $key => $sex)
                                <option value="{{ $key }}">
                                    {{ $sex }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control" name="organization_unit_id" id="organization_unit_id">
                            <option value="NULL">{{(__('employee.Select Organization Unit'))}}</option>
                            @foreach ($organizationUnits as $key => $organizationUnit)
                                <option value="{{ $key }}">
                                    {{ $organizationUnit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" placeholder="enter name here" class="form-control" id="organization_unit_name"
                            name="organization_unit_name">
                    </div>
                    <div class="form-group col-md-2 text-right">
                        <input type="submit" class="btn btn-success btn-md  mr-3" value="{{(__('setting.Filter'))}}">
                        <a href="{{ route('organization_units.organization_unit.index') }}"
                            class="btn btn-danger mr-5  d-inline" title="Show All Organization Unit">
                            {{(__('setting.Reset'))}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Employees List'))}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($employees) == 0)
                <h4 class="text-center">{{(__('employee.No Employees Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Name'))}}</th>
                            <th>{{(__('setting.Sex'))}}</th>
                            <th>{{(__('setting.OrganizationUnit'))}}</th>
                            <th>{{(__('setting.Position'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($employee->titles)->en_title }} {{ $employee->en_name }}</td>
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
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @permission('employee_show')
                                        <a href="{{ route('employees.employee.show', $employee->id) }}"
                                            class="btn btn-primary" title="Show Employee">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        @endpermission
                                        @permission('employee_edit')
                                        <a href="{{ route('employees.employee.edit', $employee->id) }}"
                                            class="btn btn-warning" title="Edit Employee">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>
                                        @endpermission
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employees->links() }}
                </div>
            @endif
        </div>
    </div>
    @permission('employee_addNew')
    <a href="{{ route('employees.employee.create') }}" class="btn btn-success" title="Create New Employee">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
    {{-- not a duplicate do not delete the endpermission below --}}
    @endpermission
@endsection
