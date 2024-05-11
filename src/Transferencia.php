<?php

namespace FernandoEbert\Asaas;


class Transferencia {

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
        return $this->http->get('/transfers/'.$filtro);
        //https://www.asaas.com/api/v3/subscriptions/id/invoices?offset=&limit=&status=
    }

    public function consultaSaldo(){
        return $this->http->get('/finance/getCurrentBalance');
    }

    public function consultaWalletId(){
        return $this->http->get('/wallets');
    }

    public function conta($dadosConta){
        return $this->http->post('/transfers', $dadosConta);
    }
}
