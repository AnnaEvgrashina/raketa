<?php

namespace src\Models;

class DataProviderConfig
{
    public function __construct(
        private string $host,
        private string $user,
        private string $password
    )
    {
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }


}