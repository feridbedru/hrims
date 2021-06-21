@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Leave Types'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Leave Types'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Leave Types List'))}}</h3>
        </div>

        <div class="card-body"> 
            @permission('leave_types_list') 
        @if(count($leaveTypes) == 0)
                <h4 class="text-center">{{(__('employee.No Leave Types Available.'))}}</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{(__('employee.Name'))}}</th> 
                            <th>{{(__('employee.Job Type'))}}</th> 
                            <th>{{(__('employee.Initial'))}}</th> 
                            <th>{{(__('employee.Maximum'))}}</th> 
                            <th>{{(__('employee.Male'))}}</th> 
                            <th>{{(__('employee.Female'))}}</th> 
                            <th>{{(__('employee.Is Transferable'))}}</th> 
                            <th>{{(__('employee.Pre Post'))}}</th> 
                            <th>{{(__('employee.Is Active'))}}</th> 
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($leaveTypes as $leaveType)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $leaveType->name }}</td>
                            <td>{{ optional($leaveType->jobType)->name }}</td>
                            <td>{{ $leaveType->initial }}</td>
                            <td>{{ $leaveType->maximum }}</td>
                            <td>{{ $leaveType->male }}</td>
                            <td>{{ $leaveType->female }}</td>
                            <td>{{ ($leaveType->is_transferable) ? 'Yes' : 'No' }}</td>
                            <td>{{ $leaveType->pre_post }}</td>
                            <td>{{ ($leaveType->is_active) ? 'Yes' : 'No' }}</td>
                            <td>
                                <form method="POST" action="{!! route('leave_types.leave_type.destroy', $leaveType->id) !!}" accept-charset="UTF-8">
                                    @method('DELETE')
                                    {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @permission('leave_types_show')
                                        <a href="{{ route('leave_types.leave_type.show', $leaveType->id ) }}" class="btn btn-primary" title="Show Leave Type">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        @endpermission
                                        @permission('leave_types_show')
                                        <a href="{{ route('leave_types.leave_type.edit', $leaveType->id ) }}" class="btn btn-warning" title="Edit Leave Type">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>
                                        @endpermission
                                        @permission('leave_types_show')
                                        <button type="submit" class="btn btn-danger" title="Delete Leave Type" onclick="return confirm(&quot;Click Ok to delete Leave Type.&quot;)">
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
            {!! $leaveTypes->links() !!}
        </div>
        @endif
        @endpermission
        </div>
    </div>
    @permission('leave_types_new')
    <a href="{{ route('leave_types.leave_type.create') }}" class="btn btn-success mr-2" title="Create New Leave Type">
        <span class="fa fa-plus" aria-hidden="true">  {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
@endsection