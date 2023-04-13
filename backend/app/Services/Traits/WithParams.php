<?php

namespace App\Services\Traits;

trait WithParams
{
    use WithSort;
    use WithFilter;

    protected array $params = [];

    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }
}
