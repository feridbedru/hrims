@extends('layouts.app')
@section('pagetitle')
    Marital Statuses
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Marital Statuses</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Marital Statuses</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($maritalStatuses) == 0)
                <h4 class="text-center">No Marital Statuses Available.</h4>
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
                        @foreach ($maritalStatuses as $maritalStatus)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $maritalStatus->name }}</td>
                                <td>{{ $maritalStatus->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('marital_statuses.marital_status.destroy', $maritalStatus->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('marital_statuses.marital_status.edit', $maritalStatus->id) }}"
                                                class="btn btn-warning" title="Edit Marital Status">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Marital Status"
                                                onclick="return confirm(&quot;Click Ok to delete Marital Status.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $maritalStatuses->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('marital_statuses.marital_status.create') }}" class="btn btn-success"
        title="Create New Marital Status">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
