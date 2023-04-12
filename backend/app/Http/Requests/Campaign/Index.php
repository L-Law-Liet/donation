<?php

namespace App\Http\Requests\Campaign;

use App\Http\Requests\Api\IndexRequest;
use App\Models\Campaign;
use App\Services\CampaignService;
use Illuminate\Validation\Rule;

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
            'filter.name' => ['string', 'max:255'],
            'filter.friendly_name' => ['string', 'max:255'],
            'filter.status' => [Rule::in(CampaignService::STATUSES)],
            'sort' => [Rule::in(CampaignService::SORT)],
            'per_page' => ['integer', 'min:1'],
        ];
    }
}
