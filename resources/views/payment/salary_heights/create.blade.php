@extends('layouts.app')
@section('pagetitle')
    New Salary Height
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('salary_heights.salary_height.index') }}">Salary Height</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Salary Height</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('salary_heights.salary_height.store') }}" accept-charset="UTF-8"
                id="create_salary_height_form" name="create_salary_height_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('payment.salary_heights.form', [
                'salaryHeight' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Save">
                        <a href="{{ route('salary_heights.salary_height.index') }}" class="btn btn-warning mr-5"
                            title="Show All Salary Height">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
