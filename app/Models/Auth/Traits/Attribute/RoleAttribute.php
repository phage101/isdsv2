<?php

namespace App\Models\Auth\Traits\Attribute;

/**
 * Trait RoleAttribute.
 */
trait RoleAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.auth.role.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="javascript:;"
                style="cursor:pointer;"
                onclick="$(this).find(\'form\').submit();"
                title="' . __('buttons.general.crud.delete') . '"
                data-method="delete"
                data-trans-button-cancel="' . __('buttons.general.cancel') . '"
                data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
                data-trans-title="' . __('strings.backend.general.are_you_sure') . '"
                class="btn btn-danger">' .
            '<form action="' . route('admin.auth.role.destroy', $this) . '" method="POST" name="delete_item" style="display:none">'
            . '<input type="hidden" name="_method" value="delete" />'
            . '<input type="hidden" name="_token" value="' . csrf_token() . '" />'
            . '</form>' .
            '<i class="fas fa-trash"></i></a>';
    }
}
