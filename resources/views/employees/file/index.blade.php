@extends('layouts.employee')
@section('pagetitle')
    Files
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Files</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Files List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeFiles) == 0)
                <h4 class="text-center">No Files Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeFiles as $employeeFile)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeFile->title }}</td>
                                <td>{{ $employeeFile->description }}</td>
                                <td><a href="{{ asset('uploads/misc/' . $employeeFile->attachment) }}"
                                    class="btn btn-primary mr-3" target="_blank">View File</a></td>

                                <td>
                                    <form method="POST" action="{!! route('employee_files.employee_file.destroy', ['employee' => $employeeFile->employees->id, 'employeeFile' => $employeeFile->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_files.employee_file.edit', ['employee' => $employeeFile->employees->id, 'employeeFile' => $employeeFile->id]) }}"
                                                class="btn btn-warning" title="Edit File">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete File"
                                                onclick="return confirm(&quot;Click Ok to delete File.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeFiles->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_files.employee_file.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New File">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
    @if (count($employeeFiles) > 0)
        <a href="{{ route('employee_files.employee_file.print', $employee) }}" class="btn btn-primary" title="Print Employee File" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> Print</span>
        </a>
    @endif
@endsection
