@extends('layouts.app')
@section('pagetitle')
    Disability Types
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Disability Types</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Disability Types List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($disabilityTypes) == 0)
                <h4 class="text-center">No Disability Types Available.</h4>
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
                        @foreach ($disabilityTypes as $disabilityType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $disabilityType->name }}</td>
                                <td>{{ $disabilityType->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('disability_types.disability_type.destroy', $disabilityType->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('disability_types.disability_type.edit', $disabilityType->id) }}"
                                                class="btn btn-warning" title="Edit Disability Type">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Disability Type"
                                                onclick="return confirm(&quot;Click Ok to delete Disability Type.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $disabilityTypes->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('disability_types.disability_type.create') }}" class="btn btn-success"
        title="Create New Disability Type">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
