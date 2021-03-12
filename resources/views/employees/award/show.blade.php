@extends('layouts.employee')

@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{ isset($title) ? $title : 'Employee Award' }}</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('employee_awards.employee_award.destroy', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('employee_awards.employee_award.edit', ['employee' => $employeeAward->employees->id, 'employeeAward' => $employeeAward->id]) }}"
                            class="btn btn-warning" title="Edit Employee Award">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>

                        <button type="submit" class="btn btn-danger" title="Delete Employee Award"
                            onclick="return confirm(&quot;Click Ok to delete Employee Award.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>Organization</dt>
                <dd>{{ $employeeAward->organization }}</dd>
                <dt>Description</dt>
                <dd>{{ $employeeAward->description }}</dd>
                <dt>Attachment</dt>
                <dd>{{ asset('storage/' . $employeeAward->attachment) }}</dd>
                <dt>Award Type</dt>
                <dd>{{ $employeeAward->types->name }}</dd>
                <dt>Awarded On</dt>
                <dd>{{ $employeeAward->awarded_on }}</dd>
                <dt>Status</dt>
                <dd>{{ $employeeAward->status }}</dd>

            </dl>
        </div>
    </div>

@endsection
