@extends('layouts.printer')
@section('pagetitle')
    Licenses
@endsection
@section('content')
    @if (count($employeeLicenses) == 0)
        <h4 class="text-center">No Licenses Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>Title</th>
                    <th>License Type</th>
                    <th>Issuing Organization</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
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
                            @if ($employeeLicense->status == 1)
                                Pending
                            @elseif($employeeLicense->status == 2)
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
@endsection
