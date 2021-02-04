@extends('layouts.app')
@section('pagetitle')
    New Woreda
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('woredas.woreda.index') }}">Woreda</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Woreda</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
    <form method="POST" action="{{ route('woredas.woreda.store') }}" accept-charset="UTF-8" id="create_woreda_form" name="create_woreda_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('settings.woredas.form', [
                                        'woreda' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Add">
                        <a href="{{ route('woredas.woreda.index') }}" class="btn btn-warning mr-5" title="Show All Woreda">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection