<?php

namespace CodePhix\Asaas;


class Notificacao {
    //

    public $http;

    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }

    // Retorna a listagem de notificações
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
        return $this->http->get('/notifications'.$filtro);
    }
    
    // Retorna os dados da notificação de acordo com o Id
    public function getById($id){
        return $this->http->get('/notifications/'.$id);
    }
    
    // Retorna a listagem de notificações de acordo com o Id do Cliente
    public function getByCustomer($customer_id){
        return $this->http->get('/customers/'.$customer_id.'/notifications');
    }
    
    // Insere uma nova notificação
    public function create(array $dadosNotificacao){
        return $this->http->post('/notifications', $dadosNotificacao);
    }
    
    // Atualiza os dados da notificação
    public function update($id, array $dadosNotificacao){
        return $this->http->post('/notifications', $dadosNotificacao);
    }

    // Deleta uma notificação
    public function delete($id){
        return $this->http->get('/notifications/'.$id,'','DELETE');
    }

}
