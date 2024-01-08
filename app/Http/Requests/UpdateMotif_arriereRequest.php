<?php

namespace App\Http\Requests;

use App\Models\Motif_arriere;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMotif_arriereRequest extends FormRequest
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
        $rules = Motif_arriere::$rules;
        
        return $rules;
    }
}
