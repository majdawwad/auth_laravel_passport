<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->user()->can('product-list')){return true;}
        return false;
    }

    public function rules(): array
    {
        return [
            'permissions' => ['required'],
            'permissions.*' => ['exists:permissions,name'],
            'role' => ['required', 'unique:roles,name', 'max:60'],
        ];
    }
}
