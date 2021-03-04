@extends('layouts.employee')
@section('pagetitle')
    Disaster Witnesses
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Disaster Witnesses</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Disaster Witnesses List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeDisasterWitnesses) == 0)
                <h4 class="text-center">No Disaster Witnesses Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Disaster</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeDisasterWitnesses as $employeeDisasterWitness)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($employeeDisasterWitness->employeeDisaster)->approved_at }}</td>
                                <td>{{ $employeeDisasterWitness->name }}</td>
                                <td>{{ $employeeDisasterWitness->phone }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_disaster_witnesses.employee_disaster_witness.destroy', $employeeDisasterWitness->id) !!}" accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_disaster_witnesses.employee_disaster_witness.show', $employeeDisasterWitness->id) }}"
                                                class="btn btn-primary" title="Show Disaster Witness">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('employee_disaster_witnesses.employee_disaster_witness.edit', $employeeDisasterWitness->id) }}"
                                                class="btn btn-warning" title="Edit Disaster Witness">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Disaster Witness"
                                                onclick="return confirm(&quot;Click Ok to delete Disaster Witness.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeDisasterWitnesses->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_disaster_witnesses.employee_disaster_witness.create') }}" class="btn btn-success"
        title="Create New Disaster Witness">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
