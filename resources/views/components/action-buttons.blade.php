@props(['id', 'viewRoute' => null, 'editRoute' => null, 'deleteRoute' => null])

<div class="btn-group" style="gap: 6px;">
    @can($viewRoute)
        <button data-id="{{ $id }}" class="btn btn-success btn-sm viewBtn">View</button>
    @endcan

    @can($editRoute)
        <button href="#" data-id="{{ $id }}" class="btn btn-warning btn-sm editBtn">Edit</button>
    @endcan

    @can($deleteRoute)
        <button href="#" data-id="{{ $id }}" class="btn btn-danger btn-sm deleteBtn">Delete</button>
    @endcan
</div>
