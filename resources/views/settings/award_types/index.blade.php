@extends('layouts.app')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('pagetitle')
    Award Types
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Award Types</li>
@endsection
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        function deleteConfirmation(id) {
            swal.fire({
                title: "Delete?",
                type: 'question',
                text: "Are you sure you want to delete this award type?",
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
                        url: "{{ url('settings/award_types/delete') }}/" + id,
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
            <h3 class="card-title">Award Types List</h3>
        </div>

        <div class="card-body">
            @if (count($awardTypes) == 0)
                <h4 class="text-center">No Award Types Available.</h4>
            @else
                <table class="table table-striped" id="award_type_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($awardTypes as $awardType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $awardType->name }}</td>
                                <td>{{ $awardType->description }}</td>
                                <td class="text-center">
                                    <a href="{{ route('award_types.award_type.edit', $awardType->id) }}"
                                        class="btn btn-warning mr-4" title="Edit Award Type">
                                        <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                    </a>
                                    <button class="btn btn-danger remove-data"
                                        onclick="deleteConfirmation({{ $awardType->id }})">
                                        <span class="fa fa-trash" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $awardTypes->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('award_types.award_type.create') }}" class="btn btn-success" title="Create New Award Type">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script>
    $(document).ready( function () {
        var table = $('#award_type_table').DataTable({
            "paging":   false,
            "info":     false,
            "colReorder": true,
            "dom": '<"wrapper clearfix"Bfrp>',
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $("#award_type_table_filter").addClass( "d-inline float-right" );
        $( "<hr>" ).insertBefore( "#award_type_table" );
    } );
    </script>
@endsection