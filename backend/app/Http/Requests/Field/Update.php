<?php

namespace App\Http\Requests\Field;

use App\Http\Requests\Api\UpdateRequest;

class Update extends UpdateRequest
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
