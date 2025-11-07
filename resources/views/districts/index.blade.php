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
                "ordering": false,
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

        })
    </script>
@endsection
