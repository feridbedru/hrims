@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Disaster Indeminities'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Disaster Indeminities'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Disaster Indeminities List'))}}</h3>
        </div>

        <div class="card-body">
            @if (count($employeeDisasterIndeminities) == 0)
                <h4 class="text-center">{{(__('employee.No Disaster Indeminities Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('employee.Disaster'))}}</th>
                            <th>{{(__('setting.Title'))}}</th>
                            <th>{{(__('employee.Cost'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeDisasterIndeminities as $employeeDisasterIndeminity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeDisasterIndeminity->disasters->occured_on }}</td>
                                <td>{{ $employeeDisasterIndeminity->title }}</td>
                                <td>{{ $employeeDisasterIndeminity->cost }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_disaster_indeminities.employee_disaster_indeminity.destroy', $employeeDisasterIndeminity->id) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.show', $employeeDisasterIndeminity->id) }}"
                                                class="btn btn-primary" title="Show Disaster Indeminity">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.edit', $employeeDisasterIndeminity->id) }}"
                                                class="btn btn-warning" title="Edit Disaster Indeminity">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Disaster Indeminity"
                                                onclick="return confirm(&quot;Click Ok to delete Disaster Indeminity.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeDisasterIndeminities->links() }}
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.create') }}" class="btn btn-success"
        title="Create New Disaster Indeminity">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
@endsection
