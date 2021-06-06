@extends('layouts.printer')
@section('pagetitle')
    {{ __('employee.Emergencies') }}
@endsection
@section('content')
@permission('emergencies_print')
    @if (count($employeeEmergencies) == 0)
        <h4 class="text-center">{{ __('employee.No Emergencies Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Name') }}</th>
                    <th>{{ __('setting.PhoneNumber') }}</th>
                    <th>{{ __('setting.Relationship') }}</th>
                    <th>{{ __('setting.Address') }}</th>
                    <th>{{ __('employee.House Number') }}</th>
                    <th>{{ __('employee.Other Phone') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeEmergencies as $employeeEmergency)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeEmergency->name }}</td>
                        <td>{{ $employeeEmergency->phone_number }}</td>
                        <td>{{ $employeeEmergency->relationships->name }}</td>
                        <td>{{ $employeeEmergency->address }}</td>
                        <td>{{ $employeeEmergency->house_number }}</td>
                        <td>{{ $employeeEmergency->other_phone }}</td>
                        <td>
                            @if ($employeeEmergency->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeEmergency->status == 2)
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
