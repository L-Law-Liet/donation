<?php

namespace App\Http\Requests\Field;

use App\Http\Requests\Api\IndexRequest;

class Index extends IndexRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        return [
            'gg' => ['required'],
        ];
    }
}
