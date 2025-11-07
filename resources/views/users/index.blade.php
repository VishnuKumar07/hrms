@extends('layouts.admin')
@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

        @can('user_create')
            <a href="{{ route('users.create') }}" class="mb-3 btn btn-success">Add User</a>
        @endcan

        <table class="table text-center table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('user_edit')
                                <a href="{{ route('users.edit', encrypt($user->id)) }}" class="btn btn-sm btn-primary">Edit</a>
                            @endcan

                            @can('user_delete')
                                <form action="{{ route('users.destroy', encrypt($user->id)) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $(".delete-btn").click(function(e) {
                e.preventDefault();

                let form = $(this).closest("form");

                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you really want to delete this user?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
