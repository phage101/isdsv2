<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('backend_provinces.tabs.content.overview.province_code')</th>
                <td>{{ $province->province_code }}</td>
            </tr>

            <tr>
                <th>@lang('backend_provinces.tabs.content.overview.name')</th>
                <td>{{ $province->name }}</td>
            </tr>

            <tr>
                <th>@lang('backend_provinces.tabs.content.overview.active')</th>
                <td>
                    @if($province->active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->
