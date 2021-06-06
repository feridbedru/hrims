@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.View Education'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_educations.employee_education.index', $employee) }}">{{(__('employee.Education'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.view'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{(__('employee.View Education'))}}</h4>
        </div>

        <div class="card-body">
            @permission('educations_show_view')
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('setting.Level'))}}</dt>
                        <dd>{{ $employeeEducation->levels->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Institute'))}}</dt>
                        <dd>{{ $employeeEducation->institutes->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Field'))}}</dt>
                        <dd>{{ $employeeEducation->fields->name }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Result'))}} </dt>
                        <dd>{{ $employeeEducation->gpa }} / {{ optional($employeeEducation->gpaScales)->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        @if (isset($employeeEducation->start_date))
                            <dt>{{(__('employee.Start Date'))}}</dt>
                            <dd>{{ $employeeEducation->start_date }}</dd>
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if (isset($employeeEducation->end_date))
                            <dt>{{(__('employee.End Date'))}}</dt>
                            <dd>{{ $employeeEducation->end_date }}</dd>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Has COC'))}}</dt>
                        <dd>{{ $employeeEducation->has_coc ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="col-md-4">
                        @if (isset($employeeEducation->coc_issued_date))
                            <dt>{{(__('employee.COC Issued Date'))}}</dt>
                            <dd>{{ $employeeEducation->coc_issued_date }}</dd>
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if (isset($employeeEducation->coc_file))
                            <dt>{{(__('employee.COC File'))}}</dt>
                            <dd>{{ asset('storage/' . $employeeEducation->coc_file) }}</dd>
                        @endif
                    </div>
                </div>
                @if ($employeeEducation->status == 1)
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-12 text-center">
                            @permission('educations_show')
                            <a href="{{ asset('uploads/education/' . $employeeEducation->file) }}"
                                class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                                @endpermission
                                @permission('educations_approve_reject')
                            <a href="{{ route('employee_educations.employee_education.approve', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) }}"
                                class="btn btn-success mr-3" title="Approve Education">
                                {{(__('employee.Approve'))}}
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#modal-reject">
                                {{(__('employee.Reject'))}}
                            </button>
                            <div class="modal fade" id="modal-reject">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title">{{(__('employee.Reject Education'))}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{!! route('employee_educations.employee_education.reject', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) !!}" accept-charset="UTF-8">
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
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-12 text-center">
                            <form method="POST" action="{!! route('employee_educations.employee_education.destroy', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) !!}" accept-charset="UTF-8">
                                @method('DELETE')
                                {{ csrf_field() }}
                                @permission('educations_show')
                            <a href="{{ asset('uploads/education/' . $employeeEducation->file) }}"
                                class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                                @endpermission
                                @permission('educations_edit')
                                    <a href="{{ route('employee_educations.employee_education.edit', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) }}"
                                        class="btn btn-warning mr-3" title="Edit Employee Education">
                                        {{(__('setting.edit'))}}
                                    </a>
                                    @endpermission
                                    @permission('educations_delete')
                                    <button type="submit" class="btn btn-danger" title="Delete Employee Education"
                                        onclick="return confirm(&quot;Click Ok to delete Employee Education.?&quot;)">
                                        {{(__('setting.delete'))}}
                                    </button>
                                    @endpermission
                            </form>
                        </div>
                    </div>
                @endif
            </dl>
            @endpermission
        </div>
    </div>

@endsection
