@extends('layouts.app')
@section('pagetitle')
    Titles
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Titles</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Titles List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($titles) == 0)
                <h4 class="text-center">No Titles Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>English Title</th>
                            <th>Amharic Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($titles as $title)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $title->en_title }}</td>
                                <td>{{ $title->am_title }}</td>

                                <td>
                                    <form method="POST" action="{!!  route('titles.title.destroy', $title->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('titles.title.edit', $title->id) }}" class="btn btn-warning"
                                                title="Edit Title">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Title"
                                                onclick="return confirm(&quot;Click Ok to delete Title.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $titles->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('titles.title.create') }}" class="btn btn-success" title="Create New Title">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
