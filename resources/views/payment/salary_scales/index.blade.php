@extends('layouts.app')
@section('pagetitle')
    Salary Scales
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Salary Scales</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Salary Scales List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($salaryScales) == 0)
                <h4 class="text-center">No Salary Scales Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Job Category</th>
                            <th>Stair Height</th>
                            <th>Salary Steps</th>
                            <th>Is Enabled</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaryScales as $salaryScale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $salaryScale->name }}</td>
                                <td>{{ $salaryScale->jobCategories->name }}</td>
                                <td>{{ $salaryScale->stair_height }}</td>
                                <td>{{ $salaryScale->salary_steps }}</td>
                                <td>{{ $salaryScale->is_enabled ? 'Yes' : 'No' }}</td>

                                <td>
                                    <form method="POST" action="{!! route('salary_scales.salary_scale.destroy', $salaryScale->id) !!}" accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('salary_scales.salary_scale.show', $salaryScale->id) }}"
                                                class="btn btn-primary" title="Show Salary Scale">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('salary_scales.salary_scale.edit', $salaryScale->id) }}"
                                                class="btn btn-warning" title="Edit Salary Scale">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Salary Scale"
                                                onclick="return confirm(&quot;Click Ok to delete Salary Scale.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $salaryScales->render() !!}
            @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('salary_scales.salary_scale.create') }}" class="btn btn-success"
            title="Create New Salary Scale">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection
