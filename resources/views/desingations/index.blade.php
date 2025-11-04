@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Designation List</h5>
                @can('designation_create')
                    <button class="btn btn-success btn-sm" id="adddesignation_btn">
                        <i class="fa fa-plus"></i> Add Designation
                    </button>
                @endcan
            </div>

            <div class="card-body">
                <table id="designationTable" class="table text-center table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Designation Name</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="designationBody">

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="adddesignationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Designation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="designation_id" id="designation_id" value="">
                    <label for="designation_name" class="form-label">Designation Name&nbsp;<span
                            class="text-danger">*</span></label>
                    <input type="text" id="designation_name" class="form-control" placeholder="Enter designation name">
                    <span class="text-danger" id="designationname_error"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closedesignationBtn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="savedesignationBtn" class="btn btn-primary">Save</button>
                    <div class="model_loader" style="display: none"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#designationTable').DataTable();
            ajax();

            function ajax() {
                $("#designationBody").html(`
                    <tr id="loadingRow">
                        <td colspan="4" class="py-4 text-center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                `);

                $.ajax({
                    url: "{{ route('get.designation') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.clear();

                        if (response.data.length == 0) {
                            $("#designationBody").html(`
                                <tr>
                                    <td colspan="4" class="py-3 text-center text-muted">
                                        No data found
                                    </td>
                                </tr>
                            `);
                            return;
                        }

                        let total = response.data.length;

                        $.each(response.data, function(index, designation) {
                            table.row.add([
                                total - index,
                                designation.name,
                                designation.created_by,
                                designation.action
                            ]).draw(false);
                        });

                    }
                });
            }

            $("#adddesignation_btn").click(function() {
                $("#designation_name").val("");
                $("#designation_id").val("")
                $("#savedesignationBtn").text("Save");
                $("#adddesignationModal").modal("show");
                $(".model_loader").hide();
                $("#closedesignationBtn").show();
                $("#savedesignationBtn").show();
            });

            $("#savedesignationBtn").click(function() {

                let designation_name = $("#designation_name").val()
                let id = $("#designation_id").val();

                if (designation_name == '') {
                    $("#designationname_error").text("This filed is required");
                    $("#designation_name").focus()
                    return false;
                } else {
                    $("#designationname_error").text("");
                }

                $(".model_loader").show();
                $("#closedesignationBtn").hide();
                $("#savedesignationBtn").hide();


                $.ajax({
                    url: "{{ route('create.designation') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id,
                        'designation_name': designation_name
                    },
                    success: function(response) {
                        $("#designation_name").val("");
                        $("#adddesignationModal").modal("hide");
                        Swal.fire({
                            title: "Success!",
                            text: "Designation saved successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        $(".model_loader").hide();
                        $("#closedesignationBtn").show();
                        $("#savedesignationBtn").show();
                        ajax()
                    },
                    error: function(xhr, status, error) {
                        $(".model_loader").hide();
                        $("#closedesignationBtn").show();
                        $("#savedesignationBtn").show();
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to add designation",
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
                    url: "{{ route('view.designation') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#savedesignationBtn").hide()
                        $("#fullPageLoader").hide();
                        $("#adddesignationModal").modal("show");
                        $("#designation_name").val(response.data.name);
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have Designation to view this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to view Designation.",
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
                    url: "{{ route('edit.designation') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#fullPageLoader").hide();
                        $("#adddesignationModal").modal("show");
                        $("#designation_name").val(response.data.designation);
                        $("#designation_id").val(response.data.id);
                        $("#savedesignationBtn").show()
                        $("#savedesignationBtn").text("Update");
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have Designation to edit this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to edit Designation.",
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
                    text: "Do you really want to delete this designation?",
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
                            url: "{{ route('delete.designation') }}",
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
                                    text: "Designation deleted successfully.",
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
                                        text: "You don't have Designation to delete this.",
                                        icon: "warning",
                                        confirmButtonText: "OK"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Unable to delete Designation.",
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
