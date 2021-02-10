@extends('layouts.app')
@section('pagetitle')
    Employee Addresses
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Employee Addresses</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Employee Addresses List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($employeeAddresses) == 0)
                <h4 class="text-center">No Employee Addresses Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Address Type</th>
                            <th>Address</th>
                            <th>House Number</th>
                            <th>Woreda</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeAddresses as $employeeAddress)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($employeeAddress->employee)->en_name }}</td>
                            <td>{{ optional($employeeAddress->addressType)->name }}</td>
                            <td>{{ $employeeAddress->address }}</td>
                            <td>{{ $employeeAddress->house_number }}</td>
                            <td>{{ optional($employeeAddress->woreda)->name }}</td>
                            <td>{{ $employeeAddress->status }}</td>

                            <td>
                                <form method="POST" action="{!! route('employee_addresses.employee_address.destroy', $employeeAddress->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('employee_addresses.employee_address.edit', $employeeAddress->id ) }}" class="btn btn-warning" title="Edit Employee Address">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Employee Address" onclick="return confirm(&quot;Click Ok to delete Employee Address.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $employeeAddresses->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('employee_addresses.employee_address.create') }}" class="btn btn-success" title="Create New Employee Address">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection