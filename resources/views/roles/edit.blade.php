@extends('layouts.admin')
@section('content')
    <style>
        .permission-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-left: 6px solid #0d6efd;
        }

        .permission-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            padding: 10px 10px;
            border-radius: 8px;
            background: #f8f9fa;
            cursor: pointer;
            transition: 0.2s;
        }

        .permission-checkbox:hover {
            background: #e9ecef;
        }

        .permission-checkbox input {
            transform: scale(1.2);
            cursor: pointer;
        }
    </style>

    <div class="container mt-4">

        <div class="permission-card">
            <h4 class="mb-3">Edit Role</h4>

            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Role Name&nbsp;<span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ $role->name }}" class="form-control" required>
                </div>

                <!-- ✅ Select All / Deselect All Buttons -->
                <div class="mb-2 d-flex justify-content-between align-items-center">
                    <label class="form-label fw-semibold">Assign Permissions</label>

                    <div>
                        <button type="button" id="selectAll" class="btn btn-success btn-sm">Select All</button>
                        <button type="button" id="deselectAll" class="btn btn-danger btn-sm">Deselect All</button>
                    </div>
                </div>

                <div class="row">
                    @foreach ($permissions as $permission)
                        <div class="col-md-3 col-sm-6">
                            <label class="permission-checkbox">
                                <input type="checkbox" class="permissionBox" name="permission_id[]"
                                    value="{{ $permission->id }}" @checked(in_array($permission->id, $rolePermissions))>
                                {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <button class="mt-4 btn btn-primary">
                        <i class="bi bi-save"></i> Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("#selectAll").on("click", function() {
            $(".permissionBox").prop("checked", true);
        });

        $("#deselectAll").on("click", function() {
            $(".permissionBox").prop("checked", false);
        });
    </script>
@endsection
