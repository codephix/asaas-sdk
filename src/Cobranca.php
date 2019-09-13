<?php

namespace codephix\Asaas;

use codephix\Asaas\Connection;

class Cobranca {
    public $http;
    protected $cobranca;
    
    public function __construct()
    {
        $this->http = new Connection;
    }

    /**
     * Cria um novo boleto no Asaas.
     * @param Array $cliente
     * @return Boolean
     */
    public function create($dados)
    {
        // Preenche as informações da cobranca
        $cobranca = $this->setCobranca($dados);
        
        // Faz o post e retorna array de resposta
        return $this->http->post('/payments', ['form_params' => $cobranca]);
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
}
