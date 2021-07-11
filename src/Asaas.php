<?php

namespace CodePhix\Asaas;

use CodePhix\Asaas\Assinatura;
use CodePhix\Asaas\Cliente;
use CodePhix\Asaas\Cobranca;
use CodePhix\Asaas\Extrato;
use CodePhix\Asaas\Notificacao;
use CodePhix\Asaas\Transferencia;
use CodePhix\Asaas\Webhook;

class Asaas {
    
    public $cidade;
    public $assinatura;
    public $cliente;
    public $cobranca;
    public $LinkPagamento;
    public $notificacao;
    public $transferencia;
    public $webhook;
    public $antecipacao;
    public $extrato;
    public $pagarconta;
    public $NotaFiscal;
    public $MinhaConta;
    public $InformacoesFiscais;
    public $ConsultaSerasa;

    private $connection;
    
    public function __construct($token, $status = false) {
        $this->connection = new Connection($token, ((!empty($status)) ? $status : 'producao'));

        $this->assinatura  = new Assinatura($this->connection);
        $this->cidade = new Cidades($this->connection);
        $this->cliente     = new Cliente($this->connection);
        $this->cobranca    = new Cobranca($this->connection);
        $this->LinkPagamento    = new LinkPagamento($this->connection);
        $this->notificacao = new Notificacao($this->connection);
        $this->transferencia = new Transferencia($this->connection);
        $this->extrato = new Extrato($this->connection);
        $this->antecipacao = new Antecipacao($this->connection);
        $this->pagarconta = new PagarConta($this->connection);
        $this->NotaFiscal = new NotaFiscal($this->connection);
        $this->MinhaConta = new MinhaConta($this->connection);
        $this->InformacoesFiscais = new InformacoesFiscais($this->connection);
        $this->ConsultaSerasa = new ConsultaSerasa($this->connection);
        $this->webhook     = new Webhook($this->connection);
    }

    public function Assinatura(){
        $this->assinatura  = new Assinatura($this->connection);
        return $this->assinatura;
    }

    public function Cidade(){
        $this->cidade = new Cidades($this->connection);
        return $this->cidade;
    }

    public function Cliente(){
        $this->cliente     = new Cliente($this->connection);
        return $this->cliente;
    }
    
    public function Cobranca(){
        $this->cobranca    = new Cobranca($this->connection);
        return $this->cobranca;
    }
    
    public function LinkPagamento(){
        $this->LinkPagamento    = new LinkPagamento($this->connection);
        return $this->LinkPagamento;
    }
    
    public function Notificacao(){
        $this->notificacao = new Notificacao($this->connection);
        return $this->notificacao;
    }
    
    public function Transferencia(){
        $this->transferencia = new Transferencia($this->connection);
        return $this->transferencia;
    }
    
    public function Extrato(){
        $this->extrato = new Extrato($this->connection);
        return $this->extrato;
    }

    public function Antecipacao(){
        $this->antecipacao = new Antecipacao($this->connection);
        return $this->antecipacao;
    }

    public function PagarConta(){
        $this->pagarconta = new PagarConta($this->connection);
        return $this->pagarconta;
    }

    public function NotaFiscal(){
        $this->NotaFiscal = new NotaFiscal($this->connection);
        return $this->NotaFiscal;
    }

    public function InformacoesFiscais(){
        $this->InformacoesFiscais = new InformacoesFiscais($this->connection);
        return $this->InformacoesFiscais;
    }

    public function MinhaConta(){
        $this->MinhaConta = new MinhaConta($this->connection);
        return $this->MinhaConta;
    }

    public function ConsultaSerasa(){
        $this->ConsultaSerasa = new ConsultaSerasa($this->connection);
        return $this->ConsultaSerasa;
    }
    
    public function Webhook(){
        $this->webhook     = new Webhook($this->connection);
        return $this->webhook;
    }

}
