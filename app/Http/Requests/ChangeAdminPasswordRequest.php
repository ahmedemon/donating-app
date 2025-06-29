<?php

namespace App\Http\Requests;

use App\Rules\CheckAdminOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangeAdminPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', new CheckAdminOldPassword],
            'password' => ['required', 'min:8', 'confirmed:password_confirmation'],
        ];
    }
}