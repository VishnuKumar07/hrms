<a href="{{ route('dashboard') }}" class="menu-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i> Dashboard
</a>

@can('authentication_access')
    <a class="menu-item d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#authSubMenu"
        role="button"
        aria-expanded="{{ Request::routeIs('permissions') || Request::routeIs('roles.*') || Request::is('users*') ? 'true' : 'false' }}">
        <span><i class="bi bi-shield-lock"></i> Authentication</span>
        <i class="bi bi-chevron-right arrow-icon"></i>
    </a>
    <div class="collapse {{ Request::routeIs('permissions') || Request::routeIs('roles.*') || Request::is('users*') ? 'show' : '' }}"
        id="authSubMenu">
        @can('user_access')
            <a href="{{ route('users.index') }}" class="menu-item ps-5 {{ Request::is('users*') ? 'active' : '' }}">
                <i class="bi bi-person-plus"></i> Users
            </a>
        @endcan
        @can('role_access')
            <a href="{{ route('roles.index') }}" class="menu-item ps-5 {{ Request::routeIs('roles.*') ? 'active' : '' }}">
                <i class="bi bi-key"></i> Roles
            </a>
        @endcan
        @can('permission_access')
            <a href="{{ route('permissions') }}" class="menu-item ps-5 {{ Request::routeIs('permissions') ? 'active' : '' }}">
                <i class="bi bi-person-check"></i> Permissions
            </a>
        @endcan
    </div>
@endcan

@can('master_tool_access')
    <a class="menu-item d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#masterSubMenu"
        role="button"
        aria-expanded="{{ Request::is('company*') || Request::is('projects*') || Request::is('designations*') ? 'true' : 'false' }}">
        <span><i class="bi bi-tools"></i> Master Tool</span>
        <i class="bi bi-chevron-right arrow-icon"></i>
    </a>

    <div class="collapse {{ Request::is('company*') || Request::is('projects*') || Request::is('designations*') ? 'show' : '' }}"
        id="masterSubMenu">

        @can('project_access')
            <a href="{{ route('projects') }}" class="menu-item ps-5 {{ Request::is('projects*') ? 'active' : '' }}">
                <i class="bi bi-kanban"></i> Projects
            </a>
        @endcan

        <a href="#" class="menu-item ps-5 {{ Request::is('designations*') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i> Designations
        </a>


    </div>
@endcan
