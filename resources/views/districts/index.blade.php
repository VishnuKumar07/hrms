@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">District List</h5>
                @can('district_create')
                    <button class="btn btn-success btn-sm" id="adddistrict_btn">
                        <i class="fa fa-plus"></i> Add District
                    </button>
                @endcan
            </div>

            <div class="card-body">
                <table id="districtTable" class="table text-center table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>District Name</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="districtBody">

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="adddistrictModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add District</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="district_id" id="district_id" value="">
                    <div class="mb-3">
                        <label for="country_id" class="form-label">
                            Country <span class="text-danger">*</span>
                        </label>
                        <select id="country_id" class="form-select select2">
                            <option value="">Select Country</option>
                            @foreach ($countries->where('country', 'India') as $country)
                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                            @endforeach
                            @foreach ($countries->where('country', '!=', 'India') as $country)
                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                            @endforeach
                        </select>

                        <span class="text-danger" id="country_error"></span>
                    </div>
                    <div class="mb-3 state_div" style="display: none">
                        <label for="state_id" class="form-label">
                            State <span class="text-danger">*</span>
                        </label>
                        <select id="state_id" class="form-select select2">
                            <option value="">Select State</option>
                        </select>
                        <span class="text-danger" id="state_error"></span>
                    </div>

                    <label for="district_name" class="form-label">District Name&nbsp;<span
                            class="text-danger">*</span></label>
                    <input type="text" id="district_name" class="form-control" placeholder="Enter district name">
                    <span class="text-danger" id="districtname_error"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closedistrictBtn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="savedistrictBtn" class="btn btn-primary">Save</button>
                    <div class="model_loader" style="display: none"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#districtTable').DataTable({
                ordering: true,
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [5]
                }]
            });

            ajax();

            function ajax() {
                $("#districtBody").html(`
                    <tr id="loadingRow">
                        <td colspan="6" class="py-3 text-center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                `);

                $.ajax({
                    url: "{{ route('get.district') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.clear();

                        if (response.data.length == 0) {
                            $("#districtBody").html(`
                                <tr>
                                    <td colspan="5" class="py-3 text-center text-muted">
                                        No data found
                                    </td>
                                </tr>
                            `);
                            return;
                        }
                        let total = response.data.length;
                        $.each(response.data, function(index, district) {
                            table.row.add([
                                total - index,
                                district.name,
                                district.state,
                                district.country,
                                district.created_by,
                                district.action
                            ]).draw(false);
                        });
                    }
                });
            }

            $("#adddistrict_btn").click(function() {
                $("#district_name").val("");
                $("#district_id").val("")
                $("#districtname_error").text("");
                $("#country_id").val(null).trigger('change');
                $("#state_id").val(null).trigger('change');
                $(".state_div").hide()
                $("#savedistrictBtn").text("Save");
                $("#adddistrictModal").modal("show");
                $(".model_loader").hide();
                $("#closedistrictBtn").show();
                $("#savedistrictBtn").show();
            });

            $('#country_id').on('change', function() {

                let countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: "{{ route('get.states.by.country') }}",
                        type: "GET",
                        data: {
                            country_id: countryId
                        },
                        success: function(response) {
                            if (response.data && response.data.length > 0) {
                                $(".state_div").show();
                                $.each(response.data, function(index, state) {
                                    $('#state_id').append(
                                        `<option value="${state.id}">${state.state}</option>`
                                    );
                                });
                            } else {
                                $(".state_div").hide();
                            }
                        },
                        error: function() {
                            $(".state_div").hide();
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to load state",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    });
                }
            });

            $("#savedistrictBtn").click(function() {

                let district_name = $("#district_name").val();
                let id = $("#district_id").val();
                let state_id = $("#state_id").val();
                let country_id = $("#country_id").val();


                if (country_id == '') {
                    $("#country_error").text("This filed is required");
                    $("#country_id").focus();
                    return false;
                } else {
                    $("#country_error").text("");
                }

                if ($("#state_id option").length > 1) {
                    if (state_id == '') {
                        $("#state_error").text("This field is required");
                        $("#state_id").focus();
                        return false;
                    } else {
                        $("#state_error").text("");
                    }
                } else {
                    $("#state_error").text("");
                }

                if (district_name == '') {
                    $("#districtname_error").text("This filed is required");
                    $("#district_name").focus()
                    return false;
                } else {
                    $("#districtname_error").text("");
                }

                $(".model_loader").show();
                $("#closedistrictBtn").hide();
                $("#savedistrictBtn").hide();


                $.ajax({
                    url: "{{ route('create.district') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id,
                        'district_name': district_name,
                        'country_id': country_id,
                        'state_id': state_id
                    },
                    success: function(response) {
                        $("#district_name").val("");
                        $("#adddistrictModal").modal("hide");
                        Swal.fire({
                            title: "Success!",
                            text: response.message || "district saved successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        $(".model_loader").hide();
                        $("#closedistrictBtn").show();
                        $("#savedistrictBtn").show();
                        ajax()
                    },
                    error: function(xhr, status, error) {
                        $(".model_loader").hide();
                        $("#closedistrictBtn").show();
                        $("#savedistrictBtn").show();
                        Swal.fire({
                            title: "Error!",
                            text: "Unable to add district",
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
                    url: "{{ route('view.district') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $("#savedistrictBtn").hide()
                        $("#fullPageLoader").hide();
                        $("#adddistrictModal").modal("show");
                        $("#district_name").val(response.data.name);
                        $("#country_id").val(response.data.country_id).trigger("change");
                        $("#state_id").html('<option>Loading...</option>');
                        setTimeout(function() {
                            $("#state_id").val(response.data.state_id).trigger(
                                "change");
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have district to view this.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to view district.",
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
                $("#districtname_error").text("")

                $.ajax({
                    url: "{{ route('edit.district') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#fullPageLoader").hide();
                        $("#adddistrictModal").modal("show");
                        $("#district_name").val(response.data.district);
                        $("#district_id").val(response.data.id);
                        $("#savedistrictBtn").show().text("Update");
                        $("#country_id").val(response.data.country_id).trigger("change");
                        $("#state_id").html('<option>Loading...</option>');
                        setTimeout(function() {
                            $("#state_id").val(response.data.state_id).trigger(
                                "change");
                        }, 1000);
                    },
                    error: function(xhr) {
                        $("#fullPageLoader").hide();
                        if (xhr.status == 403) {
                            Swal.fire({
                                title: "Access Denied!",
                                text: "You don't have permission to edit this district.",
                                icon: "warning",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to edit district.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    }
                });
            });


            $(document).on("click", ".deleteBtn", function() {
                let id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you really want to delete this district?",
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
                            url: "{{ route('delete.district') }}",
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
                                    text: "District deleted successfully.",
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
                                        text: "You don't have district to delete this.",
                                        icon: "warning",
                                        confirmButtonText: "OK"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Unable to delete district.",
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
