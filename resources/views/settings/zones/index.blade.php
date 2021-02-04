@extends('layouts.app')
@section('pagetitle')
    Zones
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Zones</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Zones List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($zones) == 0)
                <h4 class="text-center">No Zones Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Region</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($zones as $zone)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>{{ $zone->name }}</td>
                            <td>{{ optional($zone->regionS)->name }}</td>

                            <td>
                                <form method="POST" action="{!! route('zones.zone.destroy', $zone->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('zones.zone.show', $zone->id ) }}" class="btn btn-primary" title="Show Zone">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('zones.zone.edit', $zone->id ) }}" class="btn btn-warning" title="Edit Zone">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Zone" onclick="return confirm(&quot;Click Ok to delete Zone.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $zones->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('zones.zone.create') }}" class="btn btn-success" title="Create New Zone">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection