@extends('layouts.admin')
@section('content')
    
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Project List</h5>
                @can('project_create')
                    <a href="#" class="btn btn-success btn-sm" id="addproject_btn">
                        <i class="fa fa-plus"></i> Add Project
                    </a>
                @endcan
            </div>

            <div class="card-body">
                <table id="projectTable" class="table text-center table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Project Name</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="projectBody">

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addprojectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="project_id" id="project_id" value="">
                    <label for="project_name" class="form-label">Project Name&nbsp;<span
                            class="text-danger">*</span></label>
                    <input type="text" id="project_name" class="form-control" placeholder="Enter project name">
                    <span class="text-danger" id="projectname_error"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeprojectBtn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveprojectBtn" class="btn btn-primary">Save</button>
                    <div class="model_loader" style="display: none"></div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            let table = $('#projectTable').DataTable();
            ajax();

            function ajax() {
                $("#projectBody").html(`
                    <tr id="loadingRow">
                        <td colspan="4" class="py-4 text-center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                `);

                $.ajax({
                    url: "{{ route('get.project') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.clear();

                        $.each(response.data, function(index, project) {
                            table.row.add([
                                index + 1,
                                project.name,
                                project.created_by,
                                project.action
                            ]).draw(false);
                        });
                    }
                });
            }

            $("#addproject_btn").click(function() {
                $("#project_name").val("");
                $("#project_id").val("")
                $("#saveprojectBtn").text("Save");
                $("#addprojectModal").modal("show");
                $(".model_loader").hide();
                $("#closeprojectBtn").show();
                $("#saveprojectBtn").show();
            });

            $("#saveprojectBtn").click(function() {

                let project_name = $("#project_name").val()
                let id = $("#project_id").val();

                if (project_name == '') {
                    $("#projectname_error").text("This filed is required");
                    $("#project_name").focus()
                    return false;
                } else {
                    $("#projectname_error").text("");
                }

                $(".model_loader").show();
                $("#closeprojectBtn").hide();
                $("#saveprojectBtn").hide();


                $.ajax({
                    url: "{{ route('create.project') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id,
                        'project_name': project_name
                    },
                    success: function(response) {
                        $("#project_name").val("");
                        $("#addprojectModal").modal("hide");
                        Swal.fire({
                            title: "Success!",
                            text: "project saved successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        $(".model_loader").hide();
                        $("#closeprojectBtn").show();
                        $("#saveprojectBtn").show();
                        ajax()
                    },
                    error: function(xhr, status, error) {
                        $(".model_loader").hide();
                        $("#closeprojectBtn").show();
                        $("#saveprojectBtn").show();
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to add project",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                })
            })

            $(document).on("click", ".viewBtn", function() {
                let id = $(this).data("id");
                $("#fullPageLoader").show();

                $.ajax({
                    url: "{{ route('view.project') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#saveprojectBtn").hide()
                        $("#fullPageLoader").hide();
                        $("#addprojectModal").modal("show");
                        $("#project_name").val(response.data.name);
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have project to view this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to view project.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    }
                })
            });

            $(document).on("click", ".editBtn", function() {
                let id = $(this).data("id");
                $("#fullPageLoader").show();
                $.ajax({
                    url: "{{ route('edit.project') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#fullPageLoader").hide();
                        $("#addprojectModal").modal("show");
                        $("#project_name").val(response.data.name);
                        $("#project_id").val(response.data.id);
                        $("#saveprojectBtn").show()
                        $("#saveprojectBtn").text("Update");
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have project to edit this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to edit project.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    }

                })
            });

            $(document).on("click", ".deleteBtn", function() {
                let id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you really want to delete this project?",
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
                            url: "{{ route('delete.project') }}",
                            type: "delete",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            },
                            data: {
                                id: id
                            },
                            success: function(response) {
                                $("#fullPageLoader").hide();
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Project deleted successfully.",
                                    icon: "success",
                                    confirmButtonText: "OK"
                                });
                                ajax();
                            },
                            error: function(xhr, status, error) {
                                $("#fullPageLoader").hide();
                                if (xhr.status == 403) {
                                    Swal.fire({
                                        title: "Access Denied!",
                                        text: "You don't have project to delete this.",
                                        icon: "warning",
                                        confirmButtonText: "OK"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Unable to delete project.",
                                        icon: "error",
                                        confirmButtonText: "OK"
                                    });
                                }
                            }
                        });
                    }
                });
            });

        })
    </script>
@endsection
