@extends('layouts.admin')
@section('content')
    <style>
        .badge {
            font-size: 0.85rem;
            padding: 0.45em 0.75em;
            border-radius: 8px;
        }
    </style>
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Employee List</h5>
            </div>

            <div class="card-body">
                <table id="employeeTable" class="table text-center table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Employee Id</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Designation</th>
                            <th>Employee Status</th>
                            <th>Change Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="employeeBody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeuserPasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="border-0 shadow-lg modal-content">
                <div class="text-white modal-header bg-success">
                    <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="changeUserPasswordForm">
                        <input type="hidden" id="employee_id" name="employee_id">

                        <div class="mb-3">
                            <label for="user_new_password" class="form-label">New Password <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="user_new_password" name="new_password"
                                    placeholder="Enter new password" required>
                                <button type="button" class="btn btn-outline-secondary togglePassword"
                                    data-target="#user_new_password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="user_confirm_password" class="form-label">Confirm New Password <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="user_confirm_password"
                                    name="confirm_password" placeholder="Confirm new password" required>
                                <button type="button" class="btn btn-outline-secondary togglePassword"
                                    data-target="#user_confirm_password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="updateuserPasswordcloseBtn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="updateuserPasswordBtn">Update Password</button>
                    <div class="model_loader" style="display: none"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#employeeTable').DataTable({
                ordering: true,
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [8, 9]
                }],
                scrollX: true,
            });

            ajax();

            function ajax() {
                $("#employeeBody").html(`
                    <tr id="loadingRow">
                        <td colspan="10" class="py-3 text-center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                `);

                $.ajax({
                    url: "{{ route('get.employee') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        table.clear();

                        if (response.data.length == 0) {
                            $("#employeeBody").html(`
                                <tr>
                                    <td colspan="5" class="py-3 text-center text-muted">
                                        No data found
                                    </td>
                                </tr>
                            `);
                            return;
                        }
                        let total = response.data.length;
                        $.each(response.data, function(index, employee) {
                            table.row.add([
                                total - index,
                                employee.name,
                                employee.gender,
                                employee.employee_id,
                                employee.mobile_number,
                                employee.email,
                                employee.designation,
                                getStatusBadge(employee.employee_status),
                                `@can('change_employee_password')
                                    <button class="btn btn-sm btn-primary changePasswordBtn" data-id="${employee.id}">
                                        <i class="fa fa-key"></i>
                                    </button>
                                @else
                                    <span class="text-muted">Access Denied</span>
                                @endcan`,
                                `@can('employee_list_view')
                                     <button class="btn btn-secondary btn-sm viewBtn" data-id="${employee.id}">View</button>
                                @else

                                @endcan`
                            ]).draw(false);

                        });
                    }
                });
            }

            function getStatusBadge(status) {
                let badgeClass = '';
                switch (status) {
                    case 'Active':
                        badgeClass = 'badge bg-success';
                        break;
                    case 'Inactive':
                        badgeClass = 'badge bg-danger';
                        break;
                    case 'On Leave':
                        badgeClass = 'badge bg-warning text-dark';
                        break;
                    default:
                        badgeClass = 'badge bg-secondary';
                }
                return `<span class="${badgeClass}">${status}</span>`;
            }

            let selectedEmployeeId = null;
            $(document).on('click', '.changePasswordBtn', function() {
                selectedEmployeeId = $(this).data('id');
                $('#employee_id').val(selectedEmployeeId);
                $('#new_password').val('');
                $('#confirm_password').val('');
                $('#changeuserPasswordModal').modal('show');
            });

            $(document).on('click', '.togglePassword', function(e) {
                e.preventDefault();
                const targetSelector = $(this).data('target');
                const target = $(targetSelector);
                const type = target.attr('type') == 'password' ? 'text' : 'password';
                target.attr('type', type);

                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });


            $(document).on('click', '#updateuserPasswordBtn', function() {

                const newPassword = $('#user_new_password').val();
                const confirmPassword = $('#user_confirm_password').val();

                if (!newPassword || newPassword.length < 8) {
                    Swal.fire('Error', 'Password must be at least 8 characters long.', 'error');
                    return;
                }

                if (newPassword !== confirmPassword) {
                    Swal.fire('Error', 'Passwords do not match.', 'error');
                    return;
                }

                $("#updateuserPasswordBtn").hide()
                $("#updateuserPasswordcloseBtn").hide()
                $(".model_loader").show()

                $.ajax({
                    url: "{{ route('employee.changePassword') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: selectedEmployeeId,
                        password: newPassword,
                    },
                    success: function(response) {
                        Swal.fire('Success', response.message, 'success');
                        $("#user_new_password").val('')
                        $("#user_confirm_password").val('')
                        $('#changeuserPasswordModal').modal('hide');
                        $("#updateuserPasswordBtn").show()
                        $("#updateuserPasswordcloseBtn").show()
                        $(".model_loader").hide()
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Something went wrong.', 'error');
                        $("#updateuserPasswordBtn").show()
                        $("#updateuserPasswordcloseBtn").show()
                        $(".model_loader").hide()
                    }
                });
            });

            $(document).on("click", ".viewBtn", function() {
                const encryptedId = $(this).data('id');
                window.location.href = "/employee/view/" + encryptedId;
            });


        });
    </script>
@endsection
