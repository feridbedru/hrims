@extends('layouts.app')
@section('pagetitle')
    Sexes
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Sexes</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Sexes List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($sexes) == 0)
                <h4 class="text-center">No Sexes Available.</h4>
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
                        @foreach ($sexes as $sex)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sex->name }}</td>
                                <td>{{ $sex->description }}</td>
                                <td>
                                    <form method="POST" action="{!!  route('sexes.sex.destroy', $sex->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('sexes.sex.edit', $sex->id) }}" class="btn btn-warning"
                                                title="Edit Sex">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Sex"
                                                onclick="return confirm(&quot;Click Ok to delete Sex.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $sexes->render() !!}
            @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('sexes.sex.create') }}" class="btn btn-success" title="Create New Sex">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection
