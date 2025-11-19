@extends('backend.layouts.app')

@section('title', __('labels.backend.access.roles.management') . ' | ' . __('labels.backend.access.roles.create'))

@section('content')
{{ html()->form('POST', route('admin.auth.role.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.roles.management')
                        <small class="text-muted">@lang('labels.backend.access.roles.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.roles.name'))
                            ->class('col-md-2 form-control-label')
                            ->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.roles.name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.roles.associated_permissions'))
                            ->class('col-md-2 form-control-label')
                            ->for('permissions') }}

                        <div class="col-md-10">
                            @if($permissions->count())
                                @php
                                    $grouped = [];
                                    foreach($permissions as $permission) {
                                        preg_match('/^\w+\s+(\w+)/', $permission->name, $matches);
                                        $module = $matches[1] ?? 'Other';
                                        if(!isset($grouped[$module])) {
                                            $grouped[$module] = [];
                                        }
                                        $grouped[$module][] = $permission;
                                    }
                                    ksort($grouped);
                                @endphp
                                
                                <!-- Select All Overall -->
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        {{ html()->label(
                                                html()->checkbox('select_all_permissions', false)
                                                      ->class('switch-input select-all-overall')
                                                      ->id('select-all-overall')
                                                    . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                ->class('switch switch-label switch-pill switch-success mr-2')
                                            ->for('select-all-overall') }}
                                        <strong>Select All Permissions</strong>
                                    </div>
                                </div>
                                <hr class="my-3">
                                
                                @foreach($grouped as $module => $perms)
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="collapse" data-target="#module-{{ $loop->index }}" aria-expanded="true">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <strong class="ml-2">{{ ucfirst($module) }} Module</strong>
                                            <small class="text-muted">({{ count($perms) }})</small>
                                            
                                            <!-- Module Select All -->
                                            <div class="ml-auto d-flex align-items-center">
                                                {{ html()->label(
                                                        html()->checkbox('select_module_' . strtolower($module), false)
                                                              ->class('switch-input select-module')
                                                              ->id('select-module-' . strtolower($module))
                                                              ->attribute('data-module', strtolower($module))
                                                            . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                        ->class('switch switch-label switch-pill switch-info mr-2')
                                                    ->for('select-module-' . strtolower($module)) }}
                                                <small>Select All</small>
                                            </div>
                                        </div>
                                        <div class="collapse show ml-4" id="module-{{ $loop->index }}">
                                            <div class="row">
                                                @foreach($perms as $permission)
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="checkbox d-flex align-items-center">
                                                            {{ html()->label(
                                                                    html()->checkbox('permissions[]', old('permissions') && in_array($permission->name, old('permissions')) ? true : false, $permission->name)
                                                                          ->class('switch-input permission-checkbox')
                                                                          ->id('permission-'.$permission->id)
                                                                          ->attribute('data-module', strtolower($module))
                                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                    ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                ->for('permission-'.$permission->id) }}
                                                            <small>{{ str_replace($module . ' ', '', ucwords($permission->name)) }}</small>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                @endforeach
                            @endif
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.role.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}

@push('after-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllOverall = document.querySelector('.select-all-overall');
        const selectModuleCheckboxes = document.querySelectorAll('.select-module');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        // Select All Overall functionality
        selectAllOverall?.addEventListener('change', function() {
            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            // Update all module checkboxes
            selectModuleCheckboxes.forEach(moduleCheckbox => {
                const module = moduleCheckbox.getAttribute('data-module');
                const modulePerms = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
                moduleCheckbox.checked = this.checked;
            });
        });

        // Module Select All functionality
        selectModuleCheckboxes.forEach(moduleCheckbox => {
            moduleCheckbox.addEventListener('change', function() {
                const module = this.getAttribute('data-module');
                const modulePerms = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
                modulePerms.forEach(perm => {
                    perm.checked = this.checked;
                });
                updateOverallSelectAll();
            });
        });

        // Individual permission checkbox changes
        permissionCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateOverallSelectAll);
        });

        // Update overall select all based on individual checkboxes
        function updateOverallSelectAll() {
            const allChecked = Array.from(permissionCheckboxes).every(cb => cb.checked);
            const anyChecked = Array.from(permissionCheckboxes).some(cb => cb.checked);
            selectAllOverall.checked = allChecked;
            selectAllOverall.indeterminate = anyChecked && !allChecked;
            
            // Update module checkboxes
            selectModuleCheckboxes.forEach(moduleCheckbox => {
                const module = moduleCheckbox.getAttribute('data-module');
                const modulePerms = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
                const allModuleChecked = Array.from(modulePerms).every(cb => cb.checked);
                const anyModuleChecked = Array.from(modulePerms).some(cb => cb.checked);
                moduleCheckbox.checked = allModuleChecked;
                moduleCheckbox.indeterminate = anyModuleChecked && !allModuleChecked;
            });
        }

        // Initialize state on page load
        updateOverallSelectAll();
    });
</script>
@endpush
@endsection
