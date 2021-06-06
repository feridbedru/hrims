@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Languages'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Languages'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Languages List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('languages_list')
            @if (count($employeeLanguages) == 0)
                <h4 class="text-center">{{(__('employee.No Languages Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('employee.Languages'))}}</th>
                            <th>{{(__('employee.Reading'))}}</th>
                            <th>{{(__('employee.Writing'))}}</th>
                            <th>{{(__('employee.Listening'))}}</th>
                            <th>{{(__('employee.Speaking'))}}</th>
                            <th>{{(__('employee.Is Prefered'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeLanguages as $employeeLanguage)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeLanguage->languages->name }}</td>
                                <td>{{ $employeeLanguage->readings->name }}</td>
                                <td>{{ $employeeLanguage->writings->name }}</td>
                                <td>{{ $employeeLanguage->listenings->name }}</td>
                                <td>{{ $employeeLanguage->speakings->name }}</td>
                                <td>{{ $employeeLanguage->is_prefered ? 'Yes' : 'No' }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_languages.employee_language.destroy', ['employee' => $employeeLanguage->employees->id, 'employeeLanguage' => $employeeLanguage->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            @permission('languages_edit')
                                            <a href="{{ route('employee_languages.employee_language.edit', ['employee' => $employeeLanguage->employees->id, 'employeeLanguage' => $employeeLanguage->id]) }}"
                                                class="btn btn-warning" title="Edit Language">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('languages_delete')
                                            <button type="submit" class="btn btn-danger" title="Delete Language"
                                                onclick="return confirm(&quot;Click Ok to delete Language.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                            @endpermission
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeLanguages->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('languages_addNew')
    <a href="{{ route('employee_languages.employee_language.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Language">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
    @if (count($employeeLanguages) > 0)
    @permission('languages_print')
        <a href="{{ route('employee_languages.employee_language.print', $employee) }}" class="btn btn-primary" title="Print Employee Language" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
        @endpermission
    @endif
@endsection
