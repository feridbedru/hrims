@extends('layouts.app')
@section('pagetitle')
    Experience Types
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Experience Types</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Experience Types List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($experienceTypes) == 0)
                <h4 class="text-center">No Experience Types Available.</h4>
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
                        @foreach ($experienceTypes as $experienceType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $experienceType->name }}</td>
                                <td>{{ $experienceType->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('experience_types.experience_type.destroy', $experienceType->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('experience_types.experience_type.edit', $experienceType->id) }}"
                                                class="btn btn-warning" title="Edit Experience Type">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Experience Type"
                                                onclick="return confirm(&quot;Click Ok to delete Experience Type.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $experienceTypes->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('experience_types.experience_type.create') }}" class="btn btn-success"
        title="Create New Experience Type">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
