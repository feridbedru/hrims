@extends('layouts.app')
@section('pagetitle')
    GPA Scales
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">GPA Scales</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">GPA Scales List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($gPAScales) == 0)
                <h4 class="text-center">No GPA Scales Available.</h4>
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
                        @foreach ($gPAScales as $gPAScale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gPAScale->name }}</td>
                                <td>{{ $gPAScale->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('gpa_scales.gpa_scale.destroy', $gPAScale->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('gpa_scales.gpa_scale.edit', $gPAScale->id) }}"
                                                class="btn btn-warning" title="Edit GPA Scale">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete GPA Scale"
                                                onclick="return confirm(&quot;Click Ok to delete G P A Scale.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $gPAScales->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('gpa_scales.gpa_scale.create') }}" class="btn btn-success" title="Create New GPA Scale">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
