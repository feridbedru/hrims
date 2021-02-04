@extends('layouts.app')
@section('pagetitle')
    Template Types
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Template Types</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Template Types List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($templateTypes) == 0)
                <h4 class="text-center">No Template Types Available.</h4>
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
                        @foreach ($templateTypes as $templateType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $templateType->name }}</td>
                                <td>{{ $templateType->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('template_types.template_type.destroy', $templateType->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('template_types.template_type.edit', $templateType->id) }}"
                                                class="btn btn-warning" title="Edit Template Type">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Template Type"
                                                onclick="return confirm(&quot;Click Ok to delete Template Type.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $templateTypes->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('template_types.template_type.create') }}" class="btn btn-success" title="Create New Template Type">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
