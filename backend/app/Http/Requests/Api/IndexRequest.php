<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;
use App\Services\ApiService;
use Illuminate\Validation\Rule;

class IndexRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return $this->getDefault();
    }


    protected function getDefault(): array
    {
        $arr = explode('\\', get_class($this));
        $rules = [
            'sort' => [Rule::in(array_keys(
                app('App\Services\\'.$arr[count($arr) - 2].'Service')::SORT()
            ))],
            'per_page' => ['integer', 'min:1'],
        ];
        if ($this->hasStatus()) {
            $rules['filter.status'] = [Rule::in(ApiService::STATUS())];
        }
        return $rules;
    }

    protected function filterRules(array $cols): array
    {
        $rules = [];
        foreach ($cols as $col) {
            $rules['filter.'.$col] = ['string', 'max:255'];
        }
        return $rules;
    }

    protected function hasStatus(): bool
    {
        return true;
    }
}
