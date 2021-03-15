@extends('layouts.employee')
@section('pagetitle')
    View Award
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_awards.employee_award.index', $employee) }}">Awards</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">View Award</h4>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>Organization</dt>
                        <dd>{{ $employeeAward->organization }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Award Type</dt>
                        <dd>{{ $employeeAward->types->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Awarded On</dt>
                        <dd>{{ $employeeAward->awarded_on }}</dd>
                    </div>
                </div>
                <dt>Description</dt>
                <dd>{{ $employeeAward->description }}</dd>
                @if ($employeeAward->status == 1)
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-12 text-center">
                            <a href="{{ asset('uploads/award/' . $employeeAward->attachment) }}"
                                class="btn btn-primary mr-3" target="_blank">View File</a>
                            <a href="{{ route('employee_awards.employee_award.approve', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) }}"
                                class="btn btn-success mr-3" title="Approve award">
                                Approve
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-reject">
                                Reject
                            </button>
                            <div class="modal fade" id="modal-reject">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title">Reject Award</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{!! route('employee_awards.employee_award.reject', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) !!}" accept-charset="UTF-8">
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
                    <form method="POST" action="{!! route('employee_awards.employee_award.destroy', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) !!}" accept-charset="UTF-8">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <div class="text-center">
                            <a href="{{ asset('uploads/award/' . $employeeAward->attachment) }}"
                                class="btn btn-primary mr-3" target="_blank">View File</a>
                            <a href="{{ route('employee_awards.employee_award.edit', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) }}"
                                class="btn btn-warning mr-3" title="Edit Employee Award">
                                Edit
                            </a>

                            <button type="submit" class="btn btn-danger" title="Delete Employee Award"
                                onclick="return confirm(&quot;Click Ok to delete Employee Award.?&quot;)">
                                Delete
                            </button>
                        </div>
                    </form>
                @endif
                </dd>


            </dl>
        </div>
    </div>

@endsection
