@extends('layouts.app')
@section('pagetitle')
{{(__('employee.Edit System Exception'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('system_exceptions.system_exception.index') }}">{{(__('employee.System Exception'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit System Exception'))}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('system_exceptions.system_exception.update', $systemException->id) }}" id="edit_system_exception_form" name="edit_system_exception_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('system_exceptions.form', [
                                        'systemException' => $systemException,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('system_exceptions.system_exception.index') }}" class="btn btn-warning mr-5" title="Show All System Exception">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection