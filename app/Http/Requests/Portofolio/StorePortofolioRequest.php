<?php

namespace App\Http\Requests\Portofolio;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StorePortofolioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required|string',
            'description' => 'required|string',
            'link' => 'required|string'
        ];


    }
}
