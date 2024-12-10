<?php

namespace CodePhix\Asaas;


class Transferencia {

    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
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

    public function getAll(?array $parametos = []){
        $filtro = ((!empty($parametos)) ? http_build_query($parametos) : '');
        return $this->http->get('/transfers?'.$filtro);
    }

    public function newTransfers($dados){
        return $this->http->post('/transfers', $dados);
    }

    public function newTransfersAsaas(?float $value, ?String $walletId){
        $dados = [
            'value' => $value,
            'walletId' => $walletId
        ];
        return $this->http->post('/transfers/', $dados);
    }

    public function getByTransferId($id){
        return $this->http->get('/transfers/'.$id);
    }
    public function cancelTransfer($id){
        return $this->http->delete('/transfers/'.$id.'/cancel');
    }
}
