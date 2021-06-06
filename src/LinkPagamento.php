<?php

namespace CodePhix\Asaas;

use CodePhix\Asaas\Connection;

class LinkPagamento {
    public $http;
    protected $cobranca;

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
        return $this->http->get('/paymentLinks'.$filtro);
    }

    // Retorna os dados da cobrança de acordo com o Id
    public function getById($id){
        return $this->http->get('/paymentLinks/'.$id);
    }

    // Insere uma nova cobrança
    public function create(array $dadosCobranca){
        $dadosCobranca = $this->setCobranca($dadosCobranca);
        if(!empty($dadosCobranca['error'])){
            return $dadosCobranca;
        }else {
            return $this->http->post('/paymentLinks', $dadosCobranca);
        }
    }

    // Atualiza os dados da cobrança
    public function update($id, array $dadosCobranca){
        return $this->http->post('/paymentLinks/' . $id, $dadosCobranca);
    }

    // Restaura cobrança removida
    public function restore($id){
        return $this->http->post("/paymentLinks/{$id}/restore", []);
    }

    // Deleta uma cobrança
    public function delete($id){
        return $this->http->get('/paymentLinks/'.$id,'','DELETE');
    }

    /**
     * Faz merge nas informações das cobranças.
     *
     * @see https://asaasv3.docs.apiary.io/#reference/0/cobrancas/criar-nova-cobrancas
     * @param Array $cliente
     * @return Array
     */
    public function setCobranca($dados)
    {
        try {
            $this->cobranca = array(
                'customer'             => '',
                'billingType'          => '',
                'value'                => '',
                'dueDate'              => '',
                'description'          => '',
                'externalReference'    => '',
                'installmentCount'     => '',
                'installmentValue'     => '',
                'discount'             => '',
                'interest'             => '',
                'fine'                 => '',
            );

            $this->cobranca = array_merge($this->cobranca, $dados);
            return $this->cobranca;

        } catch (Exception $e) {
            return 'Erro ao definir o cliente. - ' . $e->getMessage();
        }
    }

    /**
     * Faz merge nas informações das cobranças.
     *
     * @see https://asaasv3.docs.apiary.io/#reference/0/cobrancas/criar-nova-cobrancas
     * @param Array $cliente
     * @return Array
     */
    public function setCobrancaCartao($dados)
    {
        try {
            $this->cobranca = array(
                'customer'             => '',
                'billingType'          => '',
                'value'                => '',
                'dueDate'              => '',
                'description'          => '',
                'externalReference'    => '',
                'installmentCount'     => '',
                'installmentValue'     => '',
                'discount'             => '',
                'interest'             => '',
                'fine'                 => '',
            );

            $this->cobranca = array_merge($this->cobranca, $dados);
            return $this->cobranca;

        } catch (Exception $e) {
            return 'Erro ao definir o cliente. - ' . $e->getMessage();
        }
    }
}
