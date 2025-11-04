@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Permission List</h5>
                @can('permission_create')
                    <button class="btn btn-success btn-sm" id="addPermissionBtn">
                        <i class="fa fa-plus"></i> Add Permission
                    </button>
                @endcan
            </div>
            <div class="card-body">
                <table id="permissionsTable" class="table text-center table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Permission Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="permissionBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPermissionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="permissionId" id="permissionId" value="">
                    <label for="permissionName" class="form-label">Permission Name&nbsp;<span
                            class="text-danger">*</span></label>
                    <input type="text" id="permissionName" class="form-control" placeholder="Enter permission name">
                    <span class="text-danger" id="permissionName_error"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" id="closePermissionBtn" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="savePermissionBtn" class="btn btn-primary">Save</button>
                    <div class="model_loader" style="display: none"></div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            let table = $('#permissionsTable').DataTable();
            ajax();

            function ajax() {
                $("#permissionBody").html(`
                    <tr id="loadingRow">
                        <td colspan="3" class="py-3 text-center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                `);
                $.ajax({
                    url: "{{ route('get.permission') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.clear();

                        if (response.data.length == 0) {
                            $("#designationBody").html(`
                                <tr>
                                    <td colspan="3" class="py-3 text-center text-muted">
                                        No data found
                                    </td>
                                </tr>
                            `);
                            return;
                        }

                        $.each(response.data, function(index, permission) {
                            table.row.add([
                                index + 1,
                                permission.name,
                                permission.action
                            ]).draw(false);
                        });
                    }
                });
            }

            $("#addPermissionBtn").click(function() {
                $("#permissionName").val("");
                $("#permissionId").val("")
                $("#permissionName_error").text("");
                $("#savePermissionBtn").text("Save");
                $("#addPermissionModal").modal("show");
                $(".model_loader").hide();
                $("#savePermissionBtn").show();
                $("#closePermissionBtn").show();
            });

            $("#savePermissionBtn").click(function() {

                let permissionName = $("#permissionName").val()
                let id = $("#permissionId").val();

                if (permissionName == '') {
                    $("#permissionName_error").text("This filed is required");
                    $("#permissionName").focus()
                    return false;
                } else {
                    $("#permissionName_error").text("");
                }

                $(".model_loader").show();
                $("#savePermissionBtn").hide();
                $("#closePermissionBtn").hide();

                $.ajax({
                    url: "{{ route('create.permission') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id,
                        'permissionName': permissionName
                    },
                    success: function(response) {
                        $("#permissionName").val("");
                        $("#addPermissionModal").modal("hide");
                        $(".model_loader").hide();
                        $("#savePermissionBtn").show();
                        $("#closePermissionBtn").show();
                        Swal.fire({
                            title: "Success!",
                            text: response.message || "Permission saved successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        ajax()
                    },
                    error: function(xhr, status, error) {
                        $(".model_loader").hide();
                        $("#savePermissionBtn").show();
                        $("#closePermissionBtn").show();
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to add permission",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                })
            })

            $(document).on("click", ".viewBtn", function() {

                let id = $(this).data("id");
                $("#fullPageLoader").show()

                $.ajax({
                    url: "{{ route('view.permission') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#savePermissionBtn").hide()
                        $("#fullPageLoader").hide()
                        $("#addPermissionModal").modal("show");
                        $("#permissionName").val(response.data.name);
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide()
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have permission to view this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to view permission.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    }
                })
            })

            $(document).on("click", ".editBtn", function() {

                let id = $(this).data("id");
                $("#fullPageLoader").show()

                $.ajax({
                    url: "{{ route('edit.permission') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#fullPageLoader").hide()
                        $("#addPermissionModal").modal("show");
                        $("#permissionName").val(response.data.name);
                        $("#permissionId").val(response.data.id);
                        $("#savePermissionBtn").show()
                        $("#savePermissionBtn").text("Update");
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide()
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have permission to edit this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to edit permission.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    }

                })
            })

            $(document).on("click", ".deleteBtn", function() {

                let id = $(this).data("id");

                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you really want to delete this permission?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#fullPageLoader").show()
                        $.ajax({
                            url: "{{ route('delete.permission') }}",
                            type: "delete",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            },
                            data: {
                                id: id
                            },
                            success: function(response) {
                                $("#fullPageLoader").hide()
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Permission deleted successfully.",
                                    icon: "success",
                                    confirmButtonText: "OK"
                                });
                                ajax();
                            },
                            error: function(xhr, status, error) {
                                $("#fullPageLoader").hide()
                                if (xhr.status == 403) {
                                    Swal.fire({
                                        title: "Access Denied!",
                                        text: "You don't have permission to delete this.",
                                        icon: "warning",
                                        confirmButtonText: "OK"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Unable to delete permission.",
                                        icon: "error",
                                        confirmButtonText: "OK"
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
