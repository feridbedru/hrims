@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Languages'))}}
@endsection
@section('content')
@permission('languages_print')
    @if (count($employeeLanguages) == 0)
        <h4 class="text-center">{{(__('employee.No Languages Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{(__('employee.Languages'))}}</th>
                    <th>{{(__('employee.Reading'))}}</th>
                    <th>{{(__('employee.Writing'))}}</th>
                    <th>{{(__('employee.Listening'))}}</th>
                    <th>{{(__('employee.Speaking'))}}</th>
                    <th>{{(__('employee.Is Prefered'))}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeLanguages as $employeeLanguage)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeLanguage->languages->name }}</td>
                        <td>{{ $employeeLanguage->readings->name }}</td>
                        <td>{{ $employeeLanguage->writings->name }}</td>
                        <td>{{ $employeeLanguage->listenings->name }}</td>
                        <td>{{ $employeeLanguage->speakings->name }}</td>
                        <td>{{ $employeeLanguage->is_prefered ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
