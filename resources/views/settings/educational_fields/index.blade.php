@extends('layouts.app')
@section('pagetitle')
    Educational Fields
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Educational Fields</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Educational Fields List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($educationalFields) == 0)
                <h4 class="text-center">No Educational Fields Available.</h4>
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
                        @foreach ($educationalFields as $educationalField)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $educationalField->name }}</td>
                                <td>{{ $educationalField->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('educational_fields.educational_field.destroy', $educationalField->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('educational_fields.educational_field.edit', $educationalField->id) }}"
                                                class="btn btn-warning" title="Edit Educational Field">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Educational Field"
                                                onclick="return confirm(&quot;Click Ok to delete Educational Field.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $educationalFields->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('educational_fields.educational_field.create') }}" class="btn btn-success"
        title="Create New Educational Field">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
