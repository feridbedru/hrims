@extends('layouts.app')
@section('pagetitle')
    Edit Language Level
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('language_levels.language_level.index') }}">Language Levels</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Language Level</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('language_levels.language_level.update', $languageLevel->id) }}"
                id="edit_language_level_form" name="edit_language_level_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('settings.language_levels.form', [
                'languageLevel' => $languageLevel,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('language_levels.language_level.index') }}" class="btn btn-warning"
                            title="Show All Language Level">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
