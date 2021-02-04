@extends('layouts.app')
@section('pagetitle')
    Edit Salary
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('salaries.salary.index') }}">Salary</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Salary</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('salaries.salary.update', $salary->id) }}" id="edit_salary_form" name="edit_salary_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('salaries.form', [
                                        'salary' => $salary,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('salaries.salary.index') }}" class="btn btn-warning mr-5" title="Show All Salary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection