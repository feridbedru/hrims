@extends('layouts.app')
@section('pagetitle')
    Educational Institutes
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Educational Institutes</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Educational Institutes List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($educationalInstitutes) == 0)
                <h4 class="text-center">No Educational Institutes Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Abbreviation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($educationalInstitutes as $educationalInstitute)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $educationalInstitute->name }}</td>
                                <td>{{ $educationalInstitute->abbreviation }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('educational_institutes.educational_institute.destroy', $educationalInstitute->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('educational_institutes.educational_institute.edit', $educationalInstitute->id) }}"
                                                class="btn btn-warning" title="Edit Educational Institute">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger"
                                                title="Delete Educational Institute"
                                                onclick="return confirm(&quot;Click Ok to delete Educational Institute.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $educationalInstitutes->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('educational_institutes.educational_institute.create') }}" class="btn btn-success"
        title="Create New Educational Institute">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
