@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Country List</h5>
                @can('country_create')
                    <button class="btn btn-success btn-sm" id="addcountry_btn">
                        <i class="fa fa-plus"></i> Add Country
                    </button>
                @endcan
            </div>

            <div class="card-body">
                <table id="countryTable" class="table text-center table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Country Name</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="countryBody">

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addcountryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="country_id" id="country_id" value="">
                    <label for="country_name" class="form-label">Country Name&nbsp;<span
                            class="text-danger">*</span></label>
                    <input type="text" id="country_name" class="form-control" placeholder="Enter country name">
                    <span class="text-danger" id="countryname_error"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closecountryBtn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="savecountryBtn" class="btn btn-primary">Save</button>
                    <div class="model_loader" style="display: none"></div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            let table = $('#countryTable').DataTable({
                "ordering": false,
            });
            ajax();

            function ajax() {
                $("#countryBody").html(`
                    <tr id="loadingRow">
                        <td colspan="4" class="py-4 text-center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                `);

                $.ajax({
                    url: "{{ route('get.country') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.clear();

                        if (response.data.length == 0) {
                            $("#countryBody").html(`
                                <tr>
                                    <td colspan="4" class="py-3 text-center text-muted">
                                        No data found
                                    </td>
                                </tr>
                            `);
                            return;
                        }
                        let total = response.data.length;
                        $.each(response.data, function(index, country) {
                            table.row.add([
                                total - index,
                                country.name,
                                country.created_by,
                                country.action
                            ]).draw(false);
                        });
                    }
                });
            }

            $("#addcountry_btn").click(function() {
                $("#country_name").val("");
                $("#country_id").val("")
                $("#countryname_error").text("");
                $("#savecountryBtn").text("Save");
                $("#addcountryModal").modal("show");
                $(".model_loader").hide();
                $("#closecountryBtn").show();
                $("#savecountryBtn").show();
            });

            $("#savecountryBtn").click(function() {

                let country_name = $("#country_name").val()
                let id = $("#country_id").val();

                if (country_name == '') {
                    $("#countryname_error").text("This filed is required");
                    $("#country_name").focus()
                    return false;
                } else {
                    $("#countryname_error").text("");
                }

                $(".model_loader").show();
                $("#closecountryBtn").hide();
                $("#savecountryBtn").hide();


                $.ajax({
                    url: "{{ route('create.country') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id,
                        'country_name': country_name
                    },
                    success: function(response) {
                        $("#country_name").val("");
                        $("#addcountryModal").modal("hide");
                        Swal.fire({
                            title: "Success!",
                            text: response.message || "Country saved successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        $(".model_loader").hide();
                        $("#closecountryBtn").show();
                        $("#savecountryBtn").show();
                        ajax()
                    },
                    error: function(xhr, status, error) {
                        $(".model_loader").hide();
                        $("#closecountryBtn").show();
                        $("#savecountryBtn").show();
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to add country",
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
                    url: "{{ route('view.country') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#savecountryBtn").hide()
                        $("#fullPageLoader").hide();
                        $("#addcountryModal").modal("show");
                        $("#country_name").val(response.data.name);
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have Country to view this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to view Country.",
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
                    url: "{{ route('edit.country') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#fullPageLoader").hide();
                        $("#addcountryModal").modal("show");
                        $("#country_name").val(response.data.country);
                        $("#country_id").val(response.data.id);
                        $("#savecountryBtn").show()
                        $("#savecountryBtn").text("Update");
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have Country to edit this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to edit Country.",
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
                    text: "Do you really want to delete this country?",
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
                            url: "{{ route('delete.country') }}",
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
                                    text: "country deleted successfully.",
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
                                        text: "You don't have country to delete this.",
                                        icon: "warning",
                                        confirmButtonText: "OK"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Unable to delete country.",
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

