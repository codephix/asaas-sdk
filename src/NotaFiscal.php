<?php

namespace CodePhix\Asaas;


class NotaFiscal {

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
        return $this->http->get('/invoices/'.$filtro);
    }

    public function getBy($id){
        return $this->http->get('/invoices/'.$id);
    }


    public function ListMunicipalServices($parametos){
        return $this->http->get('/invoices/municipalServices?description='.$parametos);
    }

    public function issueInvoice($id){
        return $this->http->post('/invoices/'. $id.'/authorize', array());
    }

    public function create($dadosConta){
        return $this->http->post('/invoices', $dadosConta);
    }

    public function update($id, $dadosConta){
        return $this->http->post('/invoices/'.$id, $dadosConta);
    }

    public function cancel($id){
        return $this->http->post('/invoices/'.$id.'/cancel', []);
    }

}
