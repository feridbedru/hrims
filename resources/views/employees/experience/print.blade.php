@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Experience'))}}
@endsection
@section('content')
@permission('experience_print')
    @if (count($employeeExperiences) == 0)
        <h4 class="text-center">{{(__('employee.No Experiences Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('employee.Type') }}</th>
                    <th>{{ __('employee.Organization Name') }}</th>
                    <th>{{ __('employee.Job Position') }}</th>
                    <th>{{ __('employee.Level') }}</th>
                    <th>{{ __('employee.Start Date') }}</th>
                    <th>{{ __('employee.End Date') }}</th>
                    <th>{{ __('employee.Salary') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeExperiences as $employeeExperience)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeExperience->types->name }}</td>
                        <td>{{ $employeeExperience->organization_name }}</td>
                        <td>{{ $employeeExperience->job_position }}</td>
                        <td>{{ $employeeExperience->level }}</td>
                        <td>{{ $employeeExperience->start_date }}</td>
                        <td>{{ $employeeExperience->end_date }}</td>
                        <td>{{ $employeeExperience->salary }}</td>
                        <td>
                            @if ($employeeExperience->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeExperience->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
