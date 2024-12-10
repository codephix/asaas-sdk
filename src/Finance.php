<?php

namespace CodePhix\Asaas;

use CodePhix\Asaas\Connection;
use \Exception;

class Finance
{
    public $http;
    protected $cobranca;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    // Retorna a listagem de cobranças
    public function getBalance()
    {
        return $this->http->get('/finance/balance');
    }

    // Retorna os dados da cobrança de acordo com o Id
    public function getPaymentStatistics(array $filtros = [])
    {
        $filtros = http_build_query($filtros);
        return $this->http->get('/finance/payment/statistics?'.$filtros);
    }

    // Retorna os dados da cobrança de acordo com o Id
    public function getSplitStatistics()
    {
        return $this->http->get('/finance/split/statistics?');
    }

}
