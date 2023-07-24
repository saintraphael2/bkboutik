<?php

namespace App\Http\Requests;

use App\Models\User_liens;
use Illuminate\Foundation\Http\FormRequest;

class CreateUser_liensRequest extends FormRequest
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
        return User_liens::$rules;
    }
}
