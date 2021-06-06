@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.View Certification'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_certifications.employee_certification.index', $employee) }}">{{(__('employee.Certification'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.view'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{(__('employee.View Certification'))}}</h4>
        </div>

        <div class="card-body">
            @permission('certifications_show')
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('setting.Name'))}}</dt>
                        <dd>{{ $employeeCertification->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Skill Category'))}}</dt>
                        <dd>{{ optional($employeeCertification->categories)->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Certification Number'))}}</dt>
                        <dd>{{ $employeeCertification->certification_number }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('setting.CertificationVendors'))}}</dt>
                        <dd>{{ optional($employeeCertification->vendors)->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Verification Link'))}}</dt>
                        <dd>{{ $employeeCertification->verification_link }}</dd>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Issued On'))}}</dt>
                        <dd>{{ $employeeCertification->issued_on }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Expires On'))}}</dt>
                        <dd>{{ $employeeCertification->expires_on }}</dd>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
                @if ($employeeCertification->status == 1)
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-12 text-center">
                            <a href="{{ asset('uploads/certification/' . $employeeCertification->file) }}"
                                class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                                @permission('certifications_approve_reject')
                            <a href="{{ route('employee_certifications.employee_certification.approve', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) }}"
                                class="btn btn-success mr-3" title="Approve Certification">
                                {{(__('employee.Approve'))}}
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-reject">
                                {{(__('employee.Reject'))}}
                            </button>
                            <div class="modal fade" id="modal-reject">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title">{{(__('employee.Reject Certification'))}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{!! route('employee_certifications.employee_certification.reject', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) !!}" accept-charset="UTF-8">
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
                    <form method="POST" action="{!! route('employee_certifications.employee_certification.destroy', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) !!}" accept-charset="UTF-8">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <div class="text-center">
                        <a href="{{ asset('uploads/certification/' . $employeeCertification->file) }}"
                            class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                            @permission('certifications_edit')
                        <a href="{{ route('employee_certifications.employee_certification.edit', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) }}"
                            class="btn btn-warning mr-3" title="Edit Employee Certification">
                            {{(__('setting.edit'))}}
                        </a>
                        @endpermission
                        @permission('certifications_delete')
                        <button type="submit" class="btn btn-danger" title="Delete Employee Certification"
                            onclick="return confirm(&quot;Click Ok to delete Employee Certification.?&quot;)">
                            {{(__('setting.delete'))}}
                        </button>
                        @endpermission
                    </div>
                    </form>
                @endif
            </dl>
        </div>
        @endpermission
    </div>

@endsection
