<?php

namespace codephix\Asaas;

use codephix\Asaas\Assinatura;
use codephix\Asaas\Cliente;
use codephix\Asaas\Cobranca;
use codephix\Asaas\Notificacao;
use codephix\Asaas\Webhook;

class Asaas {
    
    public $assinatura;
    public $cliente;
    public $cobranca;
    public $notificacao;
    public $webhook;
    
    public function __construct() {
        $this->assinatura  = new Assinatura;
        $this->cliente     = new Cliente;
        $this->cobranca    = new Cobranca;
        $this->notificacao = new Notificacao;
        $this->webhook     = new Webhook;
    }
}