<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
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
            "name" => ["sometimes", "nullable", "string"],
            "email" => ["sometimes", "nullable", "string"],
            "text" => ["sometimes", "nullable", "string"],

            "order_by" => ["sometimes", "nullable", "string"],
            "order_type" => ["sometimes", "nullable", "string", "in:asc,desc"],

            "per_page" => ["sometimes", "nullable", "integer"],
            "page" => ["sometimes", "nullable", "integer"],
        ];
    }
}
