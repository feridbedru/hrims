@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.View Experience'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_experiences.employee_experience.index', $employee) }}">{{(__('employee.Experience'))}}</a>
    </li>
    <li class="breadcrumb-item active">{{(__('setting.view'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{(__('employee.View Experience'))}}</h4>
        </div>

        <div class="card-body">
            @permission('experience_show')
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Experience Type'))}}</dt>
                        <dd>{{ $employeeExperience->types->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Organization Name'))}}</dt>
                        <dd>{{ $employeeExperience->organization_name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Organization Address'))}}</dt>
                        <dd>{{ $employeeExperience->organization_address }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Job Position'))}}</dt>
                        <dd>{{ $employeeExperience->job_position }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('setting.Level'))}}</dt>
                        <dd>{{ $employeeExperience->level }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('setting.Salary'))}}</dt>
                        <dd>{{ $employeeExperience->salary }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Left Reason'))}}</dt>
                        <dd>{{ $employeeExperience->leftReasons->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Start Date'))}}</dt>
                        <dd>{{ $employeeExperience->start_date }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.End Date'))}}</dt>
                        <dd>{{ $employeeExperience->end_date }}</dd>
                    </div>
                </div>
                @if ($employeeExperience->status == 1)
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-12 text-center">
                            @permission('experience_show')
                            <a href="{{ asset('uploads/experience/' . $employeeExperience->attachment) }}"
                                class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                                @endpermission
                                @permission('experience_approve_reject')
                            <a href="{{ route('employee_experiences.employee_experience.approve', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) }}"
                                class="btn btn-success mr-3" title="Approve Experience">
                                {{(__('employee.Approve'))}}
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-reject">
                                {{(__('employee.Reject'))}}
                            </button>
                            <div class="modal fade" id="modal-reject">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title">{{(__('employee.Reject Experience'))}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{!! route('employee_experiences.employee_experience.reject', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) !!}" accept-charset="UTF-8">
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
                            @endpermission
                        </div>
                    </div>
                @else
                    <form method="POST" action="{!! route('employee_experiences.employee_experience.destroy', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) !!}" accept-charset="UTF-8">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <div class="text-center">
                            @permission('experience_show')
                        <a href="{{ asset('uploads/experience/' . $employeeExperience->attachment) }}"
                            class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                            @endpermission
                            @permission('experience_edit')
                        <a href="{{ route('employee_experiences.employee_experience.edit', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) }}"
                            class="btn btn-warning mr-3" title="Edit Experience">
                            {{(__('setting.edit'))}}
                        </a>
                        @endpermission
                        @permission('experience_delete')
                        <button type="submit" class="btn btn-danger" title="Delete Experience"
                            onclick="return confirm(&quot;Click Ok to delete Experience.?&quot;)">
                            {{(__('setting.delete'))}}
                        </button>
                        @endpermission
                        </div>
                    </form>
                @endif
                @endpermission
            </dl>
        </div>
    </div>

@endsection
