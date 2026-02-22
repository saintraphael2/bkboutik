<?php

namespace App\Http\Requests;

use App\Models\DetailVente;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailVenteRequest extends FormRequest
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
        $rules = DetailVente::$rules;
        
        return $rules;
    }
}
