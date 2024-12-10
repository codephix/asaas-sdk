<?php

namespace CodePhix\Asaas;

use CodePhix\Asaas\Connection;

class Parcelamento
{
    public $http;
    protected $cobranca;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    // Retorna a listagem de cobranças
    public function getAll(array $filtros = array())
    {
        $filtro = '';
        if (is_array($filtros)) {
            if ($filtros) {
                foreach ($filtros as $key => $f) {
                    if (!empty($f)) {
                        if ($filtro) {
                            $filtro .= '&';
                        }
                        $filtro .= $key . '=' . $f;
                    }
                }
                $filtro = '?' . $filtro;
            }
        }
        return $this->http->get('/installments' . $filtro);
    }

    // Retorna os dados da cobrança de acordo com o Id
    public function getById($id)
    {
        return $this->http->get('/installments/' . $id);
    }

    // Retorna os dados da cobrança de acordo com o Id
    public function getBeefPdf($id)
    {

        $this->http->headers = array(
            "accept: */*",
            "access_token: " . $this->http->api_key
        );
        return  $this->http->get("/installments/{$id}/paymentBook");
    }

    // Retorna a listagem de cobranças de acordo com o Id do Cliente
    public function getByCustomer($customer_id)
    {
        return $this->http->get('/installments?customer=' . $customer_id);
    }

    // Estorna cobrança
    public function estorno($id)
    {
        return $this->http->post("/installment/{$id}/refund", []);
    }

    // Deleta uma cobrança
    public function delete($id)
    {
        return $this->http->get('/installments/' . $id, '', 'DELETE');
    }
}
