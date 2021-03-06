@extends('layouts.app')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('pagetitle')
    Templates
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Templates</li>
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
                text: "Are you sure you want to delete this template?",
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
                        url: "{{ url('settings/templates/delete') }}/" + id,
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
            <h3 class="card-title">Templates List</h3>
        </div>

        <div class="card-body">
            @if (count($templates) == 0)
                <h4 class="text-center">No Templates Available.</h4>
            @else
                <table class="table table-striped" id="template_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Language</th>
                            <th>Template Type</th>
                            <th>Is Active</th>
                            <th>Code</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $template)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $template->title }}</td>
                                <td>{{ $template->languages->name }}</td>
                                <td>{{ $template->types->name }}</td>
                                <td>{{ $template->is_active ? 'Yes' : 'No' }}</td>
                                <td>{{ $template->code }}</td>
                                <td class="text-center">
                                    <a href="{{ route('templates.template.show', $template->id) }}"
                                        class="btn btn-primary mr-4" title="Show Template">
                                        <span class="fa fa-eye" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('templates.template.edit', $template->id) }}"
                                        class="btn btn-warning mr-4" title="Edit Template">
                                        <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                    </a>
                                    <button class="btn btn-danger remove-data"
                                        onclick="deleteConfirmation({{ $template->id }})">
                                        <span class="fa fa-trash" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $templates->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('templates.template.create') }}" class="btn btn-success" title="Create New Template">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
@section('javascripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#template_table').DataTable({
                paging: false,
                info: false,
                colReorder: true,
                dom: '<"wrapper clearfix"Bfrp>',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
                columnDefs: [{
                    targets: -1,
                    visible: false
                }]
            });
            $("#template_table_filter").addClass("d-inline float-right");
            $("<hr>").insertBefore("#template_table");
        });

    </script>
@endsection
