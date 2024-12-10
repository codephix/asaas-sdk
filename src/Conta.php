<?php

namespace CodePhix\Asaas;

use CodePhix\Asaas\Connection;

class Conta {
    public $http;
    protected $cobranca;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    // Retorna a listagem de cobranças
    public function getAll(array $filtros = []){
        $filtro = '';
        if(is_array($filtros)){
            if($filtros){
                foreach($filtros as $key => $f){
                    if(!empty($f)){
                        if($filtro){
                            $filtro .= '&';
                        }
                        $filtro .= $key.'='.$f;
                    }
                }
                $filtro = '?'.$filtro;
            }
        }
        return $this->http->get('/accounts'.$filtro);
    }

    // Retorna a listagem de cobranças
    public function getConta(){
        return $this->http->get('/wallets');
    }

    // Insere uma nova cobrança
    public function create(array $dadosCobranca){
        return $this->http->post('/accounts', $dadosCobranca);
    }

}
