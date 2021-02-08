@extends('layouts.app')
@section('pagetitle')
    Templates
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Templates</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Templates List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($templates) == 0)
                <h4 class="text-center">No Templates Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Language</th>
                            <th>Template Type</th>
                            <th>Is Active</th>
                            <th>Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $template)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $template->title }}</td>
                                <td>{{ optional($template->language)->name }}</td>
                                <td>{{ optional($template->templateType)->name }}</td>
                                <td>{{ $template->is_active ? 'Yes' : 'No' }}</td>
                                <td>{{ $template->code }}</td>
                                <td>
                                    <form method="POST" action="{!!  route('templates.template.destroy', $template->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('templates.template.show', $template->id) }}"
                                                class="btn btn-primary" title="Show Template">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('templates.template.edit', $template->id) }}"
                                                class="btn btn-warning" title="Edit Template">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Template"
                                                onclick="return confirm(&quot;Click Ok to delete Template.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $templates->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('templates.template.create') }}" class="btn btn-success" title="Create New Template">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
