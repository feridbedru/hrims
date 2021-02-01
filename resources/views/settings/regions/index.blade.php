@extends('layouts.app')
@section('pagetitle')
    Regions
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Regions</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Regions List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($regions) == 0)
                <h4 class="text-center">No Regions Available.</h4>
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
                        @foreach ($regions as $region)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $region->name }}</td>
                                <td>{{ $region->code }}</td>
                                <td>
                                    <form method="POST" action="{!!  route('regions.region.destroy', $region->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('regions.region.show', $region->id) }}"
                                                class="btn btn-outline-success" title="Show Zones">
                                                Zones
                                            </a>
                                            <a href="{{ route('regions.region.edit', $region->id) }}"
                                                class="btn btn-warning" title="Edit Region">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Region"
                                                onclick="return confirm(&quot;Click Ok to delete Region.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $regions->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('regions.region.create') }}" class="btn btn-success" title="Create New Region">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
