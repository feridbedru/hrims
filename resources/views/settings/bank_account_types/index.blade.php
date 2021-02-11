@extends('layouts.app')
@section('pagetitle')
    Bank Account Types
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Bank Account Types</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Bank Account Types List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($bankAccountTypes) == 0)
                <h4 class="text-center">No Bank Account Types Available.</h4>
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
                        @foreach ($bankAccountTypes as $bankAccountType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bankAccountType->name }}</td>
                                <td>{{ $bankAccountType->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('bank_account_types.bank_account_type.destroy', $bankAccountType->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('bank_account_types.bank_account_type.edit', $bankAccountType->id) }}"
                                                class="btn btn-warning" title="Edit Bank Account Type">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Bank Account Type"
                                                onclick="return confirm(&quot;Click Ok to delete Bank Account Type.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $bankAccountTypes->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('bank_account_types.bank_account_type.create') }}" class="btn btn-success"
        title="Create New Bank Account Type">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
