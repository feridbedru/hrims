@extends('layouts.app')
@section('pagetitle')
    Salaries
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Salaries</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Salaries List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($salaries) == 0)
                <h4 class="text-center">No Salaries Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Salary Height</th>
                            <th>Salary Step</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($salaries as $salary)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>{{ $salary->salaryHeights->level }}</td>
                            <td>{{ $salary->salarySteps->step }}</td>
                            <td>{{ $salary->amount }}</td>

                            <td>
                                <form method="POST" action="{!! route('salaries.salary.destroy', $salary->id) !!}" accept-charset="UTF-8">
                                @method('DELETE')
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('salaries.salary.show', $salary->id ) }}" class="btn btn-primary" title="Show Salary">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('salaries.salary.edit', $salary->id ) }}" class="btn btn-warning" title="Edit Salary">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Salary" onclick="return confirm(&quot;Click Ok to delete Salary.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $salaries->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('salaries.salary.create') }}" class="btn btn-success" title="Create New Salary">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection