@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Files'))}}
@endsection
@section('content')
@permission('files_print')
    @if (count($employeeFiles) == 0)
        <h4 class="text-center">{{(__('employee.No Files Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{(__('employee.Title'))}}</th>
                    <th>{{(__('setting.Description'))}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeFiles as $employeeFile)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeFile->title }}</td>
                        <td>{{ $employeeFile->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
