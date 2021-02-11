@extends('layouts.app')
@section('pagetitle')
    New GPA Scale
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('gpa_scales.gpa_scale.index') }}">GPA Scale</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New GPA Scale</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('gpa_scales.gpa_scale.store') }}" accept-charset="UTF-8"
                id="create_gpa_scale_form" name="create_gpa_scale_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.gpa_scales.form', [
                'gPAScale' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Add">
                        <a href="{{ route('gpa_scales.gpa_scale.index') }}" class="btn btn-warning mr-5"
                            title="Show All GPA Scale">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
