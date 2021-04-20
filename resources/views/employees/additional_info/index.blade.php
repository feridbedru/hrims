@extends('layouts.employee')
@section('pagetitle')
{{(__('emplyee.Additional Infos'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('emplyee.Additional Infos'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.{{(__('emplyee.Additional Infos'))}}'))}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($employeeAdditionalInfos) == 0)
                <h4 class="text-center">{{(__('employee.No Additional Infos Available'))}}</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('employee.Number'))}}</th>
                            <th>{{(__('employee.Place Of Birth'))}}</th>
                            <th>{{(__('employee.Other Phone Number'))}}</th>
                            <th>{{(__('employee.Nationality'))}}</th>
                            <th>{{(__('employee.Religions'))}}</th>
                            <th>{{(__('employee.Blood Group'))}}</th>
                            <th>{{(___('employee.Tin Number'))}}</th>
                            <th>{{(__('employee.Pension'))}}</th>
                            <th>{{__('employee.MaritalStatus')}}</th>
                            <th>{{((__('setting.Actions')))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeAdditionalInfos as $employeeAdditionalInfo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeAdditionalInfo->place_of_birth }}</td>
                                <td>{{ $employeeAdditionalInfo->other_phone_number }}</td>
                                <td>{{ optional($employeeAdditionalInfo->nationality)->name }}</td>
                                <td>{{ optional($employeeAdditionalInfo->religion)->name }}</td>
                                <td>{{ $employeeAdditionalInfo->blood_group }}</td>
                                <td>{{ $employeeAdditionalInfo->tin_number }}</td>
                                <td>{{ $employeeAdditionalInfo->pension }}</td>
                                <td>{{ optional($employeeAdditionalInfo->maritalStatus)->name }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_additional_infos.employee_additional_info.destroy', ['employee' => $employeeAdditionalInfo->employees->id, 'employeeAdditionalInfo' => $employeeAdditionalInfo->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_additional_infos.employee_additional_info.edit', ['employee' => $employeeAdditionalInfo->employees->id, 'employeeAdditionalInfo' => $employeeAdditionalInfo->id]) }}"
                                                class="btn btn-warning" title="Edit Employee Additional Info">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger"
                                                title="Delete Employee Additional Info"
                                                onclick="return confirm(&quot;Click Ok to delete Employee Additional Info.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeAdditionalInfos->links() }}
                </div>
            @endif
        </div>
    </div>
    @if (count($employeeAdditionalInfos) == 0)
        <a href="{{ route('employee_additional_infos.employee_additional_info.create', $employee) }}"
            class="btn btn-success" title="Create New Additional Info">
            <span class="fa fa-plus" aria-hidden="true"> {{__('setting.AddNew')}}</span>
        </a>
    @else
        <a href="{{ route('employee_additional_infos.employee_additional_info.print', $employee) }}" class="btn btn-primary" title="Print Employee Additional Info" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{__('setting.AddNew')}}</span>
        </a>
    @endif
@endsection
