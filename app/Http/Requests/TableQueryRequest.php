<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableQueryRequest extends FormRequest
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
            "table" => "required|string",
            "fields" => ["array"],
            "fields.*" => "string",
            "conditions" => ["array"],
            "conditions.*.condition" => ["required", Rule::in(["like","=",">",">=","<","<=","<>"])],
            "aggregate" => "sometimes",
            "aggregate.field" => "sometimes"
        ];
    }
}
