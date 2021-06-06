@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.View Award'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_awards.employee_award.index', $employee) }}">{{(__('employee.Awards'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('employee.View'))}}</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{(__('employee.View Award'))}}</h4>
        </div>

        <div class="card-body">
            @permission('awards_show')
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('setting.Organization'))}}</dt>
                        <dd>{{ $employeeAward->organization }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('setting.AwardType'))}}</dt>
                        <dd>{{ $employeeAward->types->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('setting.AwardedOn'))}}</dt>
                        <dd>{{ $employeeAward->awarded_on }}</dd>
                    </div>
                </div>
                <dt>{{(__('setting.Description'))}}</dt>
                <dd>{{ $employeeAward->description }}</dd>
                @if ($employeeAward->status == 1)
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-12 text-center">
                            <a href="{{ asset('uploads/award/' . $employeeAward->attachment) }}"
                                class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                            <a href="{{ route('employee_awards.employee_award.approve', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) }}"
                                class="btn btn-success mr-3" title="Approve award">
                                {{(__('employee.Approve'))}}
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-reject">
                                {{(__('employee.Reject'))}}
                            </button>
                            <div class="modal fade" id="modal-reject">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title">{{(__('employee.Reject Award'))}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{!! route('employee_awards.employee_award.reject', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) !!}" accept-charset="UTF-8">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <label for="note">{{(__('employee.Note'))}}</label>
                                                <textarea class="form-control" name="note" cols="50" rows="10" id="note"
                                                    minlength="1" maxlength="1000" required="true"></textarea>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">{{(__('employee.Close'))}}</button>
                                                <input class="btn btn-danger" type="submit" value="Reject">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <form method="POST" action="{!! route('employee_awards.employee_award.destroy', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) !!}" accept-charset="UTF-8">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <div class="text-center">
                            <a href="{{ asset('uploads/award/' . $employeeAward->attachment) }}"
                                class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                                @permission('awards_edit')
                            <a href="{{ route('employee_awards.employee_award.edit', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) }}"
                                class="btn btn-warning mr-3" title="Edit Employee Award">
                                {{(__('setting.edit'))}}
                            </a>
                            @endpermission
                            @permission('awards_delete')
                            <button type="submit" class="btn btn-danger" title="Delete Employee Award"
                                onclick="return confirm(&quot;Click Ok to delete Employee Award.?&quot;)">
                                {{(__('setting.delete'))}}
                            </button>
                            @endpermission
                        </div>
                    </form>
                @endif
                </dd>
            </dl>
        </div>
        @endpermission
    </div>

@endsection
