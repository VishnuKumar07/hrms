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

        @can('role_create')
            <a href="{{ route('roles.create') }}" class="mb-3 btn btn-primary">Add Role</a>
        @endcan


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Role Name</th>
                    <th>Permissions</th>
                    <th width="180px">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission)
                                <span class="badge bg-primary">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('role_edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan
                            @can('role_delete')
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
