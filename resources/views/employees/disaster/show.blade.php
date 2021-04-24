@extends('layouts.employee')
@section('pagetitle')
    {{ __('employee.View Disaster') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_disasters.employee_disaster.index', $employee) }}">{{ __('employee.Disaster') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('setting.view') }}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title"> {{ __('employee.View Disaster') }}</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('employee_disasters.employee_disaster.destroy', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('employee_disasters.employee_disaster.edit', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) }}"
                            class="btn btn-warning" title="Edit Employee Disaster">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        <button type="submit" class="btn btn-danger" title="Delete Employee Disaster"
                            onclick="return confirm(&quot;Click Ok to delete Employee Disaster.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{ __('employee.Occured On') }}</dt>
                        <dd>{{ $employeeDisaster->occured_on }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{ __('employee.Disaster Cause') }}</dt>
                        <dd>{{ $employeeDisaster->causes->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{ __('employee.Disaster Severity') }}</dt>
                        <dd>{{ $employeeDisaster->severities->name }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{ __('employee.Is Mass') }}</dt>
                        <dd>{{ $employeeDisaster->is_mass ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{ __('employee.Status') }}</dt>
                        <dd>{{ $employeeDisaster->status }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{ __('employee.Attachment') }}</dt>
                        <dd><a href="{{ asset('uploads/disaster/' . $employeeDisaster->attachment) }}"
                                class="btn btn-primary mr-3" target="_blank">{{ __('employee.View File') }}</a></dd>
                    </div>
                </div>
                <dt>{{ __('setting.Description') }}</dt>
                <dd>{{ $employeeDisaster->description }}</dd>
            </dl>
        </div>
    </div>

    <div class="row">
        {{-- Witness div --}}
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('employee.Disaster Witnesses List') }}</h3>
                </div>

                <div class="card-body">
                    @if (count($employeeDisasterWitnesses) == 0)
                        <h4 class="text-center">{{ __('employee.No Disaster Witnesses Available') }}.</h4>
                    @else
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>{{ __('setting.Number') }}</th>
                                    <th>{{ __('setting.Name') }}</th>
                                    <th>{{ __('setting.PhoneNumber') }}</th>
                                    <th>{{ __('employee.File') }}</th>
                                    <th>{{ __('setting.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employeeDisasterWitnesses as $employeeDisasterWitness)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employeeDisasterWitness->name }}</td>
                                        <td>{{ $employeeDisasterWitness->phone }}</td>
                                        <td>
                                            @if ($employeeDisasterWitness->file)
                                                <a href="{{ asset('uploads/disaster/witness/' . $employeeDisasterWitness->file) }}"
                                                    class="btn btn-primary mr-3"
                                                    target="_blank">{{ __('employee.View File') }}</a>
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-warning mr-2" data-toggle="modal"
                                                data-target="#modal-editwitness{{ $employeeDisasterWitness->id }}">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </button>
                                            <div class="modal fade"
                                                id="modal-editwitness{{ $employeeDisasterWitness->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Witness</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('employee_disaster_witnesses.employee_disaster_witness.update', ['employee' => $employee->id, 'employeeDisasterWitness' => $employeeDisasterWitness->id]) }}"
                                                                accept-charset="UTF-8"
                                                                id="edit_employee_disaster_witness_form"
                                                                name="edit_employee_disaster_witness_form"
                                                                class="form-horizontal" enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                @include ('employees.disaster.witnessform', [
                                                                'employeeDisasterWitness' =>
                                                                $employeeDisasterWitness,
                                                                'employeeDisaster' => $employeeDisaster->id,
                                                                ])

                                                                <div class="form-group">
                                                                    <div class="col-md-offset-2 col-md-12 text-center">
                                                                        <input class="btn btn-primary mr-5" type="submit"
                                                                            value="{{ __('setting.save') }}">
                                                                        <input class="btn btn-danger" type="reset"
                                                                            value="{{ __('setting.Reset') }}">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form class="d-inline" method="POST" action="{!! route('employee_disaster_witnesses.employee_disaster_witness.destroy', ['employee' => $employee->id, 'employeeDisasterWitness' => $employeeDisasterWitness->id]) !!}"
                                                accept-charset="UTF-8">
                                                @method('DELETE')
                                                {{ csrf_field() }}
                                                <div class="btn-group btn-group-xs pull-right" role="group">
                                                    <button type="submit" class="btn btn-danger"
                                                        title="Delete Disaster Witness"
                                                        onclick="return confirm(&quot;Click Ok to delete Disaster Witness.&quot;)">
                                                        <span class="fa fa-trash" aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-witness">
                <span class="fa fa-plus" aria-hidden="true"> {{ __('setting.AddNew') }}</span>
            </button>
            <div class="modal fade" id="modal-witness">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Witness</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST"
                                action="{{ route('employee_disaster_witnesses.employee_disaster_witness.store', ['employee' => $employee->id, 'employeeDisaster' => $employeeDisaster->id]) }}"
                                accept-charset="UTF-8" id="create_employee_disaster_witness_form"
                                name="create_employee_disaster_witness_form" class="form-horizontal"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @include ('employees.disaster.witnessform', [
                                'employeeDisasterWitness' => null,
                                'employeeDisaster' => $employeeDisaster->id,
                                ])

                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-12 text-center">
                                        <input class="btn btn-primary mr-5" type="submit"
                                            value="{{ __('setting.save') }}">
                                        <input class="btn btn-danger" type="reset" value="{{ __('setting.Reset') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- indeminities div --}}
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('employee.Disaster Indeminities List') }}</h3>
                </div>

                <div class="card-body">
                    @if (count($employeeDisasterIndeminities) == 0)
                        <h4 class="text-center">{{ __('employee.No Disaster Indeminities Available') }}.</h4>
                    @else
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>{{ __('setting.Number') }}</th>
                                    <th>{{ __('setting.Title') }}</th>
                                    <th>{{ __('employee.Cost') }}</th>
                                    <th>{{ __('employee.File') }}</th>
                                    <th>{{ __('setting.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employeeDisasterIndeminities as $employeeDisasterIndeminity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employeeDisasterIndeminity->title }}</td>
                                        <td>{{ $employeeDisasterIndeminity->cost }}</td>
                                        <td>
                                            @if ($employeeDisasterIndeminity->file)
                                                <a href="{{ asset('uploads/disaster/indeminity/' . $employeeDisasterIndeminity->file) }}"
                                                    class="btn btn-primary mr-3"
                                                    target="_blank">{{ __('employee.View File') }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning mr-2" data-toggle="modal"
                                                data-target="editindeminity{{ $employeeDisasterIndeminity->id }}">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </button>
                                            <div class="modal fade"
                                                id="editindeminity{{ $employeeDisasterIndeminity->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Indeminity</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.update', ['employee' => $employee->id, 'employeeDisasterIndeminity' => $employeeDisasterIndeminity->id]) }}"
                                                                id="edit_employee_disaster_indeminity_form"
                                                                name="edit_employee_disaster_indeminity_form"
                                                                accept-charset="UTF-8" class="form-horizontal"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <input name="_method" type="hidden" value="PUT">
                                                                @include ('employees.disaster.indeminityform', [
                                                                'employeeDisasterIndeminity' => $employeeDisasterIndeminity,
                                                                'employeeDisaster' => $employeeDisaster->id,
                                                                ])

                                                                <div class="form-group">
                                                                    <div class="col-md-offset-2 col-md-12 text-center">
                                                                        <input class="btn btn-primary mr-5" type="submit"
                                                                            value="{{ __('setting.update') }}">
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form class="d-inline" method="POST" action="{!! route('employee_disaster_indeminities.employee_disaster_indeminity.destroy', ['employeeDisasterIndeminity' => $employeeDisasterIndeminity->id, 'employee' => $employee->id]) !!}"
                                                accept-charset="UTF-8">
                                                @method('DELETE')
                                                {{ csrf_field() }}
                                                <div class="btn-group btn-group-xs pull-right" role="group">
                                                    <button type="submit" class="btn btn-danger"
                                                        title="Delete Disaster Indeminity"
                                                        onclick="return confirm(&quot;Click Ok to delete Disaster Indeminity.&quot;)">
                                                        <span class="fa fa-trash" aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addindeminity">
                <span class="fa fa-plus" aria-hidden="true"> {{ __('setting.AddNew') }}</span>
            </button>
            <div class="modal fade" id="addindeminity">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Indeminity</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST"
                                action="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.store', ['employee' => $employee->id, 'employeeDisaster' => $employeeDisaster->id]) }}"
                                accept-charset="UTF-8" id="create_employee_disaster_indeminity_form"
                                name="create_employee_disaster_indeminity_form" class="form-horizontal"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @include ('employees.disaster.indeminityform', [
                                'employeeDisasterIndeminity' => null,
                                'employeeDisaster' => $employeeDisaster->id,
                                ])

                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-12 text-center">
                                        <input class="btn btn-primary mr-5" type="submit"
                                            value="{{ __('setting.save') }}">
                                        <input class="btn btn-danger" type="reset" value="{{ __('setting.Reset') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
