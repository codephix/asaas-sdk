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
    
    public function __construct($token, $status = 'producao') {
        $connection = new Connection($token, $status);

        $this->assinatura  = new Assinatura($connection);
        $this->cliente     = new Cliente($connection);
        $this->cobranca    = new Cobranca($connection);
        $this->notificacao = new Notificacao($connection);
        $this->webhook     = new Webhook($connection);
    }
}