@extends('layouts.app')
@section('pagetitle')
    Award Types
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Award Types</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Award Types List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($awardTypes) == 0)
                <h4 class="text-center">No Award Types Available.</h4>
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
                        @foreach ($awardTypes as $awardType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $awardType->name }}</td>
                                <td>{{ $awardType->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('award_types.award_type.destroy', $awardType->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('award_types.award_type.edit', $awardType->id) }}"
                                                class="btn btn-warning" title="Edit Award Type">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Award Type"
                                                onclick="return confirm(&quot;Click Ok to delete Award Type.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $awardTypes->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('award_types.award_type.create') }}" class="btn btn-success" title="Create New Award Type">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
