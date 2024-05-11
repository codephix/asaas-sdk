<?php

namespace FernandoEbert\Asaas;

use Exception;

class CreditCard {

    public $http;
    public $tokenize;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    public function tokenize(array $data)
    {
        $dadosTokenize = $this->setTokenize($data);
        if (!empty($dadosCobranca['error'])) {
            return $dadosTokenize;
        } else {
            return $this->http->post('/creditCard/tokenize', $dadosTokenize);
        }
    }

    private function setTokenize($data)
    {
        try {
            if (
                empty($data['customer']) ||
                empty($data['creditCard']) ||
                empty($data['creditCardHolderInfo']) ||
                empty($data['remoteIp'])
            ){
                return false;
            }

            $this->tokenize = array(
                'customer'              => '',
                'creditCard'            => '',
                'creditCardHolderInfo'  => '',
                'remoteIp'              => '',
            );

            $this->tokenize = array_merge($this->tokenize, $data);
            return $this->tokenize;
        } catch (Exception $e) {
            return 'Erro ao definir a tokenização. - ' . $e->getMessage();
        }
    }
}
