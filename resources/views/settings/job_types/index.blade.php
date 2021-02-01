@extends('layouts.app')
@extends('layouts.app')
@section('pagetitle')
    Job Type
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Job Type</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Job Type List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($jobTypes) == 0)
                <h4 class="text-center">No Job Types Available.</h4>
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
                        @foreach ($jobTypes as $jobType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jobType->name }}</td>
                                <td>{{ $jobType->description }}</td>
                                <td>
                                    <form method="POST" action="{!!  route('job_types.job_type.destroy', $jobType->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}

                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('job_types.job_type.edit', $jobType->id) }}"
                                                class="btn btn-warning" title="Edit Job Type">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Job Type"
                                                onclick="return confirm(&quot;Click Ok to delete Job Type.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $jobTypes->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('job_types.job_type.create') }}" class="btn btn-success" title="Create New Job Type">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
