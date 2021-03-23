@extends('layouts.app')
@section('pagetitle')
    {{ $organization->en_name }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('organizations') }}">Organization</a></li>
    <li class="breadcrumb-item active">{{ $organization->en_name }}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 pr-4 my-auto">
                    <img src="{{ asset('uploads/organization/' . $organization->logo) }}"
                        class="img-fluid mb-5 m-auto d-block"><br>
                    <div class="container text-center">
                        <form method="POST" action="{!! route('organizations.organization.destroy', $organization->id) !!}" accept-charset="UTF-8">
                            @method('DELETE')
                            {{ csrf_field() }}
                            <a href="{{ route('organizations.organization.edit', $organization->id) }}"
                                class="btn btn-warning text-white mr-5" title="Edit Organization">
                                <span class="fa fa-edit" aria-hidden="true"> Edit</span>
                            </a>
                            <button type="submit" class="btn btn-danger" title="Delete Organization"
                                onclick="return confirm(&quot;Click Ok to delete Organization.?&quot;)">
                                <span class="fa fa-trash" aria-hidden="true"> Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-8 border-left pl-4">
                    <dl class="dl-horizontal">
                        <div class="row">
                            <div class="col-md-5">
                                <dt>English Name</dt>
                                <dd>{{ $organization->en_name }}</dd>
                            </div>
                            <div class="col-md-5">
                                <dt>Amharic Name</dt>
                                <dd>{{ $organization->am_name }}</dd>
                            </div>
                            @if (isset($organization->abbreviation))
                            <div class="col-md-2">
                                <dt>Abbreviation</dt>
                                <dd>{{ $organization->abbreviation }}</dd>
                            </div> 
                            @endif
                        </div>
                        <dt>Motto</dt>
                        <dd>{{ $organization->motto }}</dd>
                        <dt>Mission</dt>
                        <dd>{{ $organization->mission }}</dd>
                        <dt>Vision</dt>
                        <dd>{{ $organization->vision }}</dd>
                        <div class="row mt-4">
                            @if (isset($organization->address))
                                <div class="col-md-4">
                                    <i class="fa fa-map-marker-alt mr-3"></i>{{ $organization->address }}
                                </div>
                            @endif
                            @if (isset($organization->website))
                                <div class="col-md-4">
                                    <i class="fa fa-globe mr-3"></i><a href="http://{{ $organization->website }}"
                                        target="_blank">{{ $organization->website }}</a>
                                </div>
                            @endif
                            @if (isset($organization->email))
                                <div class="col-md-4">
                                    <i class="fa fa-envelope-square mr-3"></i>{{ $organization->email }}
                                </div>
                            @endif
                        </div>
                        <div class="row mt-4">
                            @if (isset($organization->phone_number))
                                <div class="col-md-4">
                                    <i class="fa fa-phone-alt mr-3"></i>{{ $organization->phone_number }}
                                </div>
                            @endif
                            @if (isset($organization->fax_number))
                                <div class="col-md-4">
                                    <i class="fa fa-fax mr-3"></i>{{ $organization->fax_number }}
                                </div>
                            @endif
                            @if (isset($organization->po_box))
                                <div class="col-md-4">
                                    <i class="fa fa-mail-bulk mr-3"></i>{{ $organization->po_box }}
                                </div>
                            @endif
                        </div>
                        @if (isset($organization->header))
                            <dt>Header</dt>
                            <dd><img src="{{ asset('uploads/organization/' . $organization->header) }}"></dd>
                        @endif
                        @if (isset($organization->footer))
                            <dt>Footer</dt>
                            <dd><img src="{{ asset('uploads/organization/' . $organization->footer) }}"></dd>
                        @endif
                    </dl>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection