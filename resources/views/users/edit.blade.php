@extends('layouts.admin')

@section('content')
    <div class="container mt-2">
        <div class="mb-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
        </div>

        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit User</h5>
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

                <form action="{{ route('users.update', encrypt($user->id)) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="mb-3 col-6">
                            <label>Assign Role&nbsp;<span class="text-danger">*</span></label>
                            <select name="role_id" id="role_id" class="form-control select2" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ in_array($role->id, $userRoles) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-6">
                            <label>Name&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                placeholder="Enter name" class="form-control" required>
                        </div>

                        <div class="mb-3 col-6">
                            <label>Email&nbsp;<span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="Enter email" class="form-control" required>
                        </div>

                        <div class="mb-3 col-6 employee_div">
                            <label>Designation&nbsp;<span class="text-danger">*</span></label>
                            <select name="designation_id" class="form-control select2">
                                <option value="">Select Designation</option>
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}"
                                        {{ isset($employeeDetails) && $employeeDetails->designation_id == $designation->id ? 'selected' : '' }}>
                                        {{ $designation->designation }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-6 employee_div">
                            <label>Employee ID&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="employee_id" value="{{ $employeeDetails->employee_id ?? '' }}"
                                placeholder="Enter employee ID" class="form-control">
                        </div>

                        <div class="mb-3 col-6 employee_div">
                            <label>Mobile Number&nbsp;<span class="text-danger">*</span></label>
                            <input type="number" name="mobile_number" value="{{ $personalDetails->mobile_number ?? '' }}"
                                class="form-control" placeholder="Enter mobile number">
                        </div>

                        <div class="mb-3 col-6 employee_div">
                            <label>Gender&nbsp;<span class="text-danger">*</span></label>
                            <select name="gender" class="form-control select2">
                                <option value="">Select Gender</option>
                                <option value="Male"
                                    {{ isset($personalDetails) && $personalDetails->gender == 'Male' ? 'selected' : '' }}>
                                    Male</option>
                                <option value="Female"
                                    {{ isset($personalDetails) && $personalDetails->gender == 'Female' ? 'selected' : '' }}>
                                    Female</option>
                            </select>
                        </div>

                        <div class="mb-3 col-6 employee_div">
                            <label>Work Type&nbsp;<span class="text-danger">*</span></label>
                            <select name="worktype_id" class="form-control select2">
                                <option value="">Select Work Type</option>
                                @foreach ($worktypes as $worktype)
                                    <option value="{{ $worktype->id }}"
                                        {{ isset($employeeDetails) && $employeeDetails->worktype_id == $worktype->id ? 'selected' : '' }}>
                                        {{ $worktype->worktype }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="text-center">
                        <button class="mt-3 btn btn-outline-success">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            function toggleEmployeeFields() {
                let role = $('#role_id').val();
                if (role == 3) {
                    $('.employee_div').show();
                } else {
                    $('.employee_div').hide();
                }
            }

            toggleEmployeeFields();
            $('#role_id').on('change', toggleEmployeeFields);
        });
    </script>
@endsection
