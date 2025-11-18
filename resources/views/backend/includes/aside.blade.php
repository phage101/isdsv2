<aside class="aside-menu">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#reference-data" role="tab">
                <i class="fas fa-database"></i> Reference Data
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="reference-data" role="tabpanel">
            <div class="p-2">
                <input type="text" class="form-control form-control-sm" id="referenceDataSearch" placeholder="Search reference data...">
            </div>
            <nav class="nav flex-column" id="referenceDataNav">
                <!-- Locations -->
                <a class="nav-link" href="{{ route('admin.provinces.index') }}" data-search="provinces">
                    <i class="nav-icon fas fa-map"></i> Provinces
                </a>

                <a class="nav-link" href="{{ route('admin.office_types.index') }}" data-search="office types">
                    <i class="nav-icon fas fa-building"></i> Office Types
                </a>

                <a class="nav-link" href="{{ route('admin.offices.index') }}" data-search="offices">
                    <i class="nav-icon fas fa-city"></i> Offices
                </a>

                <a class="nav-link" href="{{ route('admin.divisions.index') }}" data-search="divisions">
                    <i class="nav-icon fas fa-sitemap"></i> Divisions
                </a>

                <!-- Clients -->
                <a class="nav-link" href="{{ route('admin.client_types.index') }}" data-search="client types">
                    <i class="nav-icon fas fa-users"></i> Client Types
                </a>

                <!-- Requests and related lookups -->
                <a class="nav-link" href="{{ route('admin.request_types.index') }}" data-search="request types">
                    <i class="nav-icon fas fa-question-circle"></i> Request Types
                </a>

                <a class="nav-link" href="{{ route('admin.categories.index') }}" data-search="categories">
                    <i class="nav-icon fas fa-tags"></i> Categories
                </a>

                <a class="nav-link" href="{{ route('admin.sub_categories.index') }}" data-search="sub categories">
                    <i class="nav-icon fas fa-tag"></i> Sub Categories
                </a>

                <a class="nav-link" href="{{ route('admin.priority_levels.index') }}" data-search="priority levels">
                    <i class="nav-icon fas fa-exclamation-circle"></i> Priority Levels
                </a>

                <a class="nav-link" href="{{ route('admin.statuses.index') }}" data-search="statuses">
                    <i class="nav-icon fas fa-check-circle"></i> Statuses
                </a>

                @if(Route::has('admin.media.index') || Route::has('admin.mediums.index'))
                    @php
                        $mediumsRoute = Route::has('admin.media.index') ? 'admin.media.index' : 'admin.mediums.index';
                    @endphp
                    <a class="nav-link" href="{{ route($mediumsRoute) }}" data-search="mediums media">
                        <i class="nav-icon fas fa-comment"></i> Mediums
                    </a>
                @endif

                <a class="nav-link" href="{{ route('admin.hosts.index') }}" data-search="hosts">
                    <i class="nav-icon fas fa-server"></i> Hosts
                </a>
            </nav>
        </div>
    </div>
    <script>
        document.getElementById('referenceDataSearch').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const navLinks = document.querySelectorAll('#referenceDataNav .nav-link');
            
            navLinks.forEach(link => {
                const searchText = link.getAttribute('data-search') + ' ' + link.textContent;
                if (searchText.toLowerCase().includes(searchTerm)) {
                    link.style.display = '';
                } else {
                    link.style.display = 'none';
                }
            });
        });
    </script>
</aside>
