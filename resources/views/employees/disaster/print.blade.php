@extends('layouts.printer')
@section('pagetitle')
    Disasters
@endsection
@section('content')
    @if (count($employeeDisasters) == 0)
        <h4 class="text-center">No Disasters Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Occured On</th>
                    <th>Disaster Cause</th>
                    <th>Disaster Severity</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeDisasters as $employeeDisaster)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeDisaster->occured_on }}</td>
                        <td>{{ $employeeDisaster->causes->name }}</td>
                        <td>{{ $employeeDisaster->severities->name }}</td>
                        <td>{{ $employeeDisaster->description }}</td>
                        <td>{{ $employeeDisaster->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
