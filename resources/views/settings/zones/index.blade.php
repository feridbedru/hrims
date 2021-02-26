@extends('layouts.app')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('pagetitle')
    Zones
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Zones</li>
@endsection
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        function deleteConfirmation(id) {
            swal.fire({
                title: "Delete?",
                type: 'question',
                text: "Are you sure you want to delete this zone?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: '<span class="fa fa-trash"></span> Yes, delete it!',
                cancelButtonText: "No, cancel!",
                confirmButtonColor: '#d33',
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('settings/zones/delete') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
            })
        }

    </script>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Zones List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($zones) == 0)
                <h4 class="text-center">No Zones Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Region</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($zones as $zone)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $zone->name }}</td>
                                <td>{{ optional($zone->regionS)->name }}</td>
                                <td>
                                    <a href="{{ route('zones.zone.show', $zone->id) }}" class="btn btn-primary "
                                        title="Show Zone">
                                        <span class="fa fa-eye" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('zones.zone.edit', $zone->id) }}" class="btn btn-warning"
                                        title="Edit Zone">
                                        <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                    </a>
                                    <button class="btn btn-danger remove-data"
                                        onclick="deleteConfirmation({{ $zone->id }})">
                                        <span class="fa fa-trash" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $zones->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('zones.zone.create') }}" class="btn btn-success" title="Create New Zone">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
