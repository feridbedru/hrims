@extends('layouts.printer')
@section('pagetitle')
    Languages
@endsection
@section('content')
    @if (count($employeeLanguages) == 0)
        <h4 class="text-center">No Languages Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>Language</th>
                    <th>Reading</th>
                    <th>Writing</th>
                    <th>Listening</th>
                    <th>Speaking</th>
                    <th>Is Prefered</th>
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
@endsection
