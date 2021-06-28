@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.New Evaluation'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('evaluations.evaluation.index') }}">{{(__('employee.Evaluation'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Evaluation'))}}</h3>
        </div>
        <div class="card-body">
            {{-- @permission('evaluation_new') --}}
            <form method="POST" action="{{ route('evaluations.evaluation.store') }}" accept-charset="UTF-8" id="create_evaluation_form"
                name="create_evaluation_form" class="form-horizontal" >
                {{ csrf_field() }}
                @include ('evaluation.evaluations.form', [
                'evaluation' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('evaluations.evaluation.index') }}" class="btn btn-warning mr-5"
                            title="Show All Evaluation">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
            {{-- @endpermission --}}
        </div>
    </div>
@endsection
