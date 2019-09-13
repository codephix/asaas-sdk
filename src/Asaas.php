<?php

namespace CodePhix\Asaas;

use CodePhix\Asaas\Assinatura;
use CodePhix\Asaas\Cliente;
use CodePhix\Asaas\Cobranca;
use CodePhix\Asaas\Notificacao;
use CodePhix\Asaas\Webhook;

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