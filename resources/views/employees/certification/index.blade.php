@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Certifications'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Certifications'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Certifications List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('certifications_list')
            @if (count($employeeCertifications) == 0)
                <h4 class="text-center">{{__('setting.No Certifications Available')}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Name'))}}</th>
                            <th>{{(__('employee.Issued On'))}}</th>
                            <th>{{(__('employee.Skill Category'))}}</th>
                            <th>{{(__('setting.CertificationVendors'))}}</th>
                            <th>{{(__('employee.Status'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
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
                                <td>
                                    @if ($employeeCertification->status == 1)
                                        {{(__('employee.Pending'))}}
                                    @elseif($employeeCertification->status == 2)
                                        {{(__('employee.Rejected'))}}
                                    @else
                                        {{(__('employee.Approved'))}}
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeCertification->status == 3)
                                        <form method="POST" action="{!! route('employee_certifications.employee_certification.destroy', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                @permission('certifications_show')
                                                <a href="{{ route('employee_certifications.employee_certification.show', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) }}"
                                                    class="btn btn-primary" title="Show Certification">
                                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                                </a>
                                                @permission('certifications_edit')
                                                @endpermission
                                                <a href="{{ route('employee_certifications.employee_certification.edit', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) }}"
                                                    class="btn btn-warning" title="Edit Certification">
                                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                                </a>
                                                @endpermission
                                                @permission('certifications_delete')
                                                <button type="submit" class="btn btn-danger" title="Delete Certification"
                                                    onclick="return confirm(&quot;Click Ok to delete Certification.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                                @endpermission
                                            </div>
                                        </form>
                                    @else
                                    @permission('certifications_show')
                                        <a href="{{ route('employee_certifications.employee_certification.show', ['employee' => $employeeCertification->employees->id, 'employeeCertification' => $employeeCertification->id]) }}"
                                            class="btn btn-primary" title="Show Certification">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        @endpermission
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeCertifications->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('certifications_addNew')
    <a href="{{ route('employee_certifications.employee_certification.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Employee Certification">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
    @if (count($employeeCertifications) > 0)
    @permission('certifications_print')
        <a href="{{ route('employee_certifications.employee_certification.print', $employee) }}" class="btn btn-primary" title="Print Employee Certification" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
        @endpermission
    @endif
@endsection
