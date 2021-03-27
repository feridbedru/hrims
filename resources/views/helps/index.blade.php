@extends('layouts.app')
@section('pagetitle')
    Helps
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Helps</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Search and Filter</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('helps.help.filter') }}" method="POST" accept-charset="UTF-8" id="filter_help_form"
                name="filter_help_form" class="form-horizontal">
                <div class="row">
                    {{ csrf_field() }}
                    <div class="form-group col-md-2">
                        <select class="form-control" name="language" id="language">
                            <option value="NULL">Select Language</option>
                            @foreach ($languages as $key => $language)
                                <option value="{{ $key }}">
                                    {{ $language }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control" name="parent_id" id="parent_id">
                            <option value="NULL">Select Parent</option>
                            @foreach ($helpers as $key => $helper)
                                <option value="{{ $key }}">
                                    {{ $helper }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" placeholder="enter title here" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group col-md-2 d-flex justify content-between">
                        <input type="submit" class="btn btn-success btn-md  mr-3" value="Filter">
                        <a href="{{ route('helps.help.index') }}" class="btn btn-danger mr-5" title="Show All Helps">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Helps List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($helps) == 0)
                <h4 class="text-center">No Helps Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Topic For</th>
                            <th>Language</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($helps as $help)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $help->title }}</td>
                                <td>{{ $help->topic_for }}</td>
                                <td>{{ optional($help->languagers)->name }}</td>

                                <td>
                                    <form method="POST" action="{!! route('helps.help.destroy', $help->id) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('helps.help.show', $help->id) }}" class="btn btn-primary"
                                                title="Show Help">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('helps.help.edit', $help->id) }}" class="btn btn-warning"
                                                title="Edit Help">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Help"
                                                onclick="return confirm(&quot;Click Ok to delete Help.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $helps->links() }}
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('helps.help.create') }}" class="btn btn-success" title="Create New Help">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
