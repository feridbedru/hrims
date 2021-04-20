@extends('layouts.printer')
@section('pagetitle')
    Awards
@endsection
@section('content')
    @if (count($employeeAwards) == 0)
        <h4 class="text-center">No Awards Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>Organization</th>
                    <th>Award Type</th>
                    <th>Awarded On</th>
                    <th>{{(__('setting.Description'))}}</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeAwards as $employeeAward)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeAward->organization }}</td>
                        <td>{{ $employeeAward->types->name }}</td>
                        <td>{{ $employeeAward->awarded_on }}</td>
                        <td>{{ $employeeAward->description }}</td>
                        <td>
                            @if ($employeeAward->status == 1)
                                Pending
                            @elseif($employeeAward->status == 2)
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
