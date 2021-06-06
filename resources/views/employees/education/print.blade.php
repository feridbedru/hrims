@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Educations'))}}
@endsection
@section('content')
@permission('educations_print')
    @if (count($employeeEducations) == 0)
        <h4 class="text-center">{{(__('employee.No Educations Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Level') }}</th>
                    <th>{{ __('employee.Institute') }}</th>
                    <th>{{ __('employee.Field') }}</th>
                    <th>{{ __('employee.GPA') }}</th>
                    <th>{{ __('employee.Start Date') }}</th>
                    <th>{{ __('employee.End Date') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeEducations as $employeeEducation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeEducation->levels->name }}</td>
                        <td>{{ $employeeEducation->institutes->name }}</td>
                        <td>{{ $employeeEducation->fields->name }}</td>
                        <td>{{ $employeeEducation->gpa }} / {{ optional($employeeEducation->gpaScales)->name }}
                        </td>
                        <td>{{ $employeeEducation->start_date }}</td>
                        <td>{{ $employeeEducation->end_date }}</td>
                        <td>
                            @if ($employeeEducation->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeEducation->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
