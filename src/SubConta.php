<?php

namespace CodePhix\Asaas;

/**
 * SubConta [ MODEL ]
 * Classe responsável pela criação de SubContas
 *
 * @copyright (c) year, Érick Dias derickbass4@gmail.com
 */

class SubConta
{
    public $http;
    protected $subconta;

    public function __construct(Connection $connection)
    {
           $this->http = $connection;
    }

    public function create(array $dadosSubConta){
        $dadosSubConta = $this->setSubConta($dadosSubConta);
        if(!empty($dadosSubConta['error'])){
            return $dadosSubConta;
        }else {
            return $this->http->post('/accounts', $dadosSubConta);
        }
    }

    public function setSubConta($dados)
    {
        try {
            $this->subconta = array(
                "name" => '',
                "email" => '',
                "loginEmail" => '',
                "cpfCnpj" => '',
                "birthDate" => '',
                "companyType" => '',
                "phone" => '',
                "mobilePhone" => '',
                "site" => '',
                "incomeValue" => '',
                "address" => '',
                "addressNumber" => '',
                "complement" => '',
                "province" => '',
                "postalCode" => '',
                "webhooks" => '',
            );

            $this->subconta = array_merge($this->subconta, $dados);
            return $this->subconta;

        } catch (Exception $e) {
            return 'Erro ao definir a subconta. - ' . $e->getMessage();
        }
    }

    public function getAll(array $filtros = []){
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
        return $this->http->get('/accounts'.$filtro);
    }

    public function getSubConta($id)
    {
        return $this->http->get('/accounts/?id='.$id);
    }
}
