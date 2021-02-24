@extends('layouts.app')
@section('pagetitle')
    Edit Certification Vendor
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('certification_vendors.certification_vendor.index') }}">Certification
            Vendor</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Certification Vendor</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('certification_vendors.certification_vendor.update', $certificationVendor->id) }}"
                id="edit_certification_vendor_form" name="edit_certification_vendor_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('settings.certification_vendors.form', [
                'certificationVendor' => $certificationVendor,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('certification_vendors.certification_vendor.index') }}"
                            class="btn btn-warning mr-5" title="Show All Certification Vendor">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection