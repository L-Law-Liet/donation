<?php

namespace App\Http\Requests\Location;

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
        dd(1);
        return [
            'gg' => ['required'],
        ];
    }
}
