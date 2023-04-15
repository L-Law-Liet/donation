<?php

namespace App\Services\Traits;

trait WithParams
{
    use WithSort;
    use WithFilter;

    protected array $params = [];
    private array $filter = [];

    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
        $this->filter = $params['filter'] ?? [];
    }

    /**
     * @return array
     */
    public function getFilter(): array
    {
        return $this->filter;
    }
}
