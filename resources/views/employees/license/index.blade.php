@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Licenses'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Licenses'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> {{(__('employee.Licenses List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('licenses_list')
            @if (count($employeeLicenses) == 0)
                <h4 class="text-center">{{(__('employee.No Licenses Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Title'))}}</th>
                            <th>{{(__('employee.License Type'))}}</th>
                            <th>{{(__('employee.Issuing Organization'))}}</th>
                            <th>{{(__('employee.Issuing Expiry Date'))}}</th>
                            <th>{{(__('employee.Issuing Attachment'))}}</th>
                            <th>{{(__('employee.Issuing Status'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
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
                                <td>
                                    @permission('licenses_show')
                                    @if (isset($employeeLicense->file))
                                        <a href="{{ asset('uploads/license/' . $employeeLicense->file) }}"
                                            class="btn btn-outline-primary" target="_blank">{{(__('employee.View File'))}}</a>
                                    @endif
                                    @endpermission
                                </td>
                                <td>
                                    @if ($employeeLicense->status == 1)
                                        {{(__('employee.Pending'))}}
                                    @elseif($employeeLicense->status == 2)
                                        {{(__('employee.Rejected'))}}
                                    @else
                                        {{(__('employee.Approved'))}}
                                    @endif
                                </td>

                                <td>
                                    @permission('licenses_approve_reject')
                                    @if ($employeeLicense->status == 1)
                                        <a href="{{ route('employee_licenses.employee_license.approve', ['employee' => $employeeLicense->employees->id, 'employeeLicense' => $employeeLicense->id]) }}"
                                            class="btn btn-outline-success mr-3" title="Approve License">
                                            {{(__('employee.Approve'))}}
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modal-reject">
                                            {{(__('employee.Reject'))}}
                                        </button>
                                        <div class="modal fade" id="modal-reject">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h4 class="modal-title">{{(__('employee.Reject License'))}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{!! route('employee_licenses.employee_license.reject', ['employee' => $employeeLicense->employees->id, 'employeeLicense' => $employeeLicense->id]) !!}"
                                                        accept-charset="UTF-8">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <label for="note">{{(__('employee.Note'))}}</label>
                                                            <textarea class="form-control" name="note" cols="50" rows="10"
                                                                id="note" minlength="1" maxlength="1000"
                                                                required="true"></textarea>
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
                                    @elseif($employeeLicense->status == 2)
                                    @permission('licenses_delete')
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
                                        @endpermission
                                    @else
                                        <form method="POST" action="{!! route('employee_licenses.employee_license.destroy', ['employee' => $employeeLicense->employees->id, 'employeeLicense' => $employeeLicense->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                @permission('licenses_edit')
                                                <a href="{{ route('employee_licenses.employee_license.edit', ['employee' => $employeeLicense->employees->id, 'employeeLicense' => $employeeLicense->id]) }}"
                                                    class="btn btn-warning" title="Edit License">
                                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                                </a>
                                                @endpermission
                                                @permission('licenses_delete')
                                                <button type="submit" class="btn btn-danger" title="Delete License"
                                                    onclick="return confirm(&quot;Click Ok to delete License.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                                @endpermission
                                            </div>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeLicenses->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('licenses_addNew')
    <a href="{{ route('employee_licenses.employee_license.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New License">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
    @if (count($employeeLicenses) > 0)
    @permission('licenses_print')
        <a href="{{ route('employee_licenses.employee_license.print', $employee) }}" class="btn btn-primary" title="Print Employee License" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
        @endpermission
    @endif
@endsection
