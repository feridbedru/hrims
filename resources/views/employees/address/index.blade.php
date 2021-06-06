@extends('layouts.employee')
@section('pagetitle')
{{__('setting.Address')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('setting.Address')}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Address List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('address_list')
            @if (count($employeeAddresses) == 0)
                <h4 class="text-center">{{(__('employee.No Address Available'))}}</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{__('setting.AddressType')}}</th>
                            <th>{{__('setting.Address')}}</th>
                            <th>{{(__('employee.House Number'))}}</th>
                            <th>{{__('setting.Woredas')}}</th>
                            <th>{{(__('emlployee.Status'))}}</th>
                            <th>{{__('setting.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeAddresses as $employeeAddress)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeAddress->types->name }}</td>
                                <td>{{ $employeeAddress->address }}</td>
                                <td>{{ $employeeAddress->house_number }}</td>
                                <td>{{ optional($employeeAddress->woredas)->name }}</td>
                                <td>
                                    @if ($employeeAddress->status == 1)
                                    {{(__('employee.Pending'))}}
                                    @elseif($employeeAddress->status == 2)
                                    {{(__('employee.Rejected'))}}
                                    @else
                                    {{(__('employee.Approved'))}}
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeAddress->status == 1)
                                        <a href="{{ route('employee_addresses.employee_address.approve', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) }}"
                                            class="btn btn-outline-success mr-3" title="Approve Employee Address">
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
                                                        <h4 class="modal-title">{{(__('employee.Reject Address'))}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{!! route('employee_addresses.employee_address.reject', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) !!}"
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
                                                            <input class="btn btn-danger" type="submit" value="{{(__('employee.Reject'))}}">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($employeeAddress->status == 2)
                                        <form method="POST" action="{!! route('employee_addresses.employee_address.destroy', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <button type="submit" class="btn btn-outline-danger" title="Delete Address"
                                                    onclick="return confirm(&quot;Click Ok to delete Employee Address.&quot;)">
                                                    {{__('setting.delete')}}
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <form method="POST" action="{!! route('employee_addresses.employee_address.destroy', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            @permission('address_edit')
                                            <a href="{{ route('employee_addresses.employee_address.edit', ['employee' => $employeeAddress->employees->id, 'employeeAddress' => $employeeAddress->id]) }}"
                                                class="btn btn-outline-warning mr-3" title="Edit Address">
                                                {{__('setting.edit')}}
                                            </a>
                                            @endpermission
                                            @permission('address_delete')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Address"
                                                onclick="return confirm(&quot;Click Ok to delete Address.&quot;)">
                                                {{__('setting.delete')}}
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
                {{ $employeeAddresses->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('address_addNew')
    <a href="{{ route('employee_addresses.employee_address.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Employee Address">
        <span class="fa fa-plus" aria-hidden="true"> {{__('setting.AddNew')}}</span>
    </a>
    @endpermission
    @if (count($employeeAddresses) > 0)
    @permission('address_print')
        <a href="{{ route('employee_addresses.employee_address.print', $employee) }}" class="btn btn-primary" title="Print Employee Address" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
        @endpermission
    @endif
@endsection
