@extends('layouts.admin')

@section('content')
    <div class="container mt-4">

        <div class="card shadow-sm">
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

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label>User Name&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label>Email&nbsp;<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3 position-relative">
                            <label>Password&nbsp;<span class="text-danger">*</span></label>

                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <label class="mt-2">Assign Role&nbsp;<span class="text-danger">*</span></label>
                    <div class="row">
                        @foreach ($roles as $role)
                            <div class="col-3">
                                <label class="d-block border rounded p-2 mb-2">
                                    <input type="radio" name="role_id" value="{{ $role->id }}" required>
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success mt-3">Save</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endsection
