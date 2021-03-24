@extends('layouts.printer')
@section('pagetitle')
    Print Address
@endsection
@section('content')
    <div>
        @if (count($employeeAddresses) == 0)
            <h4 class="text-center">No Address Available.</h4>
        @else
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Address Type</th>
                        <th>Address</th>
                        <th>House Number</th>
                        <th>Heirarchichal Address</th>
                        <th>Status</th>
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
                                    Pending
                                @elseif($employeeAddress->status == 2)
                                    Rejected
                                @else
                                    Approved
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
