@extends('layouts.app')
@section('pagetitle')
    Disaster Causes
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Disaster Causes</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Disaster Causes List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($disasterCauses) == 0)
                <h4 class="text-center">No Disaster Causes Available.</h4>
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
                        @foreach ($disasterCauses as $disasterCause)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $disasterCause->name }}</td>
                                <td>{{ $disasterCause->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('disaster_causes.disaster_cause.destroy', $disasterCause->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('disaster_causes.disaster_cause.edit', $disasterCause->id) }}"
                                                class="btn btn-warning" title="Edit Disaster Cause">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Disaster Cause"
                                                onclick="return confirm(&quot;Click Ok to delete Disaster Cause.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $disasterCauses->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('disaster_causes.disaster_cause.create') }}" class="btn btn-success"
        title="Create New Disaster Cause">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
