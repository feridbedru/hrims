@extends('layouts.app')
@section('pagetitle')
    Education Levels
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Education Levels</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Education Levels List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($educationLevels) == 0)
                <h4 class="text-center">No Education Levels Available.</h4>
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
                        @foreach ($educationLevels as $educationLevel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $educationLevel->name }}</td>
                                <td>{{ $educationLevel->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('education_levels.education_level.destroy', $educationLevel->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('education_levels.education_level.edit', $educationLevel->id) }}"
                                                class="btn btn-warning" title="Edit Education Level">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Education Level"
                                                onclick="return confirm(&quot;Click Ok to delete Education Level.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $educationLevels->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('education_levels.education_level.create') }}" class="btn btn-success"
        title="Create New Education Level">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
