@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Awards'))}}
@endsection
@section('content')
@permission('awards_print')
    @if (count($employeeAwards) == 0)
        <h4 class="text-center">{{(__('employee.No Awards Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{__('setting.Organization')}}</th>
                    <th>{{__('setting.AwardType')}}</th>
                    <th>{{(__('employee.Awarded On'))}}</th>
                    <th>{{(__('employee.Description'))}}</th>
                    <th>{{(__('employee.Status'))}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeAwards as $employeeAward)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeAward->organization }}</td>
                        <td>{{ $employeeAward->types->name }}</td>
                        <td>{{ $employeeAward->awarded_on }}</td>
                        <td>{{ $employeeAward->description }}</td>
                        <td>
                            @if ($employeeAward->status == 1)
                            {{(__('employee.Pending'))}}
                            @elseif($employeeAward->status == 2)
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
    @endpermission
@endsection
