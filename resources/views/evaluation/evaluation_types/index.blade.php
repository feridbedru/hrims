@extends('layouts.app')
@section('pagetitle')
    {{ __('employee.Evaluation Types') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('employee.Evaluation Types') }}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('employee.Evaluation Types List') }}</h3>
        </div>

        <div class="card-body">
            {{-- @permission('evaluation_type_list') --}}
            @if (count($evaluationTypes) == 0)
                <h4 class="text-center">{{ __('employee.No Evaluation Types Available.') }}</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('employee.Name') }}</th>
                            <th>{{ __('employee.Description') }}</th>
                            <th>{{ __('setting.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluationTypes as $evaluationType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $evaluationType->name }}</td>
                                <td>{{ $evaluationType->description }}</td>
                                <td>
                                    <form method="POST" action="{!! route('evaluation_types.evaluation_type.destroy', $evaluationType->id) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            {{-- @permission('evaluation_type_show') --}}
                                            <a href="{{ route('evaluation_types.evaluation_type.show', $evaluationType->id) }}"
                                                class="btn btn-primary" title="Show Evaluation Type">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            {{-- @endpermission --}}
                                            {{-- @permission('evaluation_type_edit') --}}
                                            <a href="{{ route('evaluation_types.evaluation_type.edit', $evaluationType->id) }}"
                                                class="btn btn-warning" title="Edit Evaluation Type">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            {{-- @endpermission --}}
                                            {{-- @permission('evaluation_type_delete') --}}
                                            <button type="submit" class="btn btn-danger" title="Delete Evaluation Type"
                                                onclick="return confirm(&quot;Click Ok to delete Evaluation Type.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                            {{-- @endpermission --}}
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                    {!! $evaluationTypes->links() !!}
                </div>
            @endif
            {{-- @endpermission --}}
        </div>
    </div>
    {{-- @permission('evaluation_type_new') --}}
    <a href="{{ route('evaluation_types.evaluation_type.create') }}" class="btn btn-success mr-2"
        title="Create New Evaluation Type">
        <span class="fa fa-plus" aria-hidden="true"> {{ __('setting.AddNew') }}</span>
    </a>
    {{-- @endpermission --}}
@endsection
