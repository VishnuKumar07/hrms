@extends('layouts.admin')

@section('content')
    <style>
        .permission-card {
            border-radius: 8px;
            transition: 0.2s ease-in-out;
            cursor: pointer;
        }

        .permission-card:hover {
            background: #f8f9fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .permission-checkbox {
            display: none;
        }

        .permission-label {
            width: 100%;
            border-radius: 6px;
            border: 2px solid transparent;
        }

        .permission-checkbox:checked+.permission-label {
            background: #0d6efd;
            color: white;
            border: 2px solid #0b5ed7;
        }
    </style>

    <div class="container mt-4">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create New Role</h5>
            </div>

            <div class="card-body">

                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Role Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter role name" required>
                    </div>

                    <hr>
                    <h6 class="fw-bold mb-3">Assign Permissions:</h6>

                    <div class="row g-3">
                        @foreach ($permissions as $permission)
                            <div class="col-md-3">
                                <div class="permission-card p-2">
                                    <input type="checkbox" class="permission-checkbox" id="perm_{{ $permission->id }}"
                                        name="permission_id[]" value="{{ $permission->id }}">

                                    <label for="perm_{{ $permission->id }}" class="permission-label text-center">
                                        {{ ucfirst($permission->name) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button class="mt-4 btn btn-success text-center">Save Role</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
