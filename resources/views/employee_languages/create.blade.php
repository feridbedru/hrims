@extends('layouts.employee')
@section('pagetitle')
    New Employee Language
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_languages.employee_language.index') }}">Employee Language</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Employee Language</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
    <form method="POST" action="{{ route('employee_languages.employee_language.store') }}" accept-charset="UTF-8" id="create_employee_language_form" name="create_employee_language_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('employee_languages.form', [
                                        'employeeLanguage' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Add">
                        <a href="{{ route('employee_languages.employee_language.index') }}" class="btn btn-warning mr-5" title="Show All Employee Language">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection