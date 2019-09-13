<?php

namespace CodePhix\Asaas;


class Cidades {

    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    // Retorna a listagem de cobranças
    public function getAll(array $filtros){
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
        return $this->http->get('/cities'.$filtro);
    }

    // Retorna os dados da cobrança de acordo com o Id
    public function getById($id){
        return $this->http->get('/cities/'.$id);
    }

}
