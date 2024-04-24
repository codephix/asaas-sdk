<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodePhix\Asaas\Exceptions;

/**
 * Description of CobrancaException
 *
 * @author Rafael
 * @author Lucas G. Bueno
 */
class CobrancaException
{
    public static function invalidCobranca()
    {
        return array("error" => "Dados inválidos! Os dados obrigatórios são customer(cliente), billingType(forma de pgto), value(valor), dueDate(vencimento)");
    }
}
