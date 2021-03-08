@extends('layouts.employee')

@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">

            <h4 class="card-title">
                {{ isset($employeeCertification->name) ? $employeeCertification->name : 'Employee Certification' }}</h4>

            <div class="card-tools">

                <form method="POST" action="{!! route('employee_certifications.employee_certification.destroy', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">

                        <a href="{{ route('employee_certifications.employee_certification.create',$employee) }}"
                            class="btn btn-success" title="Create New Employee Certification">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('employee_certifications.employee_certification.edit', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) }}"
                            class="btn btn-warning" title="Edit Employee Certification">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>

                        <button type="submit" class="btn btn-danger" title="Delete Employee Certification"
                            onclick="return confirm(&quot;Click Ok to delete Employee Certification.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>

            </div>

        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>Employee</dt>
                <dd>{{ optional($employeeCertification->employee)->en_name }}</dd>
                <dt>Name</dt>
                <dd>{{ $employeeCertification->name }}</dd>
                <dt>Issued On</dt>
                <dd>{{ $employeeCertification->issued_on }}</dd>
                <dt>Certification Number</dt>
                <dd>{{ $employeeCertification->certification_number }}</dd>
                <dt>Skill Category</dt>
                <dd>{{ optional($employeeCertification->categories)->name }}</dd>
                <dt>Verification Link</dt>
                <dd>{{ $employeeCertification->verification_link }}</dd>
                <dt>Certification Vendor</dt>
                <dd>{{ optional($employeeCertification->vendors)->name }}</dd>
                <dt>Attachment</dt>
                <dd>{{ asset('storage/' . $employeeCertification->attachment) }}</dd>
                <dt>Expires On</dt>
                <dd>{{ $employeeCertification->expires_on }}</dd>
                <dt>Status</dt>
                <dd>{{ $employeeCertification->status }}</dd>

            </dl>

        </div>
    </div>

@endsection
