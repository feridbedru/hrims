@extends('layouts.app')
@section('pagetitle')
    Relationships
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Relationships</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Relationships List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($relationships) == 0)
                    <h4 class="text-center">No Relationships Available.</h4>
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
                        @foreach ($relationships as $relationship)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $relationship->name }}</td>
                                <td>{{ $relationship->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('relationships.relationship.destroy', $relationship->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('relationships.relationship.edit', $relationship->id) }}"
                                                class="btn btn-warning" title="Edit Relationship">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Relationship"
                                                onclick="return confirm(&quot;Click Ok to delete Relationship.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $relationships->render() !!}
            @endif
        </div>
    </div>
        <a href="{{ route('relationships.relationship.create') }}" class="btn btn-success" title="Create New Relationship">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
@endsection
