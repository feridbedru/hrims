@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Experience'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Experience'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Experiences List'))}}</h3>
        </div>

        <div class="card-body">
            @if (count($employeeExperiences) == 0)
                <h4 class="text-center">{{(__('employee.No Experiences Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{('setting.Number')}}</th>
                            <th>{{(__('employee.Type'))}}</th>
                            <th>{{(__('employee.Organization Name'))}}</th>
                            <th>{{(__('employee.Job Position'))}}</th>
                            <th>{{(__('employee.Salary'))}}</th>
                            <th>{{(__('employee.Status'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeExperiences as $employeeExperience)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeExperience->types->name }}</td>
                                <td>{{ $employeeExperience->organization_name }}</td>
                                <td>{{ $employeeExperience->job_position }}</td>
                                <td>{{ $employeeExperience->salary }}</td>
                                <td>
                                    @if ($employeeExperience->status == 1)
                                        {{(__('employee.Pending'))}}
                                    @elseif($employeeExperience->status == 2)
                                        {{(__('employee.Rejected'))}}
                                    @else
                                        {{(__('employee.Approved'))}}
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeExperience->status == 3)
                                        <form method="POST" action="{!! route('employee_experiences.employee_experience.destroy', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('employee_experiences.employee_experience.show', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) }}"
                                                    class="btn btn-primary" title="Show Experience">
                                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('employee_experiences.employee_experience.edit', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) }}"
                                                    class="btn btn-warning" title="Edit Experience">
                                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="Delete Experience"
                                                    onclick="return confirm(&quot;Click Ok to delete Experience.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </form>
                                    @else

                                        <a href="{{ route('employee_experiences.employee_experience.show', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) }}"
                                            class="btn btn-primary" title="Show Experience">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeExperiences->links() }}
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('employee_experiences.employee_experience.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Experience">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @if (count($employeeExperiences) > 0)
        <a href="{{ route('employee_experiences.employee_experience.print', $employee) }}" class="btn btn-primary" title="Print Employee Experience" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
    @endif
@endsection
