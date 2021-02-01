@extends('layouts.app')
@section('pagetitle')
    Nationalities
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Nationalities</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Nationalities List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($nationalities) == 0)
                <h4 class="text-center">No Nationalities Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nationalities as $nationality)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $nationality->name }}</td>
                                <td>{{ $nationality->code }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('nationalities.nationality.destroy', $nationality->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('nationalities.nationality.edit', $nationality->id) }}"
                                                class="btn btn-warning" title="Edit Nationality">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Nationality"
                                                onclick="return confirm(&quot;Click Ok to delete Nationality.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $nationalities->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('nationalities.nationality.create') }}" class="btn btn-success" title="Create New Nationality">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
