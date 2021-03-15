@extends('layouts.employee')
@section('pagetitle')
    View Education
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_educations.employee_education.index', $employee) }}">Education</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">View Education</h4>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>Level</dt>
                        <dd>{{ $employeeEducation->levels->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Institute</dt>
                        <dd>{{ $employeeEducation->institutes->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Field</dt>
                        <dd>{{ $employeeEducation->fields->name }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>Result </dt>
                        <dd>{{ $employeeEducation->gpa }} / {{ optional($employeeEducation->gpaScales)->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        @if (isset($employeeEducation->start_date))
                            <dt>Start Date</dt>
                            <dd>{{ $employeeEducation->start_date }}</dd>
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if (isset($employeeEducation->end_date))
                            <dt>End Date</dt>
                            <dd>{{ $employeeEducation->end_date }}</dd>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>Has Coc</dt>
                        <dd>{{ $employeeEducation->has_coc ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="col-md-4">
                        @if (isset($employeeEducation->coc_issued_date))
                            <dt>Coc Issued Date</dt>
                            <dd>{{ $employeeEducation->coc_issued_date }}</dd>
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if (isset($employeeEducation->coc_file))
                            <dt>COC File</dt>
                            <dd>{{ asset('storage/' . $employeeEducation->coc_file) }}</dd>
                        @endif
                    </div>
                </div>
                @if ($employeeEducation->status == 1)
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-12 text-center">
                            <a href="{{ asset('uploads/education/' . $employeeEducation->file) }}"
                                class="btn btn-primary mr-3" target="_blank">View File</a>
                            <a href="{{ route('employee_educations.employee_education.approve', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) }}"
                                class="btn btn-success mr-3" title="Approve Education">
                                Approve
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#modal-reject">
                                Reject
                            </button>
                            <div class="modal fade" id="modal-reject">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title">Reject Education</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{!! route('employee_educations.employee_education.reject', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) !!}" accept-charset="UTF-8">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <label for="note">Note</label>
                                                <textarea class="form-control" name="note" cols="50" rows="10" id="note"
                                                    minlength="1" maxlength="1000" required="true"></textarea>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <input class="btn btn-danger" type="submit" value="Reject">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-12 text-center">
                            <form method="POST" action="{!! route('employee_educations.employee_education.destroy', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) !!}" accept-charset="UTF-8">
                                @method('DELETE')
                                {{ csrf_field() }}
                            <a href="{{ asset('uploads/education/' . $employeeEducation->file) }}"
                                class="btn btn-primary mr-3" target="_blank">View File</a>
                                    <a href="{{ route('employee_educations.employee_education.edit', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) }}"
                                        class="btn btn-warning mr-3" title="Edit Employee Education">
                                        Edit
                                    </a>
                                    <button type="submit" class="btn btn-danger" title="Delete Employee Education"
                                        onclick="return confirm(&quot;Click Ok to delete Employee Education.?&quot;)">
                                        Delete
                                    </button>
                            </form>
                        </div>
                    </div>
                @endif

            </dl>
        </div>
    </div>

@endsection
