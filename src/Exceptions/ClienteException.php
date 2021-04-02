<?php

namespace CodePhix\Asaas\Exceptions;

class ClienteException {

    public static function invalidClient()
    {
        return array('error'=>'Os dados Obrigatorio são Nome, Cpf\Cnpj, E-mail, Os dados fornecidos para o cadastro do cliente não são válidos.');
    }
}
