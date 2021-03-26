@extends('layouts.printer')
@section('pagetitle')
    Files
@endsection
@section('content')
    @if (count($employeeFiles) == 0)
        <h4 class="text-center">No Files Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
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
@endsection
