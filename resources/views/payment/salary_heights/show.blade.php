@extends('layouts.app')
@section('pagetitle')
    Show Salary Height
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('salary_heights.salary_height.index') }}">Salary Height</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">

            <h3 class="card-title">{{ $salaryHeight->salaryScales->name }} Scale, Level {{ $salaryHeight->level }}</h3>
            <div class="card-tools">

                <form method="POST" action="{!! route('salary_heights.salary_height.destroy', $salaryHeight->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('salary_heights.salary_height.edit', $salaryHeight->id) }}"
                            class="btn btn-warning" title="Edit Salary Height">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>

                        <button type="submit" class="btn btn-danger" title="Delete Salary Height"
                            onclick="return confirm(&quot;Click Ok to delete Salary Height.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>

            </div>

        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>Initial Salary</dt>
                <dd>{{ $salaryHeight->initial_salary }}</dd>
                <dt>Maximum Salary</dt>
                <dd>{{ $salaryHeight->maximum_salary }}</dd>

            </dl>
            <table class="table">
                <thead>
                    <tr>
                        <th rowspan="2">Level</th>
                        <th colspan="1"  class="text-center">Steps</th> 
                    </tr>
                    <tr>
                        <th>ma</th>
                        {{-- @for ($i = 1; $i = {{ $salaryHeight->salaryScales->salary_steps }} ; $i++)
                            <th scope="col">{{ $i }} </th>
                        @endfor --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

@endsection
