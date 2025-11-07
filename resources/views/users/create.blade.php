@extends('layouts.admin')

@section('content')
    <div class="container mt-2">
        <div class="mb-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
        </div>

        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create User</h5>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">

                    <div class="mb-3 col-6">
                        <label>Assign Role&nbsp;<span style="color:red">*</span></label>
                        <select id="role_id" name="role_id" class="form-control select2">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="role_error"></span>
                    </div>


                    <div class="mb-3 col-6">
                        <label>Name&nbsp;<span style="color:red">*</span></label>
                        <input type="text" id="name" placeholder="Enter name" name="name" class="form-control">
                        <span class="text-danger" id="name_error"></span>
                    </div>

                    <div class="mb-3 col-6">
                        <label>Email&nbsp;<span style="color:red">*</span></label>
                        <input type="email" id="email" placeholder="Enter email" name="email" class="form-control">
                        <span class="text-danger" id="email_error"></span>
                    </div>

                    <div class="mb-3 col-6">
                        <label>Password&nbsp;<span style="color:red">*</span></label>
                        <div class="input-group">
                            <input type="password" name="password" placeholder="Enter password" id="password"
                                class="form-control">
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                            </span>
                        </div>
                        <span class="text-danger" id="password_error"></span>
                    </div>
                    <div class="mb-3 col-6 employee_div" style="display: none">
                        <label>Designation&nbsp;<span style="color:red">*</span></label>
                        <select id="designation_id" class="form-control select2">
                            <option value="">Select Designation</option>
                            @foreach ($designations as $designation)
                                <option value="{{ $designation->id }}">{{ $designation->designation }}</option>
                            @endforeach
                        </select>
                        <span id="designation_error" class="text-danger"></span>
                    </div>

                    <div class="mb-3 col-6 employee_div" style="display: none">
                        <label>Employee ID&nbsp;<span style="color:red">*</span></label>
                        <input type="text" id="employee_id" placeholder="Enter employee id" name="employee_id"
                            class="form-control">
                        <span class="text-danger" id="employee_id_error"></span>
                    </div>

                    <div class="mb-3 col-6 employee_div" style="display: none">
                        <label>Gender&nbsp;<span style="color:red">*</span></label>
                        <select id="gender" class="form-control select2">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span class="text-danger" id="gender_error"></span>
                    </div>

                    <div class="mb-3 col-6 employee_div" style="display: none">
                        <label>Mobile Number&nbsp;<span style="color:red">*</span></label>
                        <input type="number" id="mobile_number" placeholder="Enter mobile number" name="mobile_number"
                            class="form-control">
                        <span class="text-danger" id="mobile_number_error"></span>
                    </div>

                    <div class="mb-3 col-6 employee_div" style="display: none">
                        <label>Work Type&nbsp;<span style="color:red">*</span></label>
                        <select id="worktype_id" class="form-control select2">
                            <option value="">Select Work Type</option>
                            @foreach ($worktypes as $worktype)
                                <option value="{{ $worktype->id }}">{{ $worktype->worktype }}</option>
                            @endforeach
                        </select>
                        <span id="worktype_id_error" class="text-danger"></span>
                    </div>
                </div>

                <div class="text-center">
                    <button class="mt-3 btn btn-outline-success" id="create_user_btn">Save</button>
                    <div class="loader" style="display: none"></div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('.select2').select2({
                width: '100%',
                placeholder: 'Select'
            });

            $('#togglePassword').on('click', function() {
                let input = $('#password');
                let icon = $('#toggleIcon');
                if (input.attr('type') == 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('bi-eye').addClass('bi-eye-slash');
                }
            });

            $('#role_id').on('change', function() {
                let selectedRole = $(this).val();

                $("#name, #email, #password, #employee_id, #mobile_number").val('');
                $("#designation_id, #gender, #worktype_id").val('').trigger('change');
                $(".text-danger").text('');

                if (selectedRole == '3') {
                    $(".employee_div").show();
                } else {
                    $(".employee_div").hide();
                }
            });

            $("#name").on("input", function() {
                let value = $(this).val();
                $(this).val(value.replace(/[^A-Za-z\s]/g, ''));
            });

            $("#create_user_btn").click(function(e) {
                e.preventDefault();

                let role_id = $("#role_id").val();
                let name = $("#name").val();
                let email = $("#email").val();
                let password = $("#password").val();
                let designation_id = $("#designation_id").val();
                let employee_id = $("#employee_id").val();
                let gender = $("#gender").val();
                let mobile_number = $("#mobile_number").val();
                let worktype_id = $("#worktype_id").val();
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


                if (!role_id) {
                    $("#role_error").text("Please select role");
                    $("#role_id").focus();
                    return false;
                } else {
                    $("#role_error").text("");
                }

                if (name == '') {
                    $("#name_error").text("Please enter name");
                    $("#name").focus();
                    return false;
                } else {
                    $("#name_error").text("");
                }

                if (email == '') {
                    $("#email_error").text("Please enter email");
                    $("#email").focus();
                    return false;
                } else if (!emailRegex.test(email)) {
                    $("#email_error").text("Please enter a valid email address");
                    $("#email").focus();
                    return false;
                } else {
                    $("#email_error").text("");
                }

                if (password == '') {
                    $("#password_error").text("Please enter password");
                    $("#password").focus();
                    return false;
                } else if (password.length < 8) {
                    $("#password_error").text("Password must be at least 8 characters long");
                    $("#password").focus();
                    return false;
                } else {
                    $("#password_error").text("");
                }

                if (role_id == 3) {
                    if (designation_id == '') {
                        $("#designation_error").text("Please select designation");
                        $("#designation_id").focus();
                        return false;
                    } else {
                        $("#designation_error").text("");
                    }
                    if (employee_id == '') {
                        $("#employee_id_error").text("Please enter employee id");
                        $("#employee_id").focus();
                        return false;
                    } else {
                        $("#employee_id_error").text("");
                    }
                    if (gender == '') {
                        $("#gender_error").text("Please select gender");
                        $("#gender").focus();
                        return false;
                    } else {
                        $("#gender_error").text("");
                    }
                    if (mobile_number == '') {
                        $("#mobile_number_error").text("Please enter mobile number");
                        $("#mobile_number").focus();
                        return false;
                    } else if (mobile_number.length != 10) {
                        $("#mobile_number_error").text("Please enter valid mobile number");
                        $("#mobile_number").focus();
                        return false;
                    } else {
                        $("#mobile_number_error").text("");
                    }
                    if (worktype_id == '') {
                        $("#worktype_id_error").text("Please select worktype");
                        $("#worktype_id").focus();
                        return false;
                    } else {
                        $("#worktype_id_error").text("");
                    }
                }

                $(".loader").show();
                $("#create_user_btn").hide();

                $.ajax({
                    url: "{{ route('users.store') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        role_id,
                        name,
                        email,
                        password,
                        designation_id,
                        employee_id,
                        gender,
                        mobile_number,
                        worktype_id
                    },
                    success: function(response) {
                        $(".loader").hide();
                        $("#create_user_btn").show();
                        if (response.status) {
                            Swal.fire({
                                title: "Success!",
                                text: response.message || "User created successfully.",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => window.location.href =
                                "{{ route('users.index') }}");
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to Create User",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    },
                    error: function(xhr) {
                        $(".loader").hide();
                        $("#create_user_btn").show();
                        if (xhr.status == 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = "";
                            $.each(errors, function(key, messages) {
                                errorMessages += `${messages.join('<br>')}<br>`;
                            });
                            Swal.fire({
                                title: "Validation Error!",
                                html: errorMessages,
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Unable to Create User",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    },
                });
            });
        });
    </script>
@endsection
