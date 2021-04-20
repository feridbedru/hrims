@extends('layouts.printer')
@section('pagetitle')
    Disabilities
@endsection
@section('content')
    @if (count($employeeDisabilities) == 0)
        <h4 class="text-center">No Disabilities Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>Type</th>
                    <th>{{(__('setting.Description'))}}</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeDisabilities as $employeeDisability)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeDisability->types->name }}</td>
                        <td>{{ $employeeDisability->description }}</td>
                        <td>
                            @if ($employeeDisability->status == 1)
                                Pending
                            @elseif($employeeDisability->status == 2)
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
