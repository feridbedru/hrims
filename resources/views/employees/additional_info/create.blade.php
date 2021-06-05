@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.New Additional Info'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_additional_infos.employee_additional_info.index', $employee) }}">
            {{(__('employee.Additional Info'))}}</a></li>
    <li class="breadcrumb-item active">{{__('setting.New')}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Additional Info'))}}</h3>
        </div>
        <div class="card-body">
            @if (count($employeeAdditionalInfos) == 0)
                <form method="POST"
                    action="{{ route('employee_additional_infos.employee_additional_info.store', $employee) }}"
                    accept-charset="UTF-8" id="create_employee_additional_info_form"
                    name="create_employee_additional_info_form" class="form-horizontal">
                    {{ csrf_field() }}
                    @include ('employees.additional_info.form', [
                    'employeeAdditionalInfo' => null,
                    ])

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-12 text-center">
                            <input class="btn btn-primary mr-5" type="submit" value="Add">
                            <a href="{{ route('employee_additional_infos.employee_additional_info.index', $employee) }}"
                                class="btn btn-warning mr-5" title="Show All Additional Info">
                                {{__('setting.cancel')}}
                            </a>
                            <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                        </div>
                    </div>
                </form>
            @else
                <div class="jumbotron bg-white">
                    <div class="info-icons text-center pb-5">
                        <i class="fa fa-5x fa-exclamation-triangle text-danger"></i>
                    </div>
                    <h2 class="display-5 text-center text-error">{{(__('setting.Error'))}}</h2>
                    <p class="lead text-center">{{(__('employee.You can not create more than one entry for a single employee. Kindly edit
                        the entry using the button below'))}}</p>
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="lead">
                            {{-- {{ dd ($employeeAdditionalInfo)}} --}}
                            <a href="{{ route('employee_additional_infos.employee_additional_info.edit', ['employee' => $employee, 'employeeAdditionalInfo' => $employeeAdditionalInfo[0]->id]) }}"
                                class="btn btn-warning" title="Edit Additional Information">
                                <span class="fa fa-edit" aria-hidden="true"> {{__('setting.edit')}}</span>
                            </a>
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
