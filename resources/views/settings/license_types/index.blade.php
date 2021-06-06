@extends('layouts.app')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('pagetitle')
{{(__('setting.LicenseType'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">{{(__('setting.Setting'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.LicenseType'))}}</li>
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
                text: "Are you sure you want to delete this license type?",
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
                        url: "{{ url('settings/license_types/delete') }}/" + id,
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
            <h3 class="card-title">{{(__('setting.LicenseTypesList'))}}</h3>
        </div>
        @permission('licenseTypes_list')
        <div class="card-body">
            @if (count($licenseTypes) == 0)
                <h4 class="text-center">{{(__('setting.NoLicenseTypesAvailable'))}}.</h4>
            @else
                <table class="table table-striped" id="license_type_table">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Name'))}}</th>
                            <th>{{(__('setting.Description'))}}</th>
                            <th class="text-center">{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($licenseTypes as $licenseType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $licenseType->name }}</td>
                                <td>{{ $licenseType->description }}</td>
                                <td class="text-center">
                                    @permission('setting_LicenseType_Edit')
                                    <a href="{{ route('license_types.license_type.edit', $licenseType->id) }}"
                                        class="btn btn-warning mr-4" title="Edit License Type">
                                        <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                    </a>
                                    @endpermission
                                    @permission('setting_LicenseType_Delete')
                                    <button class="btn btn-danger remove-data"
                                        onclick="deleteConfirmation({{ $licenseType->id }})">
                                        <span class="fa fa-trash" aria-hidden="true"></span>
                                    </button>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $licenseTypes->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('setting_LicenseType_AddNew')
    <a href="{{ route('license_types.license_type.create') }}" class="btn btn-success" title="Create New License Type">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
@endsection
@section('javascripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#license_type_table').DataTable({
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
            $("#license_type_table_filter").addClass("d-inline float-right");
            $("<hr>").insertBefore("#license_type_table");
        });

    </script>
@endsection
