<?php

namespace App\Http\Requests\Reason;

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

        return [
            'gg' => ['required'],
        ];
    }
}
