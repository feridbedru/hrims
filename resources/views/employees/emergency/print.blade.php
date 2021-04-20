@extends('layouts.printer')
@section('pagetitle')
    Emergencies
@endsection
@section('content')
    @if (count($employeeEmergencies) == 0)
        <h4 class="text-center">No Emergencies Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{(__('setting.Name'))}}</th>
                    <th>Phone Number</th>
                    <th>Relationship</th>
                    <th>Address</th>
                    <th>House Number</th>
                    <th>Other Phone</th>
                    <th>Status</th>
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
                                Pending
                            @elseif($employeeEmergency->status == 2)
                                Rejected
                            @else
                                Approved
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
