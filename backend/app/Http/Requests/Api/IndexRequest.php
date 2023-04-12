<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;

class IndexRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [];
    }
}
