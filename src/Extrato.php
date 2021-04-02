<?php

namespace CodePhix\Asaas;

/**
 * Extrato [ MODEL ]
 * Classe responsavel por trazer os Extratos da conta
 *
 * @copyright (c) year, Lúdio Oliveira ludio.ao@gmail.com
 */

class Extrato {

    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    public function getAll($parameters = array())
    {
        return $this->http->get(
            sprintf('/financialTransactions?%s', http_build_query(
                [
                    'startDate' => $parameters['startDate'] ?? '',
                    'finishDate' => $parameters['finishDate'] ?? '',
                    'offset' => $parameters['offset'] ?? 0,
                    'limit' => $parameters['limit'] ?? 10,
                ]
            ))
        );
    }

}
