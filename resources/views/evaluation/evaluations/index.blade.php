@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Evaluations'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Evaluations'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Evaluations List'))}}</h3>
        </div>

        <div class="card-body"> 
            @permission('evaluation_list') 
        @if(count($evaluations) == 0)
                <h4 class="text-center">{{(__('employee.No Evaluations Available.'))}}</h4>
        @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{(__('employee.Title'))}}</th> 
                    <th>{{(__('employee.Time Period'))}}</th> 
                    <th>{{(__('employee.Start Date'))}}</th> 
                    <th>{{(__('employee.End Date'))}}</th> 
                    <th>{{(__('employee.Status'))}}</th> 
                    <th>{{(__('setting.Actions'))}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($evaluations as $evaluation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $evaluation->title }}</td>
                    <td>{{ $evaluation->time_period }}</td>
                    <td>{{ $evaluation->start_date }}</td>
                    <td>{{ $evaluation->end_date }}</td>
                    <td>{{ $evaluation->status }}</td>
                    <td>
                        <form method="POST" action="{!! route('evaluations.evaluation.destroy', $evaluation->id) !!}" accept-charset="UTF-8">
                            @method('DELETE')
                            {{ csrf_field() }}
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                @permission('evaluation_show')
                                <a href="{{ route('evaluations.evaluation.show', $evaluation->id ) }}" class="btn btn-primary" title="Show Evaluation">
                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                </a>
                                @endpermission
                                @permission('evaluation_edit')
                                <a href="{{ route('evaluations.evaluation.edit', $evaluation->id ) }}" class="btn btn-warning" title="Edit Evaluation">
                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                </a>
                                @endpermission
                                @permission('evaluation_delete')
                                <button type="submit" class="btn btn-danger" title="Delete Evaluation" onclick="return confirm(&quot;Click Ok to delete Evaluation.&quot;)">
                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                </button>
                                @endpermission
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-2">
            {!! $evaluations->links() !!}
        </div>
    @endif
    @endpermission
    </div>
</div>
@permission('evaluation_new')
<a href="{{ route('evaluations.evaluation.create') }}" class="btn btn-success mr-2" title="Create New Evaluation">
    <span class="fa fa-plus" aria-hidden="true">  {{(__('setting.AddNew'))}}</span>
</a>
@endpermission
@endsection