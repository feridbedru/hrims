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
                        <th rowspan="2" class="text-center">Level</th>
                        <th colspan="{{ $salaryHeight->salaryScales['salary_steps'] }}" class="text-center">Steps
                            ({{ $myscale = $salaryHeight->salaryScales['salary_steps'] }})</th>
                    </tr>
                    <tr>
                        @for ($i = 1; $i <= $myscale; $i++)
                            <th scope="col" class="text-center">{{ $i }} </th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $salaryHeight->level }}</td>
                        @if (count($salaries) > 0)
                            @foreach ($salaries as $salary)
                                <td class="text-center"> {{ $salary['amount'] }} </td>
                            @endforeach
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-4">
                <button type="button" class="btn btn-warning mr-5" data-toggle="modal" data-target="#edit_salary_modal">
                    <span class="fa fa-edit text-white"> Edit</span>
                </button>
                <form class="d-inline" method="POST" action="{!! route('salary_heights.salary_height.deletesalary', $salaryHeight->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger" title="Delete Total Salaries"
                            onclick="return confirm(&quot;Click Ok to delete total Salary within this height.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"> Delete</span>
                        </button>
                </form>
                <div class="modal fade" id="edit_salary_modal">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Salary</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">Level</th>
                                            <th colspan="{{ $salaryHeight->salaryScales['salary_steps'] }}"
                                                class="text-center">Steps
                                                ({{ $myscale = $salaryHeight->salaryScales['salary_steps'] }})</th>
                                        </tr>
                                        <tr>
                                            @for ($i = 1; $i <= $myscale; $i++)
                                                <th scope="col" class="text-center">{{ $i }} </th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">{{ $salaryHeight->level }}</td>
                                            <form method="POST"
                                                action="{{ route('salary_heights.salary_height.updatesalary') }}"
                                                accept-charset="UTF-8" id="update_salary_form" name="update_salary_form"
                                                class="form-horizontal">
                                                {{ csrf_field() }}
                                                <input type="text" class="form-control" name="height"
                                                    value="{{ $salaryHeight->id }}" hidden>
                                                <input type="text" class="form-control" name="stepcount"
                                                    value="{{ $myscale }}" hidden>
                                                @foreach ($salaries as $salary)
                                                    <td><input type="text" class="form-control" name="salary[]"
                                                            value="{{ $salary->amount }}">
                                                    </td>
                                                @endforeach
                                        </tr>
                                        <tr>
                                            <td></td>
                                            @foreach ($salary_steps as $step)
                                                <td><input type="text" class="form-control" name="step[]"
                                                        value="{{ $step['id'] }}" hidden>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-12 text-center">
                                        <input class="btn btn-primary" type="submit" value="Update">
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <form method="POST" action="{{ route('salary_heights.salary_height.addsalary') }}" accept-charset="UTF-8"
                id="create_salary_form" name="create_salary_form" class="form-horizontal">
                {{ csrf_field() }}
                <input type="text" class="form-control" name="height" value="{{ $salaryHeight->id }}" hidden>
                <input type="text" class="form-control" name="stepcount" value="{{ $myscale }}" hidden>
                @for ($i = 1; $i <= $myscale; $i++)
                    <td><input type="text" class="form-control" name="salary[{{ $i }}]" required="true">
                    </td>
                @endfor

                </tr>
                <tr>
                    <td></td>
                    @foreach ($salary_steps as $step)
                        <td><input type="text" class="form-control" name="step[]" value="{{ $step['id'] }}" hidden>
                        </td>
                    @endforeach
                </tr>
                </tbody>
                </table>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Save">
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>

@endsection
