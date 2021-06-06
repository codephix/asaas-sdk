<?php

namespace CodePhix\Asaas;


class ConsultaSerasa {

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
        return $this->http->get('/creditBureauReport'.$filtro);
    }

    public function getBy($id){
        return $this->http->get('/creditBureauReport/'.$id);
    }

    public function create($dados){
        return $this->http->post('/creditBureauReport', $dados);
    }

}
