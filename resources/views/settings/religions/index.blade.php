@extends('layouts.app')
@section('pagetitle')
    Religions
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Religions</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Religions List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($religions) == 0)
                <h4 class="text-center">No Religions Available.</h4>
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
                        @foreach ($religions as $religion)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $religion->name }}</td>
                                <td>{{ $religion->description }}</td>
                                <td>
                                    <form method="POST" action="{!!  route('religions.religion.destroy', $religion->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}

                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('religions.religion.edit', $religion->id) }}"
                                                class="btn btn-warning" title="Edit Religion">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Religion"
                                                onclick="return confirm(&quot;Click Ok to delete Religion.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $religions->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('religions.religion.create') }}" class="btn btn-success" title="Create New Religion">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
