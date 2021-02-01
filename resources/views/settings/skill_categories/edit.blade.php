@extends('layouts.app')
@section('pagetitle')
    Edit Skill Category
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('skill_categories.skill_category.index') }}">Skill Category</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Skill Category</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('skill_categories.skill_category.update', $skillCategory->id) }}"
                id="edit_skill_category_form" name="edit_skill_category_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('settings.skill_categories.form', [
                'skillCategory' => $skillCategory,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('skill_categories.skill_category.index') }}" class="btn btn-warning"
                            title="Show All Skill Category">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
