@extends('layouts.printer')
@section('pagetitle')
    {{ __('employee.Families') }}
@endsection
@section('content')
@permission('families_print')
    @if (count($employeeFamilies) == 0)
        <h4 class="text-center">{{ __('employee.No Families Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Name') }}</th>
                    <th>{{ __('employee.Sex') }}</th>
                    <th>{{ __('setting.Relationships') }}</th>
                    <th>{{ __('employee.Date Of Birth') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeFamilies as $employeeFamily)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeFamily->name }}</td>
                        <td>{{ $employeeFamily->sexes->name }}</td>
                        <td>{{ $employeeFamily->relationships->name }}</td>
                        <td>{{ $employeeFamily->date_of_birth }}</td>
                        <td>
                            @if ($employeeFamily->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeFamily->status == 2)
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
