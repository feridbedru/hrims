@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Disabilities'))}}
@endsection
@section('content')
@permission('disabilities_print')
    @if (count($employeeDisabilities) == 0)
        <h4 class="text-center">{{(__('employee.No Disabilities Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Type') }}</th>
                    <th>{{ __('setting.Description') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeDisabilities as $employeeDisability)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeDisability->types->name }}</td>
                        <td>{{ $employeeDisability->description }}</td>
                        <td>
                            @if ($employeeDisability->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeDisability->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
