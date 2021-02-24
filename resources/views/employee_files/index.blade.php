@extends('layouts.employee')
@section('pagetitle')
    Employee Files
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Employee Files</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Employee Files List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($employeeFiles) == 0)
                <h4 class="text-center">No Employee Files Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeFiles as $employeeFile)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($employeeFile->employee)->title }}</td>
                            <td>{{ $employeeFile->title }}</td>
                            <td>{{ $employeeFile->description }}</td>

                            <td>
                                <form method="POST" action="{!! route('employee_files.employee_file.destroy', $employeeFile->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('employee_files.employee_file.show', $employeeFile->id ) }}" class="btn btn-primary" title="Show Employee File">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('employee_files.employee_file.edit', $employeeFile->id ) }}" class="btn btn-warning" title="Edit Employee File">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Employee File" onclick="return confirm(&quot;Click Ok to delete Employee File.&quot;)">
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
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('employee_files.employee_file.create') }}" class="btn btn-success" title="Create New Employee File">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection