@extends('layouts.app')
@section('pagetitle')
    Languages
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Languages</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Language List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($languages) == 0)
                <h4 class="text-center">No Languages Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Is Default</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($languages as $language)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $language->name }}</td>
                                <td>{{ $language->code }}</td>
                                <td>{{ $language->is_default ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{!!  route('languages.language.destroy', $language->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('languages.language.edit', $language->id) }}"
                                                class="btn btn-primary" title="Edit Language">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Language"
                                                onclick="return confirm(&quot;Click Ok to delete Language.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $languages->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('languages.language.create') }}" class="btn btn-success" title="Create New Language">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
