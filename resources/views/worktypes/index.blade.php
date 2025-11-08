@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Worktype List</h5>
                @can('worktype_create')
                    <button class="btn btn-success btn-sm" id="addworktype_btn">
                        <i class="fa fa-plus"></i> Add Worktype
                    </button>
                @endcan
            </div>

            <div class="card-body">
                <table id="worktypeTable" class="table text-center table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Worktype Name</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="worktypeBody">

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addworktypeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Worktype</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="worktype_id" id="worktype_id" value="">
                    <label for="worktype_name" class="form-label">Worktype Name&nbsp;<span
                            class="text-danger">*</span></label>
                    <input type="text" id="worktype_name" class="form-control" placeholder="Enter worktype name">
                    <span class="text-danger" id="worktypename_error"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeworktypeBtn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveworktypeBtn" class="btn btn-primary">Save</button>
                    <div class="model_loader" style="display: none"></div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            let table = $('#worktypeTable').DataTable({
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
                $("#worktypeBody").html(`
                    <tr id="loadingRow">
                        <td colspan="4" class="py-3 text-center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                `);

                $.ajax({
                    url: "{{ route('get.worktype') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.clear();

                        if (response.data.length == 0) {
                            $("#worktypeBody").html(`
                                <tr>
                                    <td colspan="4" class="py-3 text-center text-muted">
                                        No data found
                                    </td>
                                </tr>
                            `);
                            return;
                        }

                        let total = response.data.length;
                        $.each(response.data, function(index, worktype) {
                            table.row.add([
                                total - index,
                                worktype.name,
                                worktype.created_by,
                                worktype.action
                            ]).draw(false);
                        });
                    }
                });
            }

            $("#addworktype_btn").click(function() {
                $("#worktype_name").val("");
                $("#worktype_id").val("")
                $("#worktypename_error").text("");
                $("#saveworktypeBtn").text("Save");
                $("#addworktypeModal").modal("show");
                $(".model_loader").hide();
                $("#closeworktypeBtn").show();
                $("#saveworktypeBtn").show();
            });

            $("#saveworktypeBtn").click(function() {

                let worktype_name = $("#worktype_name").val()
                let id = $("#worktype_id").val();

                if (worktype_name == '') {
                    $("#worktypename_error").text("This filed is required");
                    $("#worktype_name").focus()
                    return false;
                } else {
                    $("#worktypename_error").text("");
                }

                $(".model_loader").show();
                $("#closeworktypeBtn").hide();
                $("#saveworktypeBtn").hide();


                $.ajax({
                    url: "{{ route('create.worktype') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id,
                        'worktype_name': worktype_name
                    },
                    success: function(response) {
                        $("#worktype_name").val("");
                        $("#addworktypeModal").modal("hide");
                        Swal.fire({
                            title: "Success!",
                            text: response.message || "Worktype saved successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        $(".model_loader").hide();
                        $("#closeworktypeBtn").show();
                        $("#saveworktypeBtn").show();
                        ajax()
                    },
                    error: function(xhr, status, error) {
                        $(".model_loader").hide();
                        $("#closeworktypeBtn").show();
                        $("#saveworktypeBtn").show();
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to add worktype",
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
                    url: "{{ route('view.worktype') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        console.log(response)
                        $("#saveworktypeBtn").hide()
                        $("#fullPageLoader").hide();
                        $("#addworktypeModal").modal("show");
                        $("#worktype_name").val(response.data.name);
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have worktype to view this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to view worktype.",
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
                    url: "{{ route('edit.worktype') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#fullPageLoader").hide();
                        $("#addworktypeModal").modal("show");
                        $("#worktype_name").val(response.data.worktype);
                        $("#worktype_id").val(response.data.id);
                        $("#saveworktypeBtn").show()
                        $("#saveworktypeBtn").text("Update");
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have worktype to edit this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to edit worktype.",
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
                    text: "Do you really want to delete this worktype?",
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
                            url: "{{ route('delete.worktype') }}",
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
                                    text: "Worktype deleted successfully.",
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
                                        text: "You don't have worktype to delete this.",
                                        icon: "warning",
                                        confirmButtonText: "OK"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Unable to delete Worktype.",
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
