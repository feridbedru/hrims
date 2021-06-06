@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Disabilities'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Disabilities'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Disabilities List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('disabilities_list')
            @if (count($employeeDisabilities) == 0)
                <h4 class="text-center">{{(__('employee.No Disability Available'))}}</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Type'))}}</th>
                            <th>{{(__('setting.Description'))}}</th>
                            <th>{{(__('employee.Medical Certificate'))}}</th>
                            <th>{{(__('employee.Status'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeDisabilities as $employeeDisability)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeDisability->types->name }}</td>
                                <td>{{ $employeeDisability->description }}</td>
                                <td>
                                    @if(isset($employeeDisability->medical_certificate ))
                                    <a href="{{ asset('uploads/disability/' . $employeeDisability->medical_certificate) }}" class="btn btn-outline-primary" target="_blank">{{(__('employee.View File'))}}</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($employeeDisability->status == 1)
                                        {{(__('employee.Pending'))}}
                                    @elseif($employeeDisability->status == 2)
                                        {{(__('employee.Rejected'))}}
                                    @else
                                        {{(__('employee.Approved'))}}
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeDisability->status == 1)
                                    @permission('disabilities_approve_reject')
                                        <a href="{{ route('employee_disabilities.employee_disability.approve', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) }}"
                                            class="btn btn-outline-success mr-3" title="Approve Disability">
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
                                                        <h4 class="modal-title">{{(__('employee.Reject Disability'))}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{!! route('employee_disabilities.employee_disability.reject', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) !!}"
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
                                    @elseif($employeeDisability->status == 2)
                                    @permission('disabilities_delete')
                                        <form method="POST" action="{!! route('employee_disabilities.employee_disability.destroy', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Disability"
                                                onclick="return confirm(&quot;Click Ok to delete Disability.&quot;)">
                                                {{(__('setting.delete'))}}
                                            </button>
                                        </form>
                                        @endpermission
                                    @else
                                        <form method="POST" action="{!! route('employee_disabilities.employee_disability.destroy', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            @permission('disabilities_edit')
                                            <a href="{{ route('employee_disabilities.employee_disability.edit', ['employee' => $employeeDisability->employees->id, 'employeeDisability' => $employeeDisability->id]) }}"
                                                class="btn btn-outline-warning mr-2" title="Edit Disability">
                                                {{(__('setting.edit'))}}
                                            </a>
                                            @endpermission
                                            @permission('disabilities_delete')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Disability"
                                                onclick="return confirm(&quot;Click Ok to delete Disability.&quot;)">
                                                {{(__('setting.delete'))}}
                                            </button>
                                            @endpermission
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeDisabilities->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('disabilities_addNew')
    <a href="{{ route('employee_disabilities.employee_disability.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Disability">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
    @if (count($employeeDisabilities) > 0)
    @permission('disabilities_print')
        <a href="{{ route('employee_disabilities.employee_disability.print', $employee) }}" class="btn btn-primary" title="Print Employee Disability" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
        @endpermission
    @endif
@endsection
