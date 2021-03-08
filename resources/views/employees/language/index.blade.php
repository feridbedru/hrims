@extends('layouts.employee')
@section('pagetitle')
    Languages
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Languages</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Languages List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeLanguages) == 0)
                <h4 class="text-center">No Languages Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Language</th>
                            <th>Reading</th>
                            <th>Writing</th>
                            <th>Listening</th>
                            <th>Speaking</th>
                            <th>Is Prefered</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeLanguages as $employeeLanguage)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeLanguage->employees->en_name }}</td>
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
                                            <a href="{{ route('employee_languages.employee_language.edit', ['employee' => $employeeLanguage->employees->id, 'employeeLanguage' => $employeeLanguage->id]) }}"
                                                class="btn btn-warning" title="Edit Language">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Language"
                                                onclick="return confirm(&quot;Click Ok to delete Language.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeLanguages->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_languages.employee_language.create',$employee) }}" class="btn btn-success"
        title="Create New Language">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
