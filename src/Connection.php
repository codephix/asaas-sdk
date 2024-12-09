<?php

namespace FernandoEbert\Asaas;

use stdClass;

class Connection
{
    public $http;
    public $api_key;
    public $api_status;
    public $base_url;
    public $headers;

    public function __construct($token, $status)
    {

        if ($status == 'producao') {
            $this->api_status = false;
        } elseif ($status == 'homologacao') {
            $this->api_status = 1;
        } else {
            die('Tipo de homologação invalida');
        }
        $this->api_key = $token;
        $this->base_url = "https://" . (($this->api_status) ? 'sandbox.asaas.com/api' : 'api.asaas.com');

        return $this;
    }


    public function get($url, $option = false, $custom = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url . '/v3' . $url . $option);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'LaravelJob/1.0';
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);


        if (empty($this->headers)) {
            $this->headers = array(
                "Content-Type: application/json",
                "access_token: " . $this->api_key
            );
        }
        if (!empty($custom)) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $custom);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response) ? json_decode($response) : $response;

        if (empty($response)) {
            $response = new stdClass();
            $response->error = [];
            $response->error[0] = new stdClass();
            $response->error[0]->description = 'Tivemos um problema ao processar a requisição.';
        }

        return $response;
    }

    public function post($url, $params)
    {
        $params = json_encode($params);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->base_url . '/v3' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . $this->api_key
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        if (empty($response)) {
            $response = new stdClass();
            $response->error = [];
            $response->error[0] = new stdClass();
            $response->error[0]->description = 'Tivemos um problema ao processar a requisição.';
        }

        return $response;
    }
}
