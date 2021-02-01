@extends('layouts.app')
@section('pagetitle')
    Skill Categories
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Skill Categories</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Skill Category List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($skillCategories) == 0)
                <h4 class="text-center">No Skill Categories Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skillCategories as $skillCategory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $skillCategory->name }}</td>
                                <td>{{ $skillCategory->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('skill_categories.skill_category.destroy', $skillCategory->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('skill_categories.skill_category.edit', $skillCategory->id) }}"
                                                class="btn btn-warning" title="Edit Skill Category">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Skill Category"
                                                onclick="return confirm(&quot;Click Ok to delete Skill Category.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $skillCategories->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('skill_categories.skill_category.create') }}" class="btn btn-success"
        title="Create New Skill Category">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
