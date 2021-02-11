@extends('layouts.app')
@section('pagetitle')
    Banks
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Banks</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Banks List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($banks) == 0)
                <h4 class="text-center">No Banks Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banks as $bank)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->description }}</td>

                                <td>
                                    <form method="POST" action="{!!  route('banks.bank.destroy', $bank->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('banks.bank.edit', $bank->id) }}" class="btn btn-warning"
                                                title="Edit Bank">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Bank"
                                                onclick="return confirm(&quot;Click Ok to delete Bank.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $banks->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('banks.bank.create') }}" class="btn btn-success" title="Create New Bank">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
