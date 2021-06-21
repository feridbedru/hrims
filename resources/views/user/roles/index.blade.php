@extends('layouts.app')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('pagetitle')
    {{ __('setting.Roles') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('setting.Roles') }}</li>
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
                text: "Are you sure you want to delete this bank?",
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
                        url: "{{ url('roles/delete') }}/" + id,
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
            <h4 class="mt-0 mb-2">Manage Roles</h4>
        </div>

        <div class="card-body">
            @permission('roles_list')
            @if (count($rolesObjects) == 0)
                <h4>No Roles Available.</h4>
            @else
                <table class="table table-striped" id="role_table">
                    <thead>
                        <tr>
                            <th>{{ __('setting.Number') }}</th>
                            <th>{{ __('setting.Name') }}</th>
                            <th>{{ __('setting.Display Name') }}</th>
                            <th>{{ __('setting.Permission Count') }}</th>
                            <th>{{ __('setting.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rolesObjects as $roles)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $roles->name }}</td>
                                <td>{{ $roles->display_name }}</td>
                                <td>
                                    
                                </td>
                                <td>
                                    <form method="POST" action="{!! route('roles.role.destroy', $roles->id) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            @permission('roles_show')
                                            <a href="{{ route('roles.role.show', $roles->id) }}"
                                                class="btn btn-primary ml-2" title="Show roles">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('roles_edit')
                                            <a href="{{ route('roles.role.edit', $roles->id) }}" title="Edit Roles" class="btn btn-warning">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('roles_delete')
                                            <button type="submit" class="btn btn-danger ml-2" title="Delete Role"
                                                onclick="return confirm(&quot;Click Ok to delete roles.&quot;)">
                                                <span class="fa fa-trash text-white" aria-hidden="true"></span>
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
            {!! $rolesObjects->render() !!}
        </div>
        @endif
        @endpermission
    </div>
    @permission('roles_addNew')
        <a href="{{ route('roles.role.create') }}" class="btn btn-success" title="Create New Roles">
            <span class="fa fa-plus" aria-hidden="true"> {{ __('setting.AddNew') }}</span>
        </a>
        @endpermission
    @endsection

@section('javascripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#role_table').DataTable({
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
                    targets: 3,
                    orderable: false
                }]
            });
            $("#role_table_filter").addClass("d-inline float-right");
            $("<hr>").insertBefore("#role_table");
        });

    </script>
@endsection
