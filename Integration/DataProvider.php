<?php

namespace src\Integration;

use src\Models\DataProviderConfig;

class DataProvider
{
    public function __construct(
        protected DataProviderConfig $config
    )
    {
    }

    /**
     * Get response from external service
     *
     * @param array $request
     * @return array
     */
    public function getFromExternalService(array $request): array
    {
        // returns a response from external service
    }
}
