@extends('layouts.app')
@section('pagetitle')
    Employee Registered
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employees.employee.index') }}">Employee</a></li>
    <li class="breadcrumb-item active">Registration Success</li>
@endsection
@section('content')
    <div class="jumbotron">
        <h3 class="display-4 text-center text-success">Successfully Registered!</h3>
        <p class="lead text-center">{{ $employee->en_name }} has been successfuly registered on the system. Choose an
            action below to proceed or do it latter.</p>
        <hr class="my-4">
        <div class="text-center">
            <p class="lead">
                <a class="btn btn-success btn-lg mr-5" href="#" role="button">Print Letter</a>
                <a class="btn btn-warning btn-lg mr-5" href="#" role="button">Print Credentials</a>
                <a class="btn btn-primary btn-lg" href="#" role="button">Print Both</a>
            </p>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-body m-5">
            <h3>What's next?</h3>
            <hr class="my-4">
            <ul>
                <li class="lead">If your organization has an Active Directory service then you can sync to it so that the
                    employee can start
                    accessing all service using one account</li>
                <li class="lead">You can start adding mandatory information regarding the employee</li>
                <li class="lead">Employee can add additional information such as certification and other details.</li>
            </ul>
        </div>
    </div>
@endsection