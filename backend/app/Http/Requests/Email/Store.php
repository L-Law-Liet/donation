<?php

namespace App\Http\Requests\Email;

use App\Http\Requests\Api\StoreRequest;

class Store extends StoreRequest
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
