<li class="nav-item">
    <a class="nav-link {{ active_class(Route::is('admin.meetings.*')) }}" href="{{ route('admin.meetings.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_meetings.sidebar.title')
    </a>
</li>
