<?php

namespace CodePhix\Asaas;


class PagarConta {

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
        return $this->http->get('/bill/'.$filtro);
    }
    public function getBy($id){
        return $this->http->get('/bill/'.$id);
    }

    public function create($dadosConta){
        return $this->http->post('/bill', $dadosConta);
    }

    public function cancel($id){
        return $this->http->post('/bill/'.$id.'/cancel', []);
    }

    public function simulate($dadosConta){
        return $this->http->post('/bill/simulate', $dadosConta);
    }
}
