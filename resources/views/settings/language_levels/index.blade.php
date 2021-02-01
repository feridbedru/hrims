@extends('layouts.app')
@section('pagetitle')
    Language Levels
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Language Levels</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Language Level List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($languageLevels) == 0)
                <h4 class="text-center">No Language Levels Available.</h4>
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
                        @foreach ($languageLevels as $languageLevel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $languageLevel->name }}</td>
                                <td>{{ $languageLevel->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('language_levels.language_level.destroy', $languageLevel->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('language_levels.language_level.edit', $languageLevel->id) }}"
                                                class="btn btn-primary" title="Edit Language Level">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Language Level"
                                                onclick="return confirm(&quot;Click Ok to delete Language Level.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $languageLevels->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('language_levels.language_level.create') }}" class="btn btn-success"
        title="Create New Language Level">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
