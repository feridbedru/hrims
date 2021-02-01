@extends('layouts.app')
@section('pagetitle')
    Job Category
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Job Category</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Job Category List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($jobCategories) == 0)
                <div class="panel-body text-center">
                    <h4>No Job Categories Available.</h4>
                </div>
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
                        @foreach ($jobCategories as $jobCategory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jobCategory->name }}</td>
                                <td>{{ $jobCategory->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('job_categories.job_category.destroy', $jobCategory->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}

                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('job_categories.job_category.edit', $jobCategory->id) }}"
                                                class="btn btn-warning" title="Edit Job Category">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Job Category"
                                                onclick="return confirm(&quot;Click Ok to delete Job Category.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $jobCategories->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('job_categories.job_category.create') }}" class="btn btn-success" title="Create New Job Category">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
