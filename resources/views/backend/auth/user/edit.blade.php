@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($user, 'PATCH', route('admin.auth.user.update', $user->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                        <div class="col-md-10">
                            {{ html()->text('first_name')
                                ->class('form-control')
                                ->attribute('placeholder', __('validation.attributes.backend.access.users.first_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                        <div class="col-md-10">
                            {{ html()->text('last_name')
                                ->class('form-control')
                                ->attribute('placeholder', __('validation.attributes.backend.access.users.last_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->attribute('placeholder', __('validation.attributes.backend.access.users.email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('ID Number')->class('col-md-2 form-control-label')->for('id_number') }}

                        <div class="col-md-10">
                            {{ html()->text('id_number')
                                ->class('form-control')
                                ->attribute('placeholder', 'ID Number')
                                ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Date of Birth')->class('col-md-2 form-control-label')->for('date_birth') }}

                        <div class="col-md-10">
                            {{ html()->date('date_birth')
                                ->class('form-control')
                                ->attribute('placeholder', 'Date of Birth') }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Sex')->class('col-md-2 form-control-label')->for('sex') }}

                        <div class="col-md-10">
                            {{ html()->select('sex', ['Male' => 'Male', 'Female' => 'Female'], null)
                                ->class('form-control')
                                ->attribute('placeholder', 'Select Sex') }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('PWD (Person with Disability)')->class('col-md-2 form-control-label')->for('is_pwd') }}

                        <div class="col-md-10">
                            <label class="switch switch-label switch-pill switch-primary">
                                {{ html()->checkbox('is_pwd', false)->class('switch-input') }}
                                <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                            </label>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Phone')->class('col-md-2 form-control-label')->for('phone') }}

                        <div class="col-md-10">
                            {{ html()->tel('phone')
                                ->class('form-control')
                                ->attribute('placeholder', 'Phone Number')
                                ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Address')->class('col-md-2 form-control-label')->for('address') }}

                        <div class="col-md-10">
                            {{ html()->textarea('address')
                                ->class('form-control')
                                ->attribute('placeholder', 'Address')
                                ->rows(3) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Designation')->class('col-md-2 form-control-label')->for('designation') }}

                        <div class="col-md-10">
                            {{ html()->text('designation')
                                ->class('form-control')
                                ->attribute('placeholder', 'Designation')
                                ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Abilities')->class('col-md-2 form-control-label') }}

                        <div class="table-responsive col-md-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.backend.access.users.table.roles')</th>
                                        <th>@lang('labels.backend.access.users.table.permissions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if($roles->count())
                                                @foreach($roles as $role)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="checkbox d-flex align-items-center">
                                                                {{ html()->label(
                                                                        html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)
                                                                                ->class('switch-input')
                                                                                ->id('role-'.$role->id)
                                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                    ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                    ->for('role-'.$role->id) }}
                                                                {{ html()->label(ucwords($role->name))->for('role-'.$role->id) }}
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($role->id != 1)
                                                                @if($role->permissions->count())
                                                                    @foreach($role->permissions as $permission)
                                                                        <i class="fas fa-dot-circle"></i> {{ ucwords($permission->name) }}
                                                                    @endforeach
                                                                @else
                                                                    @lang('labels.general.none')
                                                                @endif
                                                            @else
                                                                @lang('labels.backend.access.users.all_permissions')
                                                            @endif
                                                        </div>
                                                    </div><!--card-->
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
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
                                                <hr class="my-2">
                                                
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
                                                                                    html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)
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
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}

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
