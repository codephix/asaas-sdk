<?php

namespace CodePhix\Asaas;


class Notificacao {
    //

    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }
}
