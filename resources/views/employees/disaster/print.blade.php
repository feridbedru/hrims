@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Disasters'))}}
@endsection
@section('content')
@permission('disasters_print')
    @if (count($employeeDisasters) == 0)
        <h4 class="text-center">{{(__('employee.No Disaster Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{(__('employee.Occured On'))}}</th>
                    <th>{{(__('employee.Disaster Cause'))}}</th>
                    <th>{{(__('employee.Disaster Severity'))}}</th>
                    <th>{{(__('setting.Description'))}}</th>
                    <th>{{(__('employee.Status'))}}</th>
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
    @endpermission
@endsection
