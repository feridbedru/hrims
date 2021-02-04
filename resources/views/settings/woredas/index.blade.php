@extends('layouts.app')
@section('pagetitle')
    Woredas
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Woredas</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Woredas List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($woredas) == 0)
                <h4 class="text-center">No Woredas Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Zone</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($woredas as $woreda)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>{{ $woreda->name }}</td>
                            <td>{{ optional($woreda->zone)->name }}</td>

                            <td>
                                <form method="POST" action="{!! route('woredas.woreda.destroy', $woreda->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('woredas.woreda.show', $woreda->id ) }}" class="btn btn-primary" title="Show Woreda">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('woredas.woreda.edit', $woreda->id ) }}" class="btn btn-warning" title="Edit Woreda">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Woreda" onclick="return confirm(&quot;Click Ok to delete Woreda.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $woredas->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('woredas.woreda.create') }}" class="btn btn-success" title="Create New Woreda">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection