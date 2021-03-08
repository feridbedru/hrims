@extends('layouts.employee')
@section('pagetitle')
    Certifications
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Certifications</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Certifications List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeCertifications) == 0)
                <h4 class="text-center">No Certifications Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Name</th>
                            <th>Issued On</th>
                            <th>Certification Number</th>
                            <th>Skill Category</th>
                            <th>Verification Link</th>
                            <th>Certification Vendor</th>
                            <th>Expires On</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeCertifications as $employeeCertification)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeCertification->employees->en_name }}</td>
                                <td>{{ $employeeCertification->name }}</td>
                                <td>{{ $employeeCertification->issued_on }}</td>
                                <td>{{ $employeeCertification->certification_number }}</td>
                                <td>{{ $employeeCertification->categories->name }}</td>
                                <td>{{ $employeeCertification->verification_link }}</td>
                                <td>{{ optional($employeeCertification->vendors)->name }}</td>
                                <td>{{ $employeeCertification->expires_on }}</td>
                                <td>{{ $employeeCertification->status }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_certifications.employee_certification.destroy', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_certifications.employee_certification.show', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) }}"
                                                class="btn btn-primary" title="Show Certification">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('employee_certifications.employee_certification.edit', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) }}"
                                                class="btn btn-warning" title="Edit Certification">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Certification"
                                                onclick="return confirm(&quot;Click Ok to delete Certification.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeCertifications->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_certifications.employee_certification.create', $employee) }}" class="btn btn-success"
        title="Create New Employee Certification">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
