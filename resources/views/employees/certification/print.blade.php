@extends('layouts.printer')
@section('pagetitle')
    Certifications
@endsection
@section('content')
    @if (count($employeeCertifications) == 0)
        <h4 class="text-center">No Certifications Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Issued On</th>
                    <th>Skill Category</th>
                    <th>Certification Vendor</th>
                    <th>Link</th>
                    <th>Expires On</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeCertifications as $employeeCertification)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeCertification->name }}</td>
                        <td>{{ $employeeCertification->issued_on }}</td>
                        <td>{{ $employeeCertification->categories->name }}</td>
                        <td>{{ optional($employeeCertification->vendors)->name }}</td>
                        <td>{{ $employeeCertification->verification_link }}</td>
                        <td>{{ $employeeCertification->expires_on }}</td>
                        <td>
                            @if ($employeeCertification->status == 1)
                                Pending
                            @elseif($employeeCertification->status == 2)
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
