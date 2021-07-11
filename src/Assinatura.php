<?php

namespace CodePhix\Asaas;


class Assinatura {
    //
    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    // Retorna a listagem de assinaturas
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
        return $this->http->get('/subscriptions'.$filtro);

    }

    // Retorna os dados da assinatura de acordo com o Id
    public function getById($id){
        return $this->http->get('/subscriptions/'.$id);

    }

    // Retorna a listagem de assinaturas de acordo com o Id do Cliente
    public function getByCustomer($customer_id){
        return $this->http->get('/subscriptions?customer='.$customer_id);
    }


    // Retorna a listagem de todos os pagamentos da assinatura
    public function getByPayment($subscription_id){
        return $this->http->get('/subscriptions/'.$subscription_id.'/payments');
    }

    // Insere uma nova assinatura

    public function create(array $dadosAssinatura){
        return $this->http->post('/subscriptions', $dadosAssinatura);
    }

    // Atualiza os dados da assinatura
    public function update($id, array $dadosAssinatura){

        return $this->http->post('/subscriptions/' . $id, $dadosAssinatura);
    }

    public function getNotaFiscal($id, array $parametos){
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
        return $this->http->get('/subscriptions/'.$id.$filtro);
        //https://www.asaas.com/api/v3/subscriptions/id/invoices?offset=&limit=&status=
    }

    public function createNotaFiscal($subscription_id, $dadosAssinatura){

        return $this->http->post('/subscriptions', $dadosAssinatura);
        //https://www.asaas.com/api/v3/subscriptions/id/invoiceSettings
    }

    // Atualiza Nota Fiscal da assinatura
    public function updateNotaFiscal($subscription_id, $dadosAssinatura){

        return $this->http->post('/subscriptions', $dadosAssinatura);
        //https://www.asaas.com/api/v3/subscriptions/id/invoiceSettings
    }

    // Recuperar configuração para emissão de Notas Fiscais
    public function getConfigNotaFiscal($subscription_id){
        return $this->http->get('/subscriptions/'.$subscription_id.'/invoiceSettings');
        //https://www.asaas.com/api/v3/subscriptions/id/invoiceSettings
    }

    // Deleta configuração para emissão de Notas Fiscais
    public function deleteConfigNotaFiscal($id){
        return $this->http->get('/subscriptions/'.$subscription_id.'/invoiceSettings','','DELETE');
    }

    // Deleta uma assinatura
    public function delete($id){
        return $this->http->get('/subscriptions/'.$id,'','DELETE');
    }

}
