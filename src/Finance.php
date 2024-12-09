<?php

namespace FernandoEbert\Asaas;

/**
 * Finance [ MODEL ]
 * Classe responsavel por trazer os dados financeiros da conta
 *
 * @copyright (c) year, Fernando Ebert fernando@fernandoebert.com.br @FernandoEbert
 */

class Finance {

    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    public function balance()
    {
        return $this->http->get("/finance/balance");
    }

}
