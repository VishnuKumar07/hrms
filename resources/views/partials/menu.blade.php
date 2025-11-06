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
        aria-expanded="{{ Request::is('projects*') || Request::is('designations*') || Request::is('countries*') || Request::is('worktypes*') || Request::is('states*') || Request::is('bloodgroups*') ? 'true' : 'false' }}">
        <span><i class="bi bi-tools"></i> Master Tool</span>
        <i class="bi bi-chevron-right arrow-icon"></i>
    </a>

    <div class="collapse {{ Request::is('projects*') ||
    Request::is('designations*') ||
    Request::is('worktypes*') ||
    Request::is('states*') ||
    Request::is('countries*') ||
    Request::is('bloodgroups*')
        ? 'show'
        : '' }}"
        id="masterSubMenu">
        @can('bloodgroup_access')
            <a href="{{ route('bloodgroups') }}" class="menu-item ps-5 {{ Request::is('bloodgroups*') ? 'active' : '' }}">
                <i class="bi bi-droplet-fill"></i> Bloodgroup
            </a>
        @endcan
        @can('country_access')
            <a href="{{ route('countries') }}" class="menu-item ps-5 {{ Request::is('countries*') ? 'active' : '' }}">
                <i class="bi bi-globe-americas"></i> Countries
            </a>
        @endcan

        @can('designation_access')
            <a href="{{ route('designations') }}" class="menu-item ps-5 {{ Request::is('designations*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> Designations
            </a>
        @endcan
        @can('project_access')
            <a href="{{ route('projects') }}" class="menu-item ps-5 {{ Request::is('projects*') ? 'active' : '' }}">
                <i class="bi bi-kanban"></i> Projects
            </a>
        @endcan
        @can('state_access')
            <a href="{{ route('states') }}" class="menu-item ps-5 {{ Request::is('states*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i> State
            </a>
        @endcan
        @can('worktype_access')
            <a href="{{ route('worktypes') }}" class="menu-item ps-5 {{ Request::is('worktypes*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check"></i> Work Type
            </a>
        @endcan

    </div>
@endcan
