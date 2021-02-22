@extends('layouts.employee')
@section('pagetitle')
    Employee Disaster Indeminities
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Employee Disaster Indeminities</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Employee Disaster Indeminities List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($employeeDisasterIndeminities) == 0)
                <h4 class="text-center">No Employee Disaster Indeminities Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Disaster</th>
                            <th>Title</th>
                            <th>Cost</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeDisasterIndeminities as $employeeDisasterIndeminity)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($employeeDisasterIndeminity->employeeDisaster)->approved_at }}</td>
                                <td>{{ $employeeDisasterIndeminity->title }}</td>
                                <td>{{ $employeeDisasterIndeminity->cost }}</td>

                            <td>
                                <form method="POST" action="{!! route('employee_disaster_indeminities.employee_disaster_indeminity.destroy', $employeeDisasterIndeminity->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.show', $employeeDisasterIndeminity->id ) }}" class="btn btn-primary" title="Show Employee Disaster Indeminity">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.edit', $employeeDisasterIndeminity->id ) }}" class="btn btn-warning" title="Edit Employee Disaster Indeminity">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Employee Disaster Indeminity" onclick="return confirm(&quot;Click Ok to delete Employee Disaster Indeminity.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $employeeDisasterIndeminities->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.create') }}" class="btn btn-success" title="Create New Employee Disaster Indeminity">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection