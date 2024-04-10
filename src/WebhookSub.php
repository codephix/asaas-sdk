<?php

namespace CodePhix\Asaas;


class WebhookSub {

    public $http;
    private $instances;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
        $this->instances = array();
    }

    public function addInstance(array $dadosWebhookSub){
        $dadosWebhookSub = $this->setWebhookSub($dadosWebhookSub);
        $obj = new \stdClass();
        foreach ($dadosWebhookSub as $key => $webs){
            $obj->$key = $webs;
        }
        $this->instances[] = $obj;
    }

    public function setWebHookSub($dados)
    {
        try {
            $this->subconta = array(
                "name" => '',
                "url" => '',
                "email" => '',
                "sendType" => '',
                "apiVersion" => '',
                "enabled" => '',
                "interrupted" => '',
                "authToken" => '',
                "events" => ''
            );

            $this->subconta = array_merge($this->subconta, $dados);
            return $this->subconta;
        } catch (Exception $e) {
            return 'Erro ao definir o webhook. - ' . $e->getMessage();
        }
    }

    public function getWebHookArray()
    {
        return $this->instances;
    }
}
