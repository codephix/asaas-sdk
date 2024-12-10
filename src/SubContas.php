<?php

namespace CodePhix\Asaas;

use CodePhix\Asaas\Connection;
use \Exception;

class SubContas
{
    public $http;
    protected $cobranca;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    // Lista todas as subcontas
    public function getAll(array $filtros = [])
    {
        $filtros = ((!empty($filtros)) ? http_build_query($filtros) : '');
        return $this->http->get('/accounts?'.$filtros);
    }

    // Retorna dados de uma subconta
    public function getByid(?String $id)
    {
        $filtros = ['id' => $id];
        $filtros = ((!empty($filtros)) ? http_build_query($filtros) : '');
        return $this->http->get('/accounts?'.$filtros);
    }

    // Cria uma nova subconta
    public function create(array $dados = [])
    {
        return $this->http->post('/accounts?',$dados);
    }

}
