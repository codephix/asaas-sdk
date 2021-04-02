<?php

namespace CodePhix\Asaas;

use CodePhix\Asaas\Connection;
use CodePhix\Asaas\Exceptions\ClienteException;
use Exception;

/**
 * Class Cliente
 * @package app\Asaas
 *
 *
    \"name\": \"".((!empty($data['name'])) ? $data['name'] : '')."\",
    \"email\": \"".((!empty($data['email'])) ? $data['email'] : '')."\",
    \"company\": \"".((!empty($data['company'])) ? $data['company'] : '')."\",
    \"phone\": \"".((!empty($data['phone'])) ? $data['phone'] : '')."\",
    \"mobilePhone\": \"".((!empty($data['mobilePhone'])) ? $data['mobilePhone'] : '')."\",
    \"postalCode\": \"".((!empty($data['postalCode'])) ? $data['postalCode'] : '')."\",
    \"address\": \"".((!empty($data['address'])) ? $data['address'] : '')."\",
    \"addressNumber\": \"".((!empty($data['addressNumber'])) ? $data['addressNumber'] : '')."\",
    \"complement\": \"".((!empty($data['complement'])) ? $data['complement'] : '')."\",
    \"province\": \"".((!empty($data['province'] )) ? $data['province'] : '')."\",
    \"city\": \"".((!empty($data['city'])) ? $data['city'] : '')."\",
    \"state\": \"".((!empty($data['state'])) ? $data['state'] : '')."\",
    \"cpfCnpj\": \"".((!empty($data['cpfCnpj'])) ? $data['cpfCnpj'] : '')."\",
    \"additionalEmails\": \"".((!empty($data['additionalEmails'])) ? $data['additionalEmails'] : '')."\",
    \"notificationDisabled\": ".((!empty($data['notificationDisabled']) && $data['notificationDisabled'] == 1) ? 'true' : 'false').",
    \"externalReference\": \"".((!empty($data['externalReference'])) ? $data['externalReference'] : '')."\"
 */

class Cliente
{
    
    public $http;
    protected $cliente;

    public $cli;

    
    public function __construct(Connection $connection)
    {
        $this->http = $connection;
    }
    
    /**
     * Retorna array de clientes.
     * @return array
     */
    public function index()
    {
        return $this->http->get('/customers');
    }

    // Retorna a listagem de clientes
    public function getAll($filtros = false){
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
        return $this->http->get('/customers'.$filtro);
    }

    // Retorna os dados do cliente de acordo com o Id
    public function getById($id){
        return $this->http->get('/customers/'.$id);
    }

    // Retorna os dados do cliente de acordo com o Email
    public function getByEmail($email){
        $option = 'limit=1&email=' . $email;
        return $this->http->get('/customers', $option);
    }

    // Insere um novo cliente
    public function create(array $dadosCliente){
        $dadosCliente = $this->setCliente($dadosCliente);
        if(!empty($dadosCliente['error'])){
            return $dadosCliente;
        }else {
            return $this->http->post('/customers', $dadosCliente);
        }
    }

    // Atualiza os dados do cliente
    public function update($id, array $dadosCliente){
        $dadosCliente = $this->setCliente($dadosCliente);
        if(!empty($dadosCliente['error'])){
            return $dadosCliente;
        }else {
            return $this->http->post('/customers/' . $id, $dadosCliente);
        }
    }

    // Deleta uma cliente
    public function delete($id){
        return $this->http->get('/customers/'.$id,'','DELETE');
    }

    // Atualiza os dados do cliente
    public function restore($id){
        if(empty($id)){
            return false;
        }else {
            return $this->http->post('/customers/' . $id.'/restore', array());
        }
    }



    public function get($client_id) {
        return $this->http->get('/customers/' . $client_id);
    }

    /**
     * Cria um novo cliente no Asaas.
     * @param Array $cliente
     * @return Boolean
     */
    public function create2($cliente)
    {
        // Preenche as informações do cliente
        $cliente = $this->setCliente($cliente);
        
        // Faz o post e retorna array de resposta
        return $this->http->post('/customers', ['form_params' => $cliente]);
        
    }
    
    /**
     * Faz merge nas informações do cliente.
     * 
     * @see https://asaasv3.docs.apiary.io/#reference/0/clientes/criar-novo-cliente
     * @param Array $cliente
     * @return Array
     */
    public function setCliente($cliente)
    {
        try {
            if ( ! $this->cliente_valid($cliente) ) {
                return ClienteException::invalidClient();
            }

            $this->cliente = array(
                'name'                 => '',
                'cpfCnpj'              => '',
                'email'                => '',
                'phone'                => '',
                'mobilePhone'          => '',
                'address'              => '',
                'addressNumber'        => '',
                'complement'           => '',
                'province'             => '',
                'postalCode'           => '',
                'externalReference'    => '',
                'notificationDisabled' => '',
                'additionalEmails'     => ''
            );
            
            $this->cliente = array_merge($this->cliente, $cliente);
            return $this->cliente;
            
        } catch (Exception $e) {
            return 'Erro ao definir o cliente. - ' . $e->getMessage();
        }
    }
    
    /**
     * Verifica se os dados do cliente são válidos.
     * 
     * @param array $cliente
     * @return Boolean
     */
    public function cliente_valid($cliente)
    {
        return ! ( (empty($cliente['name']) OR empty($cliente['cpfCnpj']) OR empty($cliente['email'])) ? 1 : '' );
    }
}