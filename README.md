# Asaas @CodePhix

SDK não-oficial de integração á API do serviço www.asaas.com

[![Maintainer](http://img.shields.io/badge/maintainer-@codephix-blue.svg?style=flat-square)](https://twitter.com/codephix)
[![Source Code](https://img.shields.io/badge/source-codephix/asaas--sdk-blue.svg?style=flat-square)](https://github.com/codephix/asaas-sdk)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/codephix/asaas-sdk.svg?style=flat-square)](https://packagist.org/packages/codephix/asaas-sdk)
[![Latest Version](https://img.shields.io/github/release/codephix/asaas-sdk.svg?style=flat-square)](https://github.com/codephix/asaas-sdk/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/codephix/asaas-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/codephix/asaas-sdk)
[![Quality Score](https://img.shields.io/scrutinizer/g/codephix/asaas-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/codephix/asaas-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/codephix/asaas-sdk.svg?style=flat-square)](https://packagist.org/packages/codephix/asaas-sdk)


### Projeto em andamento


## Installation

```bash
composer require codephix/asaas-sdk
```

Exemplo
-------

```php
<?php

require 'vendor/autoload.php';

use CodePhix\Asaas\Asaas;

// Instancie o cliente Asaas usando a instância do adapter previamente criada.
$asaas = new Asaas('seu_token_de_acesso');
```

Endpoint
--------

Caso queira usar a API em modo teste basta especificar o `ambiente` no momento em que o cliente é instanciado.

```php
// Obs.: Caso não seja informado o segundo parâmetro a API entra em modo de produção
$asaas = new Asaas('seu_token_de_acesso', 'producao|homologacao');
```


Clientes
--------

```php
// Retorna a listagem de clientes
$clientes = $asaas->Cliente()->getAll(array $filtros);

// Retorna os dados do cliente de acordo com o Id
$clientes = $asaas->Cliente()->getById(123);

// Retorna os dados do cliente de acordo com o Email
$clientes = $asaas->Cliente()->getByEmail('email@mail.com');

// Insere um novo cliente
$clientes = $asaas->Cliente()->create(array $dadosCliente);

// Atualiza os dados do cliente
$clientes = $asaas->Cliente()->update(123, array $dadosCliente);

// Restaura um cliente
$asaas->Cliente()->restaura(123);

// Deleta uma cliente
$asaas->Cliente()->delete(123);
```


Cobranças
------------

```php
// Retorna a listagem de cobranças
$cobrancas = $asaas->Cobranca()->getAll(array $filtros);

// Retorna os dados da cobrança de acordo com o Id
$cobranca = $asaas->Cobranca()->getById(123);

// Retorna a listagem de cobranças de acordo com o Id do Cliente
$cobrancas = $asaas->Cobranca()->getByCustomer($customer_id);

// Retorna a listagem de cobranças de acordo com o Id da Assinaturas
$cobrancas = $asaas->Cobranca()->getBySubscription($subscription_id);

// Insere uma nova cobrança / cobrança parcelada / cobrança split
$cobranca = $asaas->Cobranca()->create(array $dadosCobranca);

// Atualiza os dados da cobrança
$cobranca = $asaas->Cobranca()->update(123, array $dadosCobranca);

// Restaura cobrança removida
$cobranca = $asaas->Cobranca()->restore(id);

// Estorna cobrança
$cobranca = $asaas->Cobranca()->estorno(id);

// Confirmação em dinheiro
$cobranca = $asaas->Cobranca()->confirmacao(id);

// Desfazer confirmação de recebimento em dinheiro
$cobranca = $asaas->Cobranca()->confirmacao(id);

// Deleta uma cobrança
$asaas->Cobranca()->delete(123);
```



Link de Pagamemto
------------

```php
// Retorna a listagem de cobranças
$LinkPagamento = $asaas->LinkPagamento()->getAll(array $filtros);

// Retorna os dados da cobrança de acordo com o Id
$LinkPagamento = $asaas->LinkPagamento()->getById($id);


// Insere uma nova cobrança / cobrança parcelada / cobrança split
$LinkPagamento = $asaas->LinkPagamento()->create(array $dadosLink);


Body

{
  "name": "Venda de livros",
  "description": "Qualquer livro por apenas R$: 50,00",
  "endDate": "2021-02-05",
  "value": 50,
  "billingType": "UNDEFINED",
  "chargeType": "DETACHED",
  "dueDateLimitDays": 10,
  "subscriptionCycle": null,
  "maxInstallmentCount": 1
}


$dadosLink = array(
    'name' => 'Nome do link de pagamentos -> String required',
    'description' => 'Descrição do link de pagamentos -> String',
    'endDate' => 'Data de encerramento, a partir desta data o seu link de pagamentos será desativado automaticamente',
    'value' => 'Valor do link de pagamentos, caso não informado o pagador poderá informar o quanto deseja pagar',

    /*
      Forma de pagamento permitida

      BOLETO -> Boleto Bancário
      CREDIT_CARD -> Cartão de Crédito
      UNDEFINED -> Perguntar ao Cliente

    */

    'billingType' => 'UNDEFINED', //required


    /*
      Forma de cobrança

      DETACHED -> Avulsa
      RECURRENT -> Assinatura
      INSTALLMENT -> Parcelamento

    */

    'chargeType' => 'DETACHED' //required


    /*
        Caso seja possível o pagamento via boleto bancário, define a quantidade de dias úteis que o seu cliente poderá pagar o boleto após gerado
    */

    'dueDateLimitDays' => '10',


    /*
    Periodicidade da cobrança, envio obrigatório caso a forma de cobrança selecionado seja Assinatura

    WEEKLY -> Semanal
    BIWEEKLY -> Quinzenal (2 semanas)
    MONTHLY -> Mensal
    QUARTERLY -> Trimestral
    SEMIANNUALLY -> Semestral
    YEARLY -> Anual

    'subscriptionCycle' => 'MONTHLY',

    */


    /*
    Quantidade máxima de parcelas que seu cliente poderá parcelar o valor do link de pagamentos caso a forma de cobrança selecionado seja Parcelamento. Caso não informado o valor padrão será de 1 parcela
    */

    'maxInstallmentCount' => '1'

    


);



// Atualiza os dados da cobrança
$LinkPagamento = $asaas->LinkPagamento()->update($id, array $dadosLink);

// Restaura cobrança removida
$LinkPagamento = $asaas->LinkPagamento()->restore(id);

// Estorna cobrança
$LinkPagamento = $asaas->LinkPagamento()->estorno(id);

// Confirmação em dinheiro
$LinkPagamento = $asaas->LinkPagamento()->confirmacao(id);

// Deleta uma cobrança
$asaas->LinkPagamento()->delete(123);

```




Assinaturas
------------

```php



Os status possíveis de uma cobrança são os seguintes:

[PENDING] - Aguardando pagamento

[RECEIVED] - Recebida (saldo já creditado na conta)

[CONFIRMED] - Pagamento confirmado (saldo ainda não creditado)

[OVERDUE] - Vencida

[REFUNDED] - Estornada

[RECEIVED_IN_CASH] - Recebida em dinheiro (não gera saldo na conta)

[REFUND_REQUESTED] - Estorno Solicitado

[CHARGEBACK_REQUESTED] - Recebido chargeback

[CHARGEBACK_DISPUTE] - Em disputa de chargeback (caso sejam apresentados documentos para contestação)

[AWAITING_CHARGEBACK_REVERSAL] - Disputa vencida, aguardando repasse da adquirente

[DUNNING_REQUESTED] - Em processo de recuperação

[DUNNING_RECEIVED] - Recuperada

[AWAITING_RISK_ANALYSIS] - Pagamento em análise


// Retorna a listagem de assinaturas
$assinaturas = $asaas->Assinatura()->getAll(array $filtros);

// Retorna os dados da assinatura de acordo com o Id
$assinatura = $asaas->Assinatura()->getById(123);

// Retorna a listagem de assinaturas de acordo com o Id do Cliente
$assinaturas = $asaas->Assinatura()->getByCustomer($customer_id);

// Insere uma nova assinatura

/*

Assinatura via Boleto

$dadosAssinatura = array(
  "customer" => "{CUSTOMER_ID}",
  "billingType" => "BOLETO",
  "nextDueDate" => "2017-05-15",
  "value" => 19.9,
  "cycle" => "MONTHLY",
  "description" => "Assinatura Plano Pró",
  "discount" => array(
    "value" => 10,
    "dueDateLimitDays" => 0
  ),
  "fine" => array(
    "value": 1
  ),
  "interest" => array(
    "value": 2
  )
);


Assinatura via cartão de credito


$dadosAssinatura = array(
  "customer" => "{CUSTOMER_ID}",
  "billingType" => "CREDIT_CARD",
  "nextDueDate" => "2017-05-15",
  "value" => 19.9,
  "cycle" => "MONTHLY",
  "description" => "Assinatura Plano Pró",
  "creditCard" => array(
    "holderName" => "marcelo h almeida",
    "number" => "5162306219378829",
    "expiryMonth" => "05",
    "expiryYear" => "2021",
    "ccv" => "318"
  ),
  "creditCardHolderInfo" => array(
    "name" => "Marcelo Henrique Almeida",
    "email" => "marcelo.almeida@gmail.com",
    "cpfCnpj" => "24971563792",
    "postalCode" => "89223-005",
    "addressNumber" => "277",
    "addressComplement" => null,
    "phone" => "4738010919",
    "mobilePhone" => "47998781877"
  )
);

*/

$assinatura = $asaas->Assinatura()->create(array $dadosAssinatura);

// Atualiza os dados da assinatura
$assinatura = $asaas->Assinatura()->update(123, array $dadosAssinatura);

Listar notas fiscais das cobranças de uma assinatura

/*

$parametos = array(
'offset' => '',
'limit' => '',
'status' => '',

*/

$assinatura = $asaas->Assinatura()->getNotaFiscal($id, array $parametos);

// Deleta uma assinatura
$asaas->Assinatura()->delete(123);
```



Antecipação
------------

```php


$Antecipacao = $Asaas->Antecipacao()->getAll($filtro);

Parametros Filtro para retorno

$filtro = array(
    'payment' => 'Filtrar antecipações de uma cobrança -> string',
    'installment' => 'Filtrar antecipações de um parcelamento -> String', 
    'status' => 'Filtrar por status -> String',
    'offset' => 'Elemento inicial da lista -> Number',
    'limit' => 'Número de elementos da lista (max: 100) -> Number',
)


$Antecipacao = $Asaas->Antecipacao()->create($dados);

Dados Para solicitação de antecipação = array() 
{
"agreementSignature": "João Almeida",
"installment": null,
"payment": "pay_626366773834",
"documents": [<file>]
}

Recupera uma Antecipação 

$Asaas = $Asaas->Antecipacao()->getBy($id);

Dados de retorno

{
  "object": "receivableAnticipation",
  "id": "9e7d8639-350f-45c0-8bc3-d4ddc5f4ebac",
  "installment": null,
  "payment": "pay_626366773834",
  "status": "PENDING",
  "anticipationDate": "2019-05-20",
  "dueDate": "2019-05-26",
  "requestDate": "2019-05-14",
  "fee": "2.33",
  "anticipationDays": "6",
  "netValue": "73.68",
  "totalValue": "80.00",
  "value": "76.01",
  "denialObservation": null
}


```




Pagamento de conta
------------

```php

Retorna Lista 


$Pagar = $Asaas->PagarConta()->getAll($filtro);

$filtro = array(   
    'offset' => 'Elemento inicial da lista -> Number',
    'limit' => 'Número de elementos da lista (max: 100) -> Number',
);



$Pagar = $Asaas->PagarConta()->create($dados);

Parametros Filtro para retorno

$dados = array(
    'identificationField' => 'Linha digitável do boleto -> 
    required
    string',
    
    'scheduleDate' => 'Data de agendamento do pagamento -> string',
    
    'description' => 'Descrição do pagamento de conta -> string',
    
    'discount' => 'Desconto atribuido ao pagamento -> number',
    
    'dueDate' => 'Data de vencimento da conta caso seja do tipo que não possui essa informação -> string',
    
    'value' => 'Valor da conta caso seja do tipo que não possui essa informação (Ex: faturas de cartão de crédito) -> number',
    
)

/*
 * Simulação Pagar Conta
 * */

$Pagar = $Asaas->PagarConta()->simulate($dados);

Dados simulação
 $dados = array( 
    'identificationField' => 'Linha digitável do boleto',
    
    /* OU */


    'barCode' => 'Código de barras do boleto',
    );


Recupera um Pagamento 

$Pagar = $Asaas->PagarConta()->getBy($id);

Dados de retorno

{
  "object": "bill",
  "id": "f1bce822-6f37-4905-8de8-f1af9f2f4bab",
  "status": "PENDING",
  "value": 29.9,
  "discount": 0,
  "identificationField": "03399.77779 29900.000000 04751.101017 1 81510000002990",
  "dueDate": "2020-01-31",
  "scheduleDate": "2020-01-31",
  "fee": 0,
  "description": "Celular 01/12",
  "companyName": null,
  "transactionReceiptUrl": "https://www.asaas.com/comprovantes/00016578",
  "canBeCancelled": false,
  "failReasons": null
}



```



Consulta Serasa
------------

```php

Retorna Lista 


$ConsultaSerasa = $Asaas->ConsultaSerasa()->getAll($filtro);

$filtro = array(   
    'startDate' =>  'Filtrar a partir da data de criação -> String',
    'endDate' => 'Filtrar até uma data de criação -> String',
    'offset' => 'Elemento inicial da lista -> Number',
    'limit' => 'Número de elementos da lista (max: 100) -> Number',
);

Dados de retorno

{
  "object": "list",
  "hasMore": false,
  "totalCount": 1,
  "limit": 10,
  "offset": 0,
  "data": [
    {
      "id": "6c5e73fa-9efd-4a75-b60c-1cafb8d1c7ed",
      "dateCreated": "2021-01-27",
      "cpfCnpj": "05666663755",
      "state": "SC",
      "customer": "cus_000000001766",
      "downloadUrl": "https://www.asaas.com.br/creditBureauReport/download/6c5e73fa-9efd-4a75-b60c-1cafb8d1c7ed"
    }
  ]
}







Cria uma consulta



As consultas junto ao Serasa Experian são realizadas no momento da solicitação, para evitar possíveis percas de conexão, sugerimos um timeout de 30 segundos ou mais.

Ao realizar a consulta será retornado o atributo reportFile contendo o PDF da consulta em Base64, este campo apenas é retornado no momento da criação da consulta, caso precise obte-lo novamente será necessário realizar o download por meio da url presente no campo downloadUrl.

Para realizar a consulta você terá que informar um CPF ou CNPJ e o estado onde deseja realizar a consulta.

Caso queira informar um cliente já cadastrado na sua conta Asaas:

    Este deverá possuir um CPF ou CNPJ já cadastrado

    O envio do estado se torna opcional caso já conste no cadastro do cliente




$ConsultaSerasa = $Asaas->ConsultaSerasa()->create($dados);


Parametros Create

$dados = array(
    'customer' = 'Identificador único do cliente no Asaas -> String',
    'cpfCnpj' = 'CPF ou CNPJ do cliente. Informe este campo caso seu cliente não esteja cadastrado no Asaas -> String',
    'state' = 'Estado em que deseja realizar a consulta. -> required EX: PE ou PB etc',
)

Consulta Valida até as 23:59 do dia da consulta 

dados de retorno

{
  "id": "6c5e73fa-9efd-4a75-b60c-1cafb8d1c7ed",
  "dateCreated": "2021-01-27",
  "cpfCnpj": "05666663755",
  "state": "SC",
  "customer": "cus_000000001766",
  "downloadUrl": "https://www.asaas.com.br/creditBureauReport/download/6c5e73fa-9efd-4a75-b60c-1cafb8d1c7ed"
}



Recupera consulta 

$ConsultaSerasa = $Asaas->ConsultaSerasa()->getBy($id);

Dados de retorno

{
  "id": "6c5e73fa-9efd-4a75-b60c-1cafb8d1c7ed",
  "dateCreated": "2021-01-27",
  "cpfCnpj": "05666663755",
  "state": "SC",
  "customer": "cus_000000001766",
  "downloadUrl": "https://www.asaas.com.br/creditBureauReport/download/6c5e73fa-9efd-4a75-b60c-1cafb8d1c7ed"
}


```




Nota Fiscal
------------



Possibilita que empresas (pessoa jurídica) emitam Notas Fiscais para seus clientes. É possível emitir uma Nota Fiscal atrelada a cobranças já existentes.

Antes de emitir uma nota é necessário preencher as informações fiscais da sua conta. Clique aqui para entender como fazer isso.

Os status possíveis de uma nota fiscal são os seguintes:

SCHEDULED - Agendada

SYNCHRONIZED - Enviada para prefeitura

AUTHORIZED - Emitida

PROCESSING_CANCELLATION - Processando cancelamento

CANCELED - Cancelada

CANCELLATION_DENIED - Cancelamento negado

ERROR - Erro na emissão


```php
//Recuperar dados comerciais


/*
Parametros
*/

$dados = array(

'effectiveDate[ge]' => 'Filtrar a partir de uma data de emissão -> Date (Y-m-d)',
'effectiveDate[le]' => 'Filtrar até uma data de emissão -> String',
'payment' => 'Filtrar pelo identificador único da cobrança -> String',
'installment' => 'Filtrar pelo identificador único do parcelamento -> String',
'externalReference' => 'Identificador da nota fiscal no seu sistema -> String',
'status' => 'Filtrar por situação -> Enum',
'offset' => 'Elemento inicial da lista -> Number',
'limit' => 'Número de elementos da lista (max: 100) -> Number',


);


$NotaFiscal = $asaas->NotaFiscal()->getAll($dados);


/*Agenda Nota Fiscal*/

$dados = array(
  "payment" => "pay_637959110194",
  "installment" => null,
  "serviceDescription" => "Nota fiscal da Fatura 101940. \nDescrição dos Serviços: ANÁLISE E DESENVOLVIMENTO DE SISTEMAS",
  "observations" => "Mensal referente aos trabalhos de Junho.",
  "value" => 300,
  "deductions" => 0,
  "effectiveDate" => "2018-07-03",
  "externalReference" => null,
  "taxes" => array(
    "retainIss" => false,
    "iss" => 3,
    "cofins" => 3,
    "csll" => 1,
    "inss" => 0,
    "ir" => 1.5,
    "pis" => 0.65
  ),
  "municipalServiceId" => null,
  "municipalServiceCode" => "1.01",
  "municipalServiceName" => "Análise e desenvolvimento de sistemas"
);


$NotaFiscal = $asaas->NotaFiscal()->create($dados);
/*Agenda Nota Fiscal*/

$dados = array(
  "serviceDescription" => "Nota fiscal da Fatura 101940. \nDescrição dos Serviços: ANÁLISE E DESENVOLVIMENTO DE SISTEMAS",
  "observations" => "Mensal referente aos trabalhos de Junho.",
  "value" => 300,
  "deductions" => 0,
  "effectiveDate" => "2018-07-03",
  "externalReference" => null,
  "taxes" => array(
    "retainIss" => false,
    "iss" => 3,
    "cofins" => 3,
    "csll" => 1,
    "inss" => 0,
    "ir" => 1.5,
    "pis" => 0.65
  ),
);


$NotaFiscal = $asaas->NotaFiscal()->update($dados);


//Emitir Nota Fiscal
$NotaFiscal = $asaas->NotaFiscal()->issueInvoice($id);

//Listar serviços municipais
$NotaFiscal = $asaas->NotaFiscal()->ListMunicipalServices($descricao);




```




Informações Fiscais
------------


```php
//Recuperar Informações Fiscais
$InformacoesFiscais = $asaas->InformacoesFiscais()->get();



/*Cria e atualiza informações Fiscais*/

$dados = array(
  "object" => "customerFiscalInfo",
  "simplesNacional" => false,
  "rpsSerie" => "1",
  "rpsNumber" => 1,
  "loteNumber" => 1,
  "username" => "usuario",
  "specialTaxRegime" => "1",
  "email" => "marcelo.almeida@gmail.com",
  "serviceListItem" => null,
  "cnae" => "6209100",
  "culturalProjectsPromoter" => false,
  "municipalInscription" => "21779501",
  "stateInscription" => null,
  "password" => "secret",
  "accessToken" => null,
  "certificateFile" => null,
  "certificatePassword" => "secret"
);


$InformacoesFiscais = $asaas->InformacoesFiscais()->createUpdate($dados);


//Listar configurações municipais

$InformacoesFiscais = $asaas->NotaFiscal()->ListMunicipalConfigurations();


```




Minha Conta
------------

```php
//Recuperar dados comerciais
$MinhaConta = $asaas->MinhaConta()->get();

// Recuperar configurações de personalização
$MinhaConta = $asaas->MinhaConta()->getConf();

```

Notificações
------------

```php
// Retorna a listagem de notificações
$notificacoes = $asaas->Notificacao()->getAll(array $filtros);

// Retorna os dados da notificação de acordo com o Id
$notificacao = $asaas->Notificacao()->getById(123);

// Retorna a listagem de notificações de acordo com o Id do Cliente
$notificacoes = $asaas->Notificacao()->getByCustomer($customer_id);

// Insere uma nova notificação
$notificacao = $asaas->Notificacao()->create(array $dadosNotificacao);

// Atualiza os dados da notificação
$notificacao = $asaas->Notificacao()->update(123, array $dadosNotificacao);

// Deleta uma notificação
$asaas->Notificacao()->delete(123);
```

Documentação Oficial
--------------------

Obs.: Esta é uma API não oficial. Foi feita com base na documentação disponibilizada [neste link](https://asaasv3.docs.apiary.io/).



## Contributing

Please see [CONTRIBUTING](https://github.com/codephix/asaas-sdk/blob/master/CONTRIBUTING.md) for details.


Creditos
--------

* [Codephix - www.codephix.com](http://www.codephix.com)

Suporte
-------

[Para reportar um novo bug por favor abra um novo Issue no github](https://github.com/codephix/asaas-sdk/issues)


## Support

###### Security: If you discover any security related issues, please email contato@codephix.com instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para contato@codephix.com em vez de usar o rastreador de problemas.

Thank you

## Credits

- [Max Alex](https://github.com/codephix) (Developer)
- [All Contributors](https://github.com/codephix/asaas-sdk/contributors) (This Rock)

## License

The MIT License (MIT). Please see [License File](https://github.com/codephix/asaas-sdk/blob/master/LICENSE) for more information.
