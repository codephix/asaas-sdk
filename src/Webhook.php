<?php

namespace CodePhix\Asaas;


class Webhook {

    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    // Retorna a listagem de webhooks
    public function getAll(?array $data)
    {
        return $this->http->get('/webhooks');
    }

    // Retorna os dados da cobrança de acordo com o Id
    public function getById(?String $id)
    {
        return $this->http->get('/webhooks/'.$id);
    }

    // Cria um novo webhook
    public function create(?array $data)
    {
        return $this->http->post('/webhooks', $data);
    }
    // Atualiza um webhook
    public function update(?String $id, ?array $data)
    {
        return $this->http->put('/webhooks/'.$id, $data);
    }

    // Deleta um webhook
    public function delete(?String $id)
    {
        return $this->http->delete('/webhooks/'.$id);
    }



}
