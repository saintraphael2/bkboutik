<?php

namespace App\Http\Requests;

use App\Models\Tableau_armortissement;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTableau_armortissementRequest extends FormRequest
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
        $rules = Tableau_armortissement::$rules;
        
        return $rules;
    }
}
