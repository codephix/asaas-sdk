<?php

namespace CodePhix\Asaas;


class Webhook {

    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }
}
