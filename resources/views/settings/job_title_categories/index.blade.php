@extends('layouts.app')
@section('pagetitle')
    Job Title Category
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Job Title Category</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Job Title Category List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($jobTitleCategories) == 0)
                <h4 class="text-center">No Job Title Categories Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Parent</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobTitleCategories as $jobTitleCategory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jobTitleCategory->name }}</td>
                                <td>{{ $jobTitleCategory->description }}</td>
                                <td>{{ optional($jobTitleCategory->jobTitleCategory)->name }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('job_title_categories.job_title_category.destroy', $jobTitleCategory->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('job_title_categories.job_title_category.edit', $jobTitleCategory->id) }}"
                                                class="btn btn-primary" title="Edit Job Title Category">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Job Title Category"
                                                onclick="return confirm(&quot;Click Ok to delete Job Title Category.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $jobTitleCategories->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('job_title_categories.job_title_category.create') }}" class="btn btn-success"
        title="Create New Job Title Category">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
