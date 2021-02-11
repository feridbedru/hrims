@extends('layouts.app')
@section('pagetitle')
    Commitment Fors
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Commitment Fors</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Commitment Fors List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($commitmentFors) == 0)
                <h4 class="text-center">No Commitment Fors Available.</h4>
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
                        @foreach ($commitmentFors as $commitmentFor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $commitmentFor->name }}</td>
                                <td>{{ $commitmentFor->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('commitment_fors.commitment_for.destroy', $commitmentFor->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('commitment_fors.commitment_for.edit', $commitmentFor->id) }}"
                                                class="btn btn-warning" title="Edit Commitment For">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Commitment For"
                                                onclick="return confirm(&quot;Click Ok to delete Commitment For.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $commitmentFors->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('commitment_fors.commitment_for.create') }}" class="btn btn-success"
        title="Create New Commitment For">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
