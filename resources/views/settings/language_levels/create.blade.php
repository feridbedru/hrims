@extends('layouts.app')
@section('pagetitle')
    New Language Level
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('language_levels.language_level.index') }}">Language Level</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Language Level</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('language_levels.language_level.store') }}" accept-charset="UTF-8"
                id="create_language_level_form" name="create_language_level_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.language_levels.form', [
                'languageLevel' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Submit">
                        <a href="{{ route('language_levels.language_level.index') }}" class="btn btn-warning mr-5"
                            title="Show All Language Level">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
