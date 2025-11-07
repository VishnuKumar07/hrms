<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Human Resource Management Software</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        body {
            background-color: #F3F4F6;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #004433, #006644);
            color: white;
            position: fixed;
            padding: 25px 15px;
            overflow-y: auto;
        }

        .sidebar-logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .menu-item {
            padding: 5px 5px 5px 30px;
            display: flex;
            align-items: center;
            border-radius: 6px;
            cursor: pointer;
            margin-bottom: 4px;
            transition: 0.2s;
            color: white;
            text-decoration: none;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .menu-item i {
            margin-right: 10px;
            font-size: 18px;
            color: white;
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.30);
            font-weight: 600;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .navbar-custom {
            margin-left: 250px;
        }

        .menu-item[aria-expanded="true"] .arrow-icon {
            transform: rotate(90deg);
            transition: 0.3s;
        }

        .arrow-icon {
            transition: 0.3s;
        }

        .table th,
        table td {
            text-align: center !important;
        }

        .dropdown-menu li {
            margin-bottom: 8px;
        }

        .dropdown-menu li:last-child {
            margin-bottom: 0;
        }

        #fullPageLoader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .center_loader {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #0d6efd;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }


        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #0d6efd;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            margin: auto;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .model_loader {
            width: 60px;
            aspect-ratio: 4;
            background: radial-gradient(circle closest-side, #000 90%, #0000) 0/calc(100%/3) 100% space;
            clip-path: inset(0 100% 0 0);
            animation: l1 1s steps(4) infinite;
        }

        @keyframes l1 {
            to {
                clip-path: inset(0 -34% 0 0)
            }
        }

        /* Bootstrap 5 compatible Select2 styles */
        .select2-container .select2-selection--single {
            height: calc(2rem + 2px) !important;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            right: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: normal;
            color: #212529;
        }

        .select2-container--default .select2-selection--single:focus,
        .select2-container--default .select2-selection--multiple:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
            outline: 0;
        }

        .select2-dropdown {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #0d6efd;
            color: white;
        }

        .select2-container {
            z-index: 9999 !important;
        }

        .select2-dropdown {
            z-index: 99999 !important;
        }

        .swal2-container {
            z-index: 110000 !important;
        }
    </style>
</head>

<body>
    <div id="fullPageLoader" style="display:none;">
        <div class="center_loader"></div>
    </div>

    <div class="sidebar">
        <div class="sidebar-logo"></div>
        @include('partials.menu')
    </div>

    <nav class="bg-white shadow-sm navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        @can('user_change_password_access')
                            <li>
                                <a class="dropdown-item" href="#">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#changePasswordModal">
                                        <i class="bi bi-shield-lock"></i> Change Password
                                    </a>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="changePasswordForm">
                    @csrf
                    <div class="text-white modal-header bg-success">
                        <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3 position-relative">
                            <label for="new_password" class="form-label">
                                New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    required>
                                <span class="input-group-text" id="toggleNewPassword" style="cursor: pointer;">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="confirm_password" class="form-label">
                                Confirm New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" required>
                                <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <main class="content">
        @yield('content')
    </main>

    @yield('scripts')

    <script>
        $(document).ready(function() {
            $('.select2').each(function() {
                let $this = $(this);
                $this.select2({
                    placeholder: $this.data('placeholder') || 'Select an option',
                    width: '100%',
                    dropdownParent: $this.closest('.modal').length ? $this.closest('.modal') : $(
                        document.body)
                });
            });
            $("#toggleNewPassword").click(function() {
                let input = $("#new_password");
                let icon = $(this).find("i");
                let type = input.attr("type") == "password" ? "text" : "password";
                input.attr("type", type);
                icon.toggleClass("fa-eye fa-eye-slash");
            });

            $("#toggleConfirmPassword").click(function() {
                let input = $("#confirm_password");
                let icon = $(this).find("i");
                let type = input.attr("type") == "password" ? "text" : "password";
                input.attr("type", type);
                icon.toggleClass("fa-eye fa-eye-slash");
            });

            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                let new_password = $('#new_password').val();
                let confirm_password = $('#confirm_password').val();

                if (new_password !== confirm_password) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Passwords do not match!',
                        confirmButtonColor: '#0d6efd'
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('user.changepassword') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        new_password: new_password
                    },
                    beforeSend: function() {
                        $('#changePasswordForm button[type="submit"]').prop('disabled', true)
                            .text('Updating...');
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Password updated successfully!',
                            confirmButtonColor: '#0d6efd'
                        });
                        $('#changePasswordModal').modal('hide');
                        $('#changePasswordForm')[0].reset();
                    },
                    error: function(xhr) {
                        let errorMessage = 'Please try again.';
                        let title = 'Error updating password';
                        let iconType = 'error';

                        if (xhr.status == 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors && errors.new_password) {
                                errorMessage = errors.new_password[0];
                            }
                        } else if (xhr.status == 403) {
                            title = 'Access Denied';
                            errorMessage = 'You do not have permission to change the password.';
                            iconType = 'warning';
                        }
                        Swal.fire({
                            icon: iconType,
                            title: title,
                            text: errorMessage,
                            confirmButtonColor: '#0d6efd'
                        });
                    },
                    complete: function() {
                        $('#changePasswordForm button[type="submit"]').prop('disabled', false)
                            .text('Update Password');
                    }
                });
            });
        });
    </script>



</body>

</html>
