@extends('layouts.employee')
@section('pagetitle')
    Edit Certification
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_certifications.employee_certification.index') }}">Certification</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Certification</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('employee_certifications.employee_certification.update', $employeeCertification->id) }}"
                id="edit_employee_certification_form" name="edit_employee_certification_form" accept-charset="UTF-8"
                class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.certification.form', [
                'employeeCertification' => $employeeCertification,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('employee_certifications.employee_certification.index') }}"
                            class="btn btn-warning mr-5" title="Show All Certification">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
