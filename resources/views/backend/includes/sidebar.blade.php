<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/log-viewer*'), 'open')
                }}">
                        <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/log-viewer*'))
                        }}" href="#">
                        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer'))
                        }}" href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer/logs*'))
                        }}" href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Master / Reference Data -->
            <li class="nav-title">
                Reference Data
            </li>

            <!-- Locations -->
            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.provinces*')) }}" href="{{ route('admin.provinces.index') }}">
                    <i class="nav-icon fas fa-map"></i> Provinces
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.office_types*')) }}" href="{{ route('admin.office_types.index') }}">
                    <i class="nav-icon fas fa-building"></i> Office Types
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.offices*')) }}" href="{{ route('admin.offices.index') }}">
                    <i class="nav-icon fas fa-city"></i> Offices
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.divisions*')) }}" href="{{ route('admin.divisions.index') }}">
                    <i class="nav-icon fas fa-sitemap"></i> Divisions
                </a>
            </li>

            <!-- Clients -->
            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.client_types*')) }}" href="{{ route('admin.client_types.index') }}">
                    <i class="nav-icon fas fa-users"></i> Client Types
                </a>
            </li>

            <!-- Requests and related lookups -->
            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.request_types*')) }}" href="{{ route('admin.request_types.index') }}">
                    <i class="nav-icon fas fa-question-circle"></i> Request Types
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.categories*')) }}" href="{{ route('admin.categories.index') }}">
                    <i class="nav-icon fas fa-tags"></i> Categories
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.sub_categories*')) }}" href="{{ route('admin.sub_categories.index') }}">
                    <i class="nav-icon fas fa-tag"></i> Sub Categories
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.priority_levels*')) }}" href="{{ route('admin.priority_levels.index') }}">
                    <i class="nav-icon fas fa-exclamation-circle"></i> Priority Levels
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.statuses*')) }}" href="{{ route('admin.statuses.index') }}">
                    <i class="nav-icon fas fa-check-circle"></i> Statuses
                </a>
            </li>

            @if(Route::has('admin.media.index') || Route::has('admin.mediums.index'))
            <li class="nav-item">
                @php
                    $mediumsRoute = Route::has('admin.media.index') ? 'admin.media.index' : 'admin.mediums.index';
                @endphp
                <a class="nav-link {{ active_class(Route::is('admin.media*') || Route::is('admin.mediums*')) }}" href="{{ route($mediumsRoute) }}">
                    <i class="nav-icon fas fa-comment"></i> Mediums
                </a>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link {{ active_class(Route::is('admin.hosts*')) }}" href="{{ route('admin.hosts.index') }}">
                    <i class="nav-icon fas fa-server"></i> Hosts
                </a>
            </li>
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
