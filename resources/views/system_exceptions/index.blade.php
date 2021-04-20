@extends('layouts.app')
@section('pagetitle')
{{(__('employee.System Exception'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.System Exception'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.System Exception List'))}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($systemExceptions) == 0)
                <h4 class="text-center">{{(__('employee.No System Exceptions Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Title'))}}</th>
                            <th>{{(__('setting.Function'))}}</th>
                            <th>{{(__('setting.Message'))}}</th>
                            <th>{{(__('setting.Status'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($systemExceptions as $systemException)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $systemException->title }}</td>
                                <td>{{ $systemException->function }}</td>
                                <td>{{ $systemException->message }}</td>
                                <td>{{ $systemException->status }}</td>

                                <td>
                                    <form method="POST" action="{!! route('system_exceptions.system_exception.destroy', $systemException->id) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('system_exceptions.system_exception.show', $systemException->id) }}"
                                                class="btn btn-primary" title="Show System Exception">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('system_exceptions.system_exception.edit', $systemException->id) }}"
                                                class="btn btn-warning" title="Edit System Exception">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete System Exception"
                                                onclick="return confirm(&quot;Click Ok to delete System Exception.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $systemExceptions->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
