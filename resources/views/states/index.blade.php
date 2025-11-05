@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">State List</h5>
                @can('state_create')
                    <button class="btn btn-success btn-sm" id="addstate_btn">
                        <i class="fa fa-plus"></i> Add State
                    </button>
                @endcan
            </div>

            <div class="card-body">
                <table id="stateTable" class="table text-center table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>State Name</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="stateBody">

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addstateModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add State</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="state_id" id="state_id" value="">
                    <label for="state_name" class="form-label">State Name&nbsp;<span class="text-danger">*</span></label>
                    <input type="text" id="state_name" class="form-control" placeholder="Enter state name">
                    <span class="text-danger" id="statename_error"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closestateBtn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="savestateBtn" class="btn btn-primary">Save</button>
                    <div class="model_loader" style="display: none"></div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            let table = $('#stateTable').DataTable({
                "ordering": false,
            });
            ajax();

            function ajax() {
                $("#stateBody").html(`
                    <tr id="loadingRow">
                        <td colspan="4" class="py-4 text-center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                `);

                $.ajax({
                    url: "{{ route('get.state') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.clear();

                        if (response.data.length == 0) {
                            $("#stateBody").html(`
                                <tr>
                                    <td colspan="4" class="py-3 text-center text-muted">
                                        No data found
                                    </td>
                                </tr>
                            `);
                            return;
                        }
                        let total = response.data.length;
                        $.each(response.data, function(index, state) {
                            table.row.add([
                                total - index,
                                state.name,
                                state.created_by,
                                state.action
                            ]).draw(false);
                        });
                    }
                });
            }

            $("#addstate_btn").click(function() {
                $("#state_name").val("");
                $("#state_id").val("")
                $("#statename_error").text("");
                $("#savestateBtn").text("Save");
                $("#addstateModal").modal("show");
                $(".model_loader").hide();
                $("#closestateBtn").show();
                $("#savestateBtn").show();
            });

            $("#savestateBtn").click(function() {

                let state_name = $("#state_name").val()
                let id = $("#state_id").val();

                if (state_name == '') {
                    $("#statename_error").text("This filed is required");
                    $("#state_name").focus()
                    return false;
                } else {
                    $("#statename_error").text("");
                }

                $(".model_loader").show();
                $("#closestateBtn").hide();
                $("#savestateBtn").hide();


                $.ajax({
                    url: "{{ route('create.state') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id,
                        'state_name': state_name
                    },
                    success: function(response) {
                        $("#state_name").val("");
                        $("#addstateModal").modal("hide");
                        Swal.fire({
                            title: "Success!",
                            text: response.message || "state saved successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        $(".model_loader").hide();
                        $("#closestateBtn").show();
                        $("#savestateBtn").show();
                        ajax()
                    },
                    error: function(xhr, status, error) {
                        $(".model_loader").hide();
                        $("#closestateBtn").show();
                        $("#savestateBtn").show();
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to add state",
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
                    url: "{{ route('view.state') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#savestateBtn").hide()
                        $("#fullPageLoader").hide();
                        $("#addstateModal").modal("show");
                        $("#state_name").val(response.data.name);
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have state to view this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to view state.",
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
                    url: "{{ route('edit.state') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#fullPageLoader").hide();
                        $("#addstateModal").modal("show");
                        $("#state_name").val(response.data.state);
                        $("#state_id").val(response.data.id);
                        $("#savestateBtn").show()
                        $("#savestateBtn").text("Update");
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have state to edit this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to edit state.",
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
                    text: "Do you really want to delete this state?",
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
                            url: "{{ route('delete.state') }}",
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
                                    text: "State deleted successfully.",
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
                                        text: "You don't have state to delete this.",
                                        icon: "warning",
                                        confirmButtonText: "OK"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Unable to delete state.",
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
