@extends('layouts.app')
@section('pagetitle')
    Certification Vendors
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Certification Vendors</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Certification Vendors List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($certificationVendors) == 0)
                <h4 class="text-center">No Certification Vendors Available.</h4>
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
                        @foreach ($certificationVendors as $certificationVendor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $certificationVendor->name }}</td>
                                <td>{{ $certificationVendor->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('certification_vendors.certification_vendor.destroy', $certificationVendor->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('certification_vendors.certification_vendor.edit', $certificationVendor->id) }}"
                                                class="btn btn-warning" title="Edit Certification Vendor">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Certification Vendor"
                                                onclick="return confirm(&quot;Click Ok to delete Certification Vendor.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $certificationVendors->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('certification_vendors.certification_vendor.create') }}" class="btn btn-success"
        title="Create New Certification Vendor">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
