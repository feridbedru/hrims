@extends('layouts.employee')
@section('pagetitle')
    Licenses
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Licenses</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> Licenses List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeLicenses) == 0)
                <h4 class="text-center">No Licenses Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>License Type</th>
                            <th>Issuing Organization</th>
                            <th>Expiry Date</th>
                            <th>Attachment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeLicenses as $employeeLicense)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeLicense->title }}</td>
                                <td>{{ $employeeLicense->types->name }}</td>
                                <td>{{ $employeeLicense->issuing_organization }}</td>
                                <td>{{ $employeeLicense->expiry_date }}</td>
                                <td>{{ $employeeLicense->file }}</td>
                                <td>
                                    @if ($employeeLicense->status == 1)
                                        Pending
                                    @elseif($employeeLicense->status == 2)
                                        Rejected
                                    @else
                                        Approved
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeLicense->status == 1)
                                        <a href="{{ route('employee_licenses.employee_license.approve', ['employee' => $employeeLicense->employees->id, 'employeeLicense' => $employeeLicense->id]) }}"
                                            class="btn btn-outline-success mr-3" title="Approve License">
                                            Approve
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modal-reject">
                                            Reject
                                        </button>
                                        <div class="modal fade" id="modal-reject">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h4 class="modal-title">Reject License</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{!! route('employee_licenses.employee_license.reject', ['employee' => $employeeLicense->employees->id, 'employeeLicense' => $employeeLicense->id]) !!}"
                                                        accept-charset="UTF-8">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <label for="note">Note</label>
                                                            <textarea class="form-control" name="note" cols="50" rows="10"
                                                                id="note" minlength="1" maxlength="1000"
                                                                required="true"></textarea>
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
                                    @elseif($employeeLicense->status == 2)
                                        <form method="POST" action="{!! route('employee_licenses.employee_license.destroy', ['employee' => $employeeLicense->employees->id, 'employeeLicense' => $employeeLicense->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <button type="submit" class="btn btn-danger" title="Delete License"
                                                    onclick="return confirm(&quot;Click Ok to Employee License.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <form method="POST" action="{!! route('employee_licenses.employee_license.destroy', ['employee' => $employeeLicense->employees->id, 'employeeLicense' => $employeeLicense->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('employee_licenses.employee_license.edit', ['employee' => $employeeLicense->employees->id, 'employeeLicense' => $employeeLicense->id]) }}"
                                                    class="btn btn-warning" title="Edit License">
                                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="Delete License"
                                                    onclick="return confirm(&quot;Click Ok to delete License.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeLicenses->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_licenses.employee_license.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New License">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
    @if (count($employeeLicenses) > 0)
        <a href="#" class="btn btn-primary" title="Print Employee License">
            <span class="fa fa-print" aria-hidden="true"> Print</span>
        </a>
    @endif
@endsection
