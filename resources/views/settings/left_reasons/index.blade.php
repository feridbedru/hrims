@extends('layouts.app')
@section('pagetitle')
    Left Reasons
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Left Reasons</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Left Reasons List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($leftReasons) == 0)
                <h4 class="text-center">No Left Reasons Available.</h4>
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
                        @foreach ($leftReasons as $leftReason)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $leftReason->name }}</td>
                                <td>{{ $leftReason->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('left_reasons.left_reason.destroy', $leftReason->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('left_reasons.left_reason.edit', $leftReason->id) }}"
                                                class="btn btn-warning" title="Edit Left Reason">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Left Reason"
                                                onclick="return confirm(&quot;Click Ok to delete Left Reason.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $leftReasons->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('left_reasons.left_reason.create') }}" class="btn btn-success" title="Create New Left Reason">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
