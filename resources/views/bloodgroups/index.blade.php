@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Bloodgroup List</h5>
                @can('bloodgroup_create')
                    <button class="btn btn-success btn-sm" id="addbloodgroup_btn">
                        <i class="fa fa-plus"></i> Add Bloodgroup
                    </button>
                @endcan
            </div>

            <div class="card-body">
                <table id="bloodgroupTable" class="table text-center table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Bloodgroup Name</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="bloodgroupBody">

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addbloodgroupModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Bloodgroup</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="bloodgroup_id" id="bloodgroup_id" value="">
                    <label for="bloodgroup_name" class="form-label">Bloodgroup Name&nbsp;<span
                            class="text-danger">*</span></label>
                    <input type="text" id="bloodgroup_name" class="form-control" placeholder="Enter bloodgroup name">
                    <span class="text-danger" id="bloodgroupname_error"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closebloodgroupBtn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="savebloodgroupBtn" class="btn btn-primary">Save</button>
                    <div class="model_loader" style="display: none"></div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            let table = $('#bloodgroupTable').DataTable({
                ordering: true,
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [3]
                }]
            });
            ajax();

            function ajax() {
                $("#bloodgroupBody").html(`
                    <tr id="loadingRow">
                        <td colspan="4" class="py-3 text-center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                `);

                $.ajax({
                    url: "{{ route('get.bloodgroup') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.clear();

                        if (response.data.length == 0) {
                            $("#bloodgroupBody").html(`
                                <tr>
                                    <td colspan="4" class="py-3 text-center text-muted">
                                        No data found
                                    </td>
                                </tr>
                            `);
                            return;
                        }
                        let total = response.data.length;
                        $.each(response.data, function(index, bloodgroup) {
                            table.row.add([
                                total - index,
                                bloodgroup.name,
                                bloodgroup.created_by,
                                bloodgroup.action
                            ]).draw(false);
                        });
                    }
                });
            }

            $("#addbloodgroup_btn").click(function() {
                $("#bloodgroup_name").val("");
                $("#bloodgroup_id").val("")
                $("#bloodgroupname_error").text("");
                $("#savebloodgroupBtn").text("Save");
                $("#addbloodgroupModal").modal("show");
                $(".model_loader").hide();
                $("#closebloodgroupBtn").show();
                $("#savebloodgroupBtn").show();
            });

            $("#savebloodgroupBtn").click(function() {

                let bloodgroup_name = $("#bloodgroup_name").val()
                let id = $("#bloodgroup_id").val();

                if (bloodgroup_name == '') {
                    $("#bloodgroupname_error").text("This filed is required");
                    $("#bloodgroup_name").focus()
                    return false;
                } else {
                    $("#bloodgroupname_error").text("");
                }

                $(".model_loader").show();
                $("#closebloodgroupBtn").hide();
                $("#savebloodgroupBtn").hide();


                $.ajax({
                    url: "{{ route('create.bloodgroup') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id,
                        'bloodgroup_name': bloodgroup_name
                    },
                    success: function(response) {
                        $("#bloodgroup_name").val("");
                        $("#addbloodgroupModal").modal("hide");
                        Swal.fire({
                            title: "Success!",
                            text: response.message || "bloodgroup saved successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        $(".model_loader").hide();
                        $("#closebloodgroupBtn").show();
                        $("#savebloodgroupBtn").show();
                        ajax()
                    },
                    error: function(xhr, status, error) {
                        $(".model_loader").hide();
                        $("#closebloodgroupBtn").show();
                        $("#savebloodgroupBtn").show();
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to add bloodgroup",
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
                    url: "{{ route('view.bloodgroup') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#savebloodgroupBtn").hide()
                        $("#fullPageLoader").hide();
                        $("#addbloodgroupModal").modal("show");
                        $("#bloodgroup_name").val(response.data.name);
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have bloodgroup to view this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to view bloodgroup.",
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
                    url: "{{ route('edit.bloodgroup') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#fullPageLoader").hide();
                        $("#addbloodgroupModal").modal("show");
                        $("#bloodgroup_name").val(response.data.bloodgroup);
                        $("#bloodgroup_id").val(response.data.id);
                        $("#savebloodgroupBtn").show()
                        $("#savebloodgroupBtn").text("Update");
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have bloodgroup to edit this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to edit bloodgroup.",
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
                    text: "Do you really want to delete this bloodgroup?",
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
                            url: "{{ route('delete.bloodgroup') }}",
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
                                    text: "bloodgroup deleted successfully.",
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
                                        text: "You don't have bloodgroup to delete this.",
                                        icon: "warning",
                                        confirmButtonText: "OK"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Unable to delete bloodgroup.",
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
