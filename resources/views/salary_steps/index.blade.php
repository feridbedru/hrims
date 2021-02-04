@extends('layouts.app')
@section('pagetitle')
    Salary Steps
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Salary Steps</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Salary Steps List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($salarySteps) == 0)
                <h4 class="text-center">No Salary Steps Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Salary Scale</th>
                            <th>Step</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($salarySteps as $salaryStep)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($salaryStep->salaryScale)->name }}</td>
                            <td>{{ $salaryStep->step }}</td>

                            <td>
                                <form method="POST" action="{!! route('salary_steps.salary_step.destroy', $salaryStep->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('salary_steps.salary_step.show', $salaryStep->id ) }}" class="btn btn-primary" title="Show Salary Step">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('salary_steps.salary_step.edit', $salaryStep->id ) }}" class="btn btn-warning" title="Edit Salary Step">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Salary Step" onclick="return confirm(&quot;Click Ok to delete Salary Step.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $salarySteps->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('salary_steps.salary_step.create') }}" class="btn btn-success" title="Create New Salary Step">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection