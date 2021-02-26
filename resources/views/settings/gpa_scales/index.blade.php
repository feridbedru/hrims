@extends('layouts.app')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('pagetitle')
    GPA Scales
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">GPA Scales</li>
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
                text: "Are you sure you want to delete this GPA Scale?",
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
                        url: "{{ url('settings/gpa_scales/delete') }}/" + id,
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
            <h3 class="card-title">GPA Scales List</h3>
        </div>

        <div class="card-body">
            @if (count($gPAScales) == 0)
                <h4 class="text-center">No GPA Scales Available.</h4>
            @else
                <table class="table table-striped" id="gpa_scale_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gPAScales as $gPAScale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gPAScale->name }}</td>
                                <td>{{ $gPAScale->description }}</td>
                                <td class="text-center">
                                    <a href="{{ route('gpa_scales.gpa_scale.edit', $gPAScale->id) }}"
                                        class="btn btn-warning mr-4" title="Edit GPA Scale">
                                        <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                    </a>
                                    <button class="btn btn-danger remove-data"
                                        onclick="deleteConfirmation({{ $gPAScale->id }})">
                                        <span class="fa fa-trash" aria-hidden="true"></span>
                                    </button>
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
@section('javascripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#gpa_scale_table').DataTable({
                "paging": false,
                "info": false,
                "colReorder": true,
                "dom": '<"wrapper clearfix"Bfrp>',
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $("#gpa_scale_table_filter").addClass("d-inline float-right");
            $("<hr>").insertBefore("#gpa_scale_table");
        });

    </script>
@endsection
