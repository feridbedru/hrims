@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Print Address'))}}
@endsection
@section('content')
@permission('address_print')
    <div>
        @if (count($employeeAddresses) == 0)
            <h4 class="text-center">{{(__('employee.No Address Available'))}}.</h4>
        @else
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>{{(__('setting.Number'))}}</th>
                        <th>{{__('setting.AddressType')}}</th>
                        <th>{{__('setting.Address')}}</th>
                        <th>{{(__('employee.House Number'))}}</th>
                        <th>{{(__('employee.Heirarchichal Address'))}}</th>
                        <th>{{(__('employee.Status'))}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeeAddresses as $employeeAddress)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employeeAddress->types->name }}</td>
                            <td>{{ $employeeAddress->address }}</td>
                            <td>{{ $employeeAddress->house_number }}</td>
                            <td> {{ optional($employeeAddress->woredas)->name }},
                                @foreach ($zones as $zone)
                                    @if (optional($employeeAddress->woredas)->zone == $zone->id)
                                        {{ $zone->name }},
                                        @foreach ($regions as $region)
                                            @if ($zone->id == $region->id)
                                                {{ $region->name }}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if ($employeeAddress->status == 1)
                                    {{(__('employee.Pending'))}}
                                @elseif($employeeAddress->status == 2)
                                    {{(__('employee.Rejected'))}}
                                @else
                                    {{(__('employee.Approved'))}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @endpermission
@endsection
