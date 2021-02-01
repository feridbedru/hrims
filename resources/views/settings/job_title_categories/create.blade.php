@extends('layouts.app')
@section('pagetitle')
    New Job Title Category
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('job_title_categories.job_title_category.index') }}">Job Title Category</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Job Category</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('job_title_categories.job_title_category.store') }}" accept-charset="UTF-8"
                id="create_job_title_category_form" name="create_job_title_category_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.job_title_categories.form', [
                'jobTitleCategory' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Submit">
                        <a href="{{ route('job_title_categories.job_title_category.index') }}" class="btn btn-warning mr-5"
                            title="Show All Job Title Category">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
