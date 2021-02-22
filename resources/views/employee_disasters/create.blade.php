@extends('layouts.employee')
@section('pagetitle')
    New Employee Disaster
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_disasters.employee_disaster.index') }}">Employee Disaster</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Employee Disaster</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
    <form method="POST" action="{{ route('employee_disasters.employee_disaster.store') }}" accept-charset="UTF-8" id="create_employee_disaster_form" name="create_employee_disaster_form" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include ('employee_disasters.form', [
                                        'employeeDisaster' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Add">
                        <a href="{{ route('employee_disasters.employee_disaster.index') }}" class="btn btn-warning mr-5" title="Show All Employee Disaster">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection