@extends('layouts.app')
@section('pagetitle')
{{(__('setting.Salary Scales'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('setting.Salary Scales'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('setting.Salary Scales List'))}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @permission('salaryScales_list')
            @if (count($salaryScales) == 0)
                <h4 class="text-center">{{(__('setting.No Salary Scales Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Name'))}}</th>
                            <th>{{(__('setting.JobCategory'))}}</th>
                            <th>{{(__('setting.Stair Height'))}}</th>
                            <th>{{(__('setting.Salary Steps'))}}</th>
                            <th>{{(__('setting.Is Enabled'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
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
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            @permission('salaryScales_show')
                                            <a href="{{ route('salary_scales.salary_scale.show', $salaryScale->id) }}"
                                                class="btn btn-primary" title="Show Salary Scale">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('salaryScales_edit')
                                            <a href="{{ route('salary_scales.salary_scale.edit', $salaryScale->id) }}"
                                                class="btn btn-warning" title="Edit Salary Scale">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('salaryScales_delete')
                                            <button type="submit" class="btn btn-danger" title="Delete Salary Scale"
                                                onclick="return confirm(&quot;Click Ok to delete Salary Scale.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                            @endpermission
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $salaryScales->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('salaryScales_addNew')
    <a href="{{ route('salary_scales.salary_scale.create') }}" class="btn btn-success" title="Create New Salary Scale">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
@endsection
