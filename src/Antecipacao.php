<?php

namespace CodePhix\Asaas;


class Antecipacao {

    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }


    public function getAll($parametos = false){
        $filtro = '';
        if(is_array($parametos)){
            if($parametos){
                foreach($parametos as $key => $f){
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
        return $this->http->get('/anticipations/'.$filtro);
    }
    public function getBy($id){
        return $this->http->get('/anticipations/'.$id);
    }

    public function create($dadosSolicitacao){
        return $this->http->post('/anticipations', $dadosConta);
    }

    public function simulate($dadosSolicitacao){
        return $this->http->post('/anticipations/simulate', $dadosConta);
    }
}
